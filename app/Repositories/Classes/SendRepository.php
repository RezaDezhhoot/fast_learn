<?php


namespace App\Repositories\Classes;

use App\Enums\NotificationEnum;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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

    public function sendSMS($message, $number)
    {
        try {
            $client = new Client();
            $query = ['from' => $this->lineNumber, 'to' => $number, 'msg' => $message,
                'uname' => $this->username, 'pass' => $this->password];
            $result = $client->get('http://ippanel.com/class/sms/webservice/send_url.php', [
                'query' => $query,
            ]);
            return json_decode($result->getBody(), true);
        } catch (GuzzleException $e) {
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

    public function sendCode($code, $phone)
    {
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
        return json_decode($result->getBody(), true);
    }
}
