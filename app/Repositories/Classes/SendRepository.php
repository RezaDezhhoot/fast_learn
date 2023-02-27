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

    public function __construct()
    {
        $this->SettingRepository = app(SettingRepositoryInterface::class);
        $this->apiKey = $this->SettingRepository->getRow('faraz_apiKey');
        $this->username = $this->SettingRepository->getRow('faraz_username');
        $this->password = $this->SettingRepository->getRow('faraz_password');
        $this->lineNumber = $this->SettingRepository->getRow('faraz_line');
        $this->pattern = $this->SettingRepository->getRow('faraz_pattern');
        $this->pattern_var = $this->SettingRepository->getRow('faraz_var');
    }

    /**
     * @throws Exception
     */
    public function sendSMS($message, $number)
    {
        try {
            $client = new Client();
            $query = ['from' => $this->lineNumber, 'to' => $number, 'msg' => $message,
                'uname' => $this->username, 'pass' => $this->password];
            $result = $client->get('http://ippanel.com/class/sms/webservice/send_url.php', [
                'query' => $query,
            ]);
            $data =  json_decode($result->getBody(), true);
            if ($data[0] != 0){
                Log::info($data[1]);
                throw new Exception($data[1]);
            }
        } catch (GuzzleException|Exception  $e) {
            return "ERROR";
        }
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

    /**
     * @throws Exception
     */
    public function sendCode($code, $phone)
    {
        try {
            $client = new Client();
            $query = ['apikey' => $this->apiKey,
                'pid' => $this->pattern,
                'fnum' => $this->lineNumber,
                'tnum' => $phone,
                'p1' => $this->pattern_var,
                'v1' => $code];
            $result = $client->get('http://ippanel.com:8080/',
                [
                    'query' => $query,
                ]);
            $data =  json_decode($result->getBody(), true);
            if ($data['code'] != 0) {
                Log::info($data['message']);
                throw new Exception($data['message']);
            }
        } catch (GuzzleException|Exception  $e) {
            return "ERROR";
        }
    }

    public function sendEmail(MailableContract $mailable, $email)
    {
        Mail::to($email)->send($mailable);
    }
}
