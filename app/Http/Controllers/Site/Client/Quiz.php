<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Crypt;

class Quiz extends BaseComponent
{
    public $transcript ;
    public ?string $token = null;
    public mixed $user;
    public bool $userDetails = false;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
    }

    public function mount(SettingRepositoryInterface $settingRepository,$id)
    {
        $this->user = auth()->user();
        $this->transcript = $this->transcriptRepository->find($id,$this->user);
        SEOMeta::setTitle($settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->userDetails = !empty($this->user->details);
    }

    public function enter_quiz()
    {
        if ($this->userDetails) {
            if ($this->transcript->result == QuizEnum::PENDING) {
                $this->transcript->result = QuizEnum::SUSPENDED;
                $this->generate_token(QuizEnum::PENDING);
                $this->transcript->token = $this->token;
                $this->transcript->timer = Carbon::make(now())->addMinutes((int)ceil($this->transcript->quiz->time));
                $this->transcriptRepository->deleteAnswer($this->transcript,$this->transcript->quiz->questions->pluck('id','id'));
                $this->transcriptRepository->save($this->transcript);
                return redirect()->route('user.exam',['token' =>  $this->token]);
            } elseif ($this->transcript->result == QuizEnum::SUSPENDED) {
                try {
                    if (!empty($this->transcript->timer))
                        $interval = Carbon::make(now())->diff(Carbon::make($this->transcript->timer));
                    if (isset($interval) && (int)$interval->format("%r") >= "") {
                        $this->generate_token(QuizEnum::SUSPENDED);
                        $this->transcript->token = $this->token;
                        $this->transcriptRepository->deleteAnswer($this->transcript,$this->transcript->quiz->questions->pluck('id','id'));
                        $this->transcriptRepository->save($this->transcript);
                        return redirect()->route('user.exam',['token' =>  $this->token]);
                    }
                    return $this->emitNotify('این ازمون به اتمام رسیده است.','warning');
                } catch (Exception $e) {
                    return $this->emitNotify('خطا در هنگام ورود به ازمون','warning');
                }
            }
            return $this->emitNotify('این ازمون به اتمام رسیده است.','warning');
        }
        return $this->emitNotify('<b class="text-danger">توجه</b> : کاربر گرامی قبل از شروع ازمون می بایست پروفایل خود را تکمیل نمایید.','warning');
    }

    private function generate_token($result)
    {
        $start_memory_usage = memory_get_usage();
        $sections = [
            'sec1' => time() + 5 * 60,
            'sec2' => auth()->id().'$'.$this->transcript->id.'$'.request()->ip(),
        ];
        $sections['sec3'] = match ($result) {
            QuizEnum::PENDING =>  base64_encode(mt_rand(1,9)),
            QuizEnum::SUSPENDED => base64_encode(mt_rand(10,99)),
            default => base64_encode(mt_rand(100,999)),
        };
        $sections['sec4'] = abs(memory_get_usage() - $start_memory_usage);
        $this->token = Crypt::encryptString(implode('-',$sections));
    }



    public function render()
    {
        return view('site.client.quiz')->extends('site.layouts.client.client');
    }
}
