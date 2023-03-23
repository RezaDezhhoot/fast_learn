<?php


namespace App\Repositories\Classes;

use App\Enums\NotificationEnum;
use App\Enums\OrderEnum;
use App\Enums\PaymentEnum;
use App\Models\Course;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderDetailRepository implements OrderDetailRepositoryInterface
{
    public function find($id)
    {
        return OrderDetail::findOrFail($id);
    }

    public function destroy($id): int
    {
        return OrderDetail::destroy($id);
    }

    public function create(array $data)
    {
        return OrderDetail::create($data);
    }

    public function save(OrderDetail $orderDetail): OrderDetail
    {
         $orderDetail->save();
        return $orderDetail;
    }

    public function getDashboardData($from_date , $to_date , $course_id = null)
    {
        return OrderDetail::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])
            ->where('status',OrderEnum::STATUS_COMPLETED)->when($course_id , function ($q) use ($course_id){
                return $q->wherehas('course',function ($q) use ($course_id) {
                    return $q->where('id',$course_id);
                });
            })->count();
    }

    public function getDashboardDataPayments($from_date , $to_date , $sum , $course_id = null , $teacher = false  , $organ = false)
    {
        return $this->getDashboardDataQuery($from_date , $to_date , $sum , $course_id , $teacher , $organ);
    }

    public function getDashboardDataQuery($from_date , $to_date , $sum , $course_id = null , $teacher = false , $organ = false)
    {
        return OrderDetail::when($teacher,function ($q){
            return $q->whereHas('course',function ($q){
                return $q->wherehas('teacher',function ($q){
                    return $q->where('user_id',Auth::id());
                });
            });
        })->when($organ,function ($q){
            return $q->whereHas('organ',function ($q){
                return $q->whereIn('id',Auth::user()->organs->pluck('id'));
            });
        })->whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->where('status',OrderEnum::STATUS_COMPLETED)
            ->when($course_id , function ($q) use ($course_id){
                return $q->wherehas('course',function ($q) use ($course_id) {
                    return $q->where('id',$course_id);
                });
            })->sum($sum);
    }

    public function getOrderDetailCount(array $where)
    {
        return OrderDetail::where($where)->count();
    }


    public function paymentOfFeesIfCourseHasTeacherAndValidIncomingMethod(OrderDetail $orderDetail): bool|int
    {
        if (!is_null($orderDetail->course->teacher) && !is_null($orderDetail->course->incoming_method)) {
            $method = $orderDetail->course->incoming_method;
            if (is_null($method->expire_limit) || ($method->expire_limit > Carbon::parse($orderDetail->course->created_at)->diffInDays(Carbon::now())) ) {
                if (is_null($method->count_limit) || $this->getOrderDetailCount([['course_id',$orderDetail->course_id],['incoming_method_id',$method->id]]) <= $method->count_limit){
                    $fee = $orderDetail->total_price*($method->value/100);
                    if ($fee > 0) {
                        $description = "واریز حق التدرس بابت دوره اموزشی {$orderDetail->course->title}  به مبلغ ".(number_format($fee)).' تومان ';
                        $orderDetail->course->teacher->user->deposit($fee, ['description' => $description, 'from_admin'=> true]);
                        app(SendRepositoryInterface::class)->sendNOTIFICATION(
                            $description,
                            $orderDetail->course->teacher->user_id,
                            NotificationEnum::FEE,
                            $orderDetail->id,
                        );
                        return $fee;
                    }
                }
            }
        }
        return false;
    }

    public function paymentOfFeesIfCourseHasOrganAndValidIncomingMethod(OrderDetail $orderDetail): bool|int
    {
        if ($orderDetail->organ) {
            if (!empty($orderDetail->organ->percent) && $orderDetail->organ->percent) {
                $fee = $orderDetail->total_price*($orderDetail->organ->percent/100);
                if ($fee > 0) {
                    $description = "واریز درصد مشارکت بابت دوره اموزشی {$orderDetail->course->title}  به مبلغ ".(number_format($fee)).' تومان ';
                    $orderDetail->organ->user->deposit($fee, ['description' => $description, 'from_admin'=> true]);
                    app(SendRepositoryInterface::class)->sendNOTIFICATION(
                        $description,
                        $orderDetail->course->teacher->user_id,
                        NotificationEnum::FEE,
                        $orderDetail->id,
                    );
                }

                return $fee;
            }
        }
        return false;
    }

    public function getTeacherStudents($from_date , $to_date)
    {
        return OrderDetail::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->whereHas('course',function ($q){
            return $q->wherehas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->count();
    }

    public function getOrgansStudents($from_date, $to_date)
    {
        return OrderDetail::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->whereHas('organ',function ($q){
            return $q->whereIn('id',Auth::user()->organs->pluck('id'));
        })->count();
    }

    public function getAllByCourse(Course $course , $user_search , $perPage=10)
    {
        return $course->details()->when($user_search,function ($q) use ($user_search) {
            return $q->whereHas('order',function ($q) use ($user_search) {
               return $q->whereHas('user',function ($q) use ($user_search){
                   return $q->search($user_search);
               });
            });
        })->paginate($perPage);
    }
}
