<?php


namespace App\Repositories\Classes;

use App\Enums\CourseEnum;
use App\Enums\OrderEnum;
use App\Enums\QuizEnum;
use App\Enums\SampleEnum;
use App\Models\Course;
use App\Models\Order;
use App\Observers\CourseObserver;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAllAdmin($search , $status, $category, $per_page, $type)
    {
        return Course::latest('id')->when($category,function ($q) use ($category){
            return $q->wherehas('category',function ($q) use ($category) {
                return $q->where('id',$category);
            });
        })->when($status,function ($q) use ($status){
            return $q->where('status', $status);
        })->when($type,function ($q) use ($type){
            return $q->where('type', $type);
        })->search($search)->paginate($per_page);
    }

    public function getAllSite($search = null, $orderBy = null, $type = null, $category = null , $teacher = null, $property = null ,  $province = null , $city = null)
    {
        return Course::published()->when($type, function($q) use ($type) {
            return match ($type) {
                'free' => $q->where('const_price',0),
                'cash' => $q->where('const_price','>',0),
                default => $q,
            };
        })->when($orderBy , function ($q) use ($orderBy) {
            return match ($orderBy) {
                'latest' => $q->latest('id'),
                'oldest' =>  $q->oldest('id'),
                'expensive' =>  $q->orderBy('const_price','desc'),
                'inexpensive' => $q->orderBy('const_price'),
                CourseEnum::HOLDING => $q->where('status',CourseEnum::HOLDING),
                CourseEnum::FINISHED => $q->where('status',CourseEnum::FINISHED),
                default => $q,
            };
        })->when($category,function ($q) use ($category) {
            $categoryRepository = app(CategoryRepositoryInterface::class);
            if ($categories = $categoryRepository->get([['slug',$category]],'first')) {
                $ids = array_value_recursive('id',$categories->toArray());
                return $q->whereIn('category_id',$ids);
            }
            return null;
        })->when($search,function ($q) use ($search) {
            return $q->where('title','LIKE','%'.$search.'%')->orWhere('slug','LIKE','%'.$search.'%')->orWhereHas('tags',function ($q) use ($search){
                return $q->where('name','LIKE','%'.$search.'%');
            });
        })->when($teacher , function ($q) use ($teacher){
            return $q->where('teacher_id',base64_decode($teacher));
        })->when($property , function ($q) use ($property){
            return $q->where('type',$property);
        })->when($province , function ($q) use ($province , $city){
            return $q->when($city , function ($q) use ($city) {
                return $q->where('city',$city);
            })->where('province',$province);
        })->hasCategory()->paginate(9);
    }

    public function save(Course $course): Course
    {
        $course->save();
        return $course;
    }

    public function delete(Course $course): ?bool
    {
        return $course->delete();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        return Course::with('episodes')->findOrFail($id);
    }

    public function attachTags(Course $course, array $tags)
    {
        $course->tags()->attach($tags);
    }

    public function syncTags(Course $course, array $tags)
    {
        $course->tags()->sync($tags);
    }

    public function newCourseObject(): Course
    {
        return new Course();
    }

    public function getAll()
    {
        return Course::published()->with('episodes')->cursor();
    }

    public function get($col, $value , $published = false)
    {
        return $published ?
        Course::published()->with(['chapters','comments','samples' => function($q){
            return $q->where('type',SampleEnum::PUBLIC_TYPE);
        }])->where($col,$value)->firstOrfail() :
        Course::where($col,$value)->with(['chapters','chapters.episodes','comments','samples' => function($q){
            return $q->where('type',SampleEnum::PUBLIC_TYPE);
        }])->firstOrfail();
    }

    public function whereIn($col, array $value , $take = false , $published = false , $where = [])
    {
        return $published ?
            ($take ? Course::published()->where($where)->whereIn($col,$value)->take($take)->get() : Course::published()->where($where)->whereIn($col,$value)->get()) :
            ($take ? Course::whereIn($col,$value)->where($where)->take($take)->get() : Course::whereIn($col,$value)->where($where)->get()) ;
    }

    public function newComment(Course $course, array $data): Model
    {
        return $course->comments()->create($data);
    }

    public function getEpisodes(Course $course , $withTrashed = false)
    {
        return $course->episodes;
    }

    public function count()
    {
        return Course::count();
    }

    public function getMostSoldCourses($from_date ,$to_date)
    {
        return Course::select(['id','title'])->withCount(['details' => function($q) use ($from_date ,$to_date) {
            return $q->where('status', OrderEnum::STATUS_COMPLETED)
                ->whereBetween('created_at', [$from_date.' 00:00:00', $to_date.' 23:59:59']);
        }])->whereHas('details', function($q) use ($from_date ,$to_date) {
            return $q->where('status', OrderEnum::STATUS_COMPLETED)
                ->whereBetween('created_at', [$from_date.' 00:00:00', $to_date.' 23:59:59']);
        })->cursor()->sortByDesc('details_count');
    }

    public static function observe()
    {
        Course::observe(CourseObserver::class);
    }

    public function increment(Course $course, int $int)
    {
        $course->increment('views',$int);
    }

    public function getAllTeacher($search, $level, $status, $per_page)
    {
        return Course::latest('id')->with('teacher')->withCount('episodes')->whereHas('teacher',function ($q){
           return $q->where('user_id',Auth::id());
        })->when($level,function ($q) use ($level) {
            return $q->where('level',$level);
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function getAllOrgan($search, $level, $status, $per_page)
    {
        return Course::latest('id')->with('organ')->withCount('episodes')
            ->whereIn('organ_id',Auth::user()->organs->pluck('id')->toArray())
            ->when($level,function ($q) use ($level) {
            return $q->where('level',$level);
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function findTeacher($id)
    {
        return Course::whereHas('teacher',function ($q){
            return $q->where('id',Auth::id());
        })->findOrFail($id);
    }

    public function findOrgan($id)
    {
        return Course::whereHas('organ',function ($q){
            return $q->whereIn('id',Auth::user()->organs->pluck('id'));
        })->findOrFail($id);
    }

    public function getTeachersCount($from_date , $to_date)
    {
        return Course::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->whereHas('teacher',function ($q){
            return $q->where('user_id',Auth::id());
        })->count();
    }

    public function getOrgansCount($from_date, $to_date)
    {
        return Course::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->whereHas('organ',function ($q){
            return $q->whereIn('id',Auth::user()->organs->pluck('id'));
        })->count();
    }

    public function setCourseToOrder($course)
    {
        if (\auth()->check()) {
            $order = [
                'user_id' => auth()->id(),
                'user_ip' => request()->ip(),
                'price'=> $course->base_price,
                'total_price' => 0,
                'reduction_code' =>  null,
                'reductions_value' => $course->reduction_amount,
                'wallet_pay'=>0,
                'discount' => 0,
                'transactionId' => null,
            ];
            try {
                DB::beginTransaction();
                $order = Order::query()->create($order);
                $detail = $order->details()->create([
                    'course_id' => $course->id,
                    'product_data' => json_encode(['id' => $course->id, 'title' => $course->title]),
                    'price' => $course->base_price,
                    'total_price' => 0,
                    'status' => OrderEnum::STATUS_COMPLETED,
                    'reduction_amount' => $course->reduction_amount,
                    'wallet_amount' => 0,
                    'quantity' => 1,
                ]);
                $detail->refresh();
                $transcriptRepository = app(TranscriptRepositoryInterface::class);
                if (!is_null($detail->course->quiz)) {
                    $quiz = $detail->course->quiz;
                    for ($i=0;$i<$quiz->enter_count;$i++) {
                        $transcriptRepository->create([
                            'user_id' => auth()->id(),
                            'quiz_id' => $quiz->id,
                            'course_id' => $detail->course->id,
                            'result' => QuizEnum::PENDING,
                            'course_data' => json_encode([
                                'id' => $detail->course->id,
                                'title' => $detail->course->title,
                            ])
                        ]);
                    }
                }
                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return false;
            }
        }
    }



    public function submitRating(Course $course, $data)
    {
        return $course->ratings()->create($data);
    }
}
