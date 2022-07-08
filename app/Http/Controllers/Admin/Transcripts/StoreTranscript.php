<?php

namespace App\Http\Controllers\Admin\Transcripts;

use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class StoreTranscript extends BaseComponent
{
    public  $header , $result , $user , $quiz , $score , $course , $certificate_code , $certificate_date;
    public object $transcript;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_transcripts');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->transcript = $this->transcriptRepository->find($id);
            $this->result = $this->transcript->result;
            $this->course = $this->transcript->course_id;
            $this->score = $this->transcript->score;
            $this->certificate_code = $this->transcript->certificate_code;
            $this->certificate_date = $this->transcript->certificate_date;
        } elseif ($this->mode == self::CREATE_MODE)
            $this->header = 'کارنامه جدید';
        else abort(404);

        $this->data['result'] = QuizEnum::getResult();
        $this->data['user'] = $this->userRepository->getAll()->pluck('phone','id');
        $this->data['quiz'] = $this->quizRepository->getAll()->pluck('name','id');
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function store()
    {
        $this->certificate_code = $this->emptyToNull($this->certificate_code);
        $this->certificate_date = $this->emptyToNull($this->certificate_date);
       if ($this->mode == self::UPDATE_MODE) {
           $this->validate([
               'result' => ['required','in:'.implode(',',array_keys(QuizEnum::getResult()))],
               'score' => ['nullable','numeric'],
               'certificate_date' => ['nullable','date_format:Y/m/d'],
               'certificate_code' => ['nullable','unique:transcripts,certificate_code,'.($this->transcript->id)]
           ],['date_format' => 'تاریخ صدرو باید از الگو 0000/00/00 پیروی کند'],[
               'result' => 'نتیجه ازمون',
               'score' => 'نمره',
               'certificate_date' => 'تاریخ صدور',
               'certificate_code' => 'شماره گواهینامه'
           ]);
           $this->saveInDataBase();
       } elseif ($this->mode == self::CREATE_MODE) {
           $this->validate([
               'result' => ['required','in:'.implode(',',array_keys(QuizEnum::getResult()))],
               'user' => ['required','exists:users,phone'],
               'quiz' => ['required','exists:quizzes,id'],
               'course' => ['required','exists:courses,id'],
               'score' => ['nullable','numeric'],
           ],[],[
               'result' => 'نتیجه ازمون',
               'user' => 'شماره همراه کاربر',
               'quiz' => 'امتحان',
               'course' => 'دوره',
               'score' => 'نمره',
           ]);
           $transcript = [
               'user_id' => $this->userRepository->findBy([['phone',$this->user]])->id,
               'quiz_id' => $this->quiz,
               'course_id' => $this->course,
               'score' => $this->score,
               'result' => $this->result,
               'course_data' => json_encode([
                   'id' => $this->course,
                   'title' => $this->courseRepository->find($this->course)->title,
               ])
           ];
           $this->transcript = $this->transcriptRepository->create($transcript);
           $this->saveInDataBase();
           $this->reset(['user','quiz','score','result']);
       }
    }

    public function saveInDataBase()
    {
        $old_result = $this->transcript->result;
        $this->transcript->result = $this->result;
        $this->transcript->score = $this->score;
        $quiz_has_certificate = !empty($this->transcript->quiz->certificate);
        $certificate_id = $quiz_has_certificate ? $this->transcript->quiz->certificate->id : null;
        $this->transcript->certificate_date = $this->certificate_date;
        $this->transcript->certificate_code = $this->certificate_code;
        try {
            DB::beginTransaction();
            switch ($this->result){
                case QuizEnum::PASSED:
                    if ($quiz_has_certificate and
                        !$this->userRepository->has_certificate($this->transcript->user,$certificate_id,$this->transcript->id)) {
                        $this->userRepository->submit_certificate($this->transcript->user,$certificate_id,$this->transcript->id);
                    }
                    break;
                case QuizEnum::REJECTED || QuizEnum::SUSPENDED || QuizEnum::PENDING:
                    if ($quiz_has_certificate and
                        $this->userRepository->has_certificate($this->transcript->user,$certificate_id,$this->transcript->id)) {
                        $this->userRepository->reclaiming_certificate($this->transcript->user,$certificate_id,$this->transcript->id);
                        $this->transcript->certificate_date = null;
                        $this->transcript->certificate_code = null;
                    }
                    break;
            }
            $this->transcriptRepository->save($this->transcript);
            DB::commit();
            $message = 'اطلاعات با موفقیت ثبت شد';
        } catch (Exception $e) {
            DB::rollBack();
            $this->transcript->result = $old_result;
            $message = 'خظا در هنگام ثبت اطلاعات';
            $icon = 'warning';
        }
        return $this->emitNotify($message,$icon ?? 'success');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_transcripts');
        $this->transcriptRepository->destroy($this->transcript->id);
        return redirect()->route('admin.transcript');
    }

    public function render()
    {
        return view('admin.transcripts.store-transcript')->extends('admin.layouts.admin');
    }
}
