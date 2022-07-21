<?php


namespace App\Repositories\Classes;

use App\Enums\PaymentEnum;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Pay;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * @param $ip
     * @param $user
     * @param $status
     * @param $search
     * @param $pagination
     * @return mixed
     */

    public $payment;
    public function getAllAdminList($ip, $user, $status, $search , $pagination)
    {
        return Payment::latest('id')->with(['user'])->when($ip,function ($query) use ($ip){
            return $query->wherehas('user',function ($query) use ($ip){
                return $query->where('ip',$ip);
            });
        })->when($user,function ($query) use ($user){
            return $query->wherehas('user',function ($query) use ($user){
                return
                    is_numeric($user) ?
                        $query->where('phone',$user) : $query->where('name',$user);
            });
        })->when($status,function ($query) use ($status){
            return $query->where('status_code',$status);
        })->when($search,function ($q) use ($search){
            return $q->where('id',$search)->orWhere('payment_ref',$search);
        })->paginate($pagination);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Payment::findOrFail($id);
    }

    /**
     * @param Payment $payment
     * @return mixed
     */
    public function delete(Payment $payment)
    {
        return $payment->delete();
    }

    public function create(User $user, array $data)
    {
        return $user->payments()->create($data);
        // TODO: Implement create() method.
    }

    public function newObject(): Payment
    {
        return new Payment();
    }

    public function update(array $data, array $where = [])
    {
        return Payment::where($where)->update($data);
    }

    public function get(array $where = [])
    {
        return Payment::where($where)->first();
    }

    public function getDashboardData($from_date , $to_date)
    {
        return Payment::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])
            ->where([['status_code',PaymentEnum::SUCCESS],['model_type','user']])->sum('amount');
    }


    public function pay($amount , $gateway , array $config , string $callbackUrl  , callable $callbackFunction)
    : string|Redirector|RedirectResponse|Application
    {
        try {
            $payment = Pay::via($gateway)->config($config)->callbackUrl($callbackUrl)
                ->purchase((new Invoice)->amount($amount),
                    function ($driver, $transactionId) use ($callbackFunction, $gateway) {
                    $callbackFunction($gateway,$transactionId);
                })->pay()->toJson();
            $payment = json_decode($payment);
            RateLimiter::clear(keyRateLimiter(auth()->user()->email));
            return redirect($payment->action);
        } catch (PurchaseFailedException|Exception $exception){
            Log::error($exception->getMessage());
            return 'خطا در عملیات پرداخت.';
        }
    }

    public function verify($amount,$gateway,array $config , $transactionId , callable $callbackFunction)
    {
        try {
            if (!rateLimiter(value:auth()->user()->email))
            {
                $this->payment = Pay::via($gateway)->config($config)
                    ->amount($amount)->transactionId($transactionId)->verify();
                $callbackFunction($this->payment,$amount/($config['unit']) );
            }
        } catch (InvalidPaymentException $exception) {
            Log::error($exception->getMessage());
            if (empty($this->get([['payment_token', $transactionId]])->payment_ref))
            {
                $this->update([
                    'status_code' => $exception->getCode(),
                    'status_message' => $exception->getMessage(),
                ],[['payment_token', $transactionId,'']]);
                return false;
            }
        }
        return true;
    }

    public function getModelNamespace(): string
    {
        return Payment::class;
    }
}
