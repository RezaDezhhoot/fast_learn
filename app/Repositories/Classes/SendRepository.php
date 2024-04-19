<?php


namespace App\Repositories\Classes;

use App\Enums\NotificationEnum;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

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
}
