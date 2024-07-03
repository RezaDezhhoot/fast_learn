<?php


namespace App\Repositories\Classes;

use App\Enums\NotificationEnum;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Mail\Mailable as MailableContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRepository implements SendRepositoryInterface
{
    private $apiKey ;
    private $username;
    private $password ;
    private $lineNumber;
    private $pattern , $pattern_var;

    private $SettingRepository;

    public $smsPanel;

    public $kavenegar_api_key , $kavenegar_sender , $kavenegar_template;

    public function __construct()
    {
        $this->SettingRepository = app(SettingRepositoryInterface::class);
        $this->smsPanel = $this->SettingRepository->getRow('sms_panel');
        if ($this->smsPanel == NotificationEnum::KAVEH_NEGAR_SMS_PANEL) {
            $this->kavenegar_api_key = $this->SettingRepository->getRow('kavenegar_api_key');
            $this->kavenegar_sender = $this->SettingRepository->getRow('kavenegar_sender');
            $this->kavenegar_template = $this->SettingRepository->getRow('kavenegar_template');
        } else {
            $this->apiKey = $this->SettingRepository->getRow('faraz_apiKey');
            $this->username = $this->SettingRepository->getRow('faraz_username');
            $this->password = $this->SettingRepository->getRow('faraz_password');
            $this->lineNumber = $this->SettingRepository->getRow('faraz_line');
            $this->pattern = $this->SettingRepository->getRow('faraz_pattern');
            $this->pattern_var = $this->SettingRepository->getRow('faraz_var');
        }

    }

    /**
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendSMS($message, $number)
    {
        if ($this->smsPanel == NotificationEnum::KAVEH_NEGAR_SMS_PANEL) {
            $this->sendSMSKavehNegar($message , $number);
        } else {
            $this->sendSMSFarazSMS($message , $number);
        }
    }

    private function sendSMSFarazSMS($message, $number)
    {
        $client = new Client();
        $query = ['from' => $this->lineNumber, 'to' => $number, 'msg' => $message,
            'uname' => $this->username, 'pass' => $this->password];
        $result = $client->get('http://ippanel.com/class/sms/webservice/send_url.php', [
            'query' => $query,
        ]);
        $data =  json_decode($result->getBody(), true);
        if (gettype($data) == 'array' && $data[0] != 0){
            Log::info($data[1]);
            throw new Exception($data[1]);
        }
    }

    private function sendSMSKavehNegar($message, $number)
    {
        $client = new Client();
        $query = ['sender' => $this->kavenegar_sender, 'receptor' => $number, 'message' => $message];

        $result = $client->get('https://api.kavenegar.com/v1/'.$this->kavenegar_api_key.'/sms/send.json', [
            'query' => $query,
        ]);
    }

    public function sendNOTIFICATION($text, $id, $subject, $model_id)
    {
        return app(NotificationRepositoryInterface::class)->create([
            'subject' => $subject,
            'content' => $text,
            'user_id' => $id,
            'model' => $subject,
            'model_id' => $model_id,
            'type' => NotificationEnum::PRIVATE,
        ]);
    }

    public function sendCode($code, $phone)
    {
        if ($this->smsPanel == NotificationEnum::KAVEH_NEGAR_SMS_PANEL) {
            $this->sendCodeKavehNegar($code , $phone);
        } else {
            $this->sendCodeFarazSMS($code , $phone);
        }
    }

    /**
     * @throws Exception
     */
    public function sendCodeFarazSMS($code, $phone)
    {
        try {
            $client = new Client();
            $query = Arr::query([
                'username' => $this->username,
                'password' => $this->password,
                'from' => $this->lineNumber,
                'to' => $phone,
                'pattern_code' => $this->pattern,
                'input_data' => json_encode([
                    $this->pattern_var => $code
                ]),
            ]);

            $result = $client->post("https://ippanel.com/patterns/pattern"."?$query");
            $data =  json_decode($result->getBody(), true);
            if ($data['code'] != 0) {
                Log::info($data['message']);
                throw new Exception($data['message']);
            }
        } catch (GuzzleException|Exception  $e) {
            return "ERROR";
        }
    }

    public function sendCodeKavehNegar($code, $phone)
    {
        $url = 'https://api.kavenegar.com/v1/'.$this->kavenegar_api_key.'/verify/lookup.json';

        $client = new Client();
        $query = ['template' => $this->kavenegar_template, 'receptor' => $phone, 'token' => $code];

        $result = $client->get($url, [
            'query' => $query,
        ]);
    }

    public function sendEmail(MailableContract $mailable, $email)
    {
        Mail::to($email)->send($mailable);
    }
}
