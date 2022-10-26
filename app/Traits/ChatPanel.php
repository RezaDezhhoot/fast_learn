<?php

namespace App\Traits;

use App\Enums\CourseEnum;
use App\Enums\StorageEnum;
use App\Repositories\Interfaces\NewCourseChatRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Illuminate\Support\Facades\Log;

trait ChatPanel
{
    public $chatText , $file = [] ;

    public function sendChatText(): void
    {
        $this->validate([
            'chatText' => ['required','string','max:72000'],
            'file' => ['nullable','array','max:15'],
            'file.*' => ['required','file','max:20480','mimes:png,jpg,rar,zip,pdf']
        ],[],[
            'chatText' => 'متن پیام',
            'file' => 'فایل ها',
            'file.*' => 'فایل ها',
        ]);
        $chat = app(NewCourseChatRepositoryInterface::class)->create([
            'message' => $this->chatText,
            'user_id' => auth()->id(),
            'new_course_request_id' => $this->course->id,
            'files' => $this->uploadFiles()
        ]);

        if ($this->component == 'admin') {
            $status = CourseEnum::NEW_COURSE_ANSWERED;
        } else {
            $status = CourseEnum::NEW_COURSE_TEACHER_ANSWERED;
        }
        $this->course->status = $status;
        app(NewCourseRepositoryInterface::class)->save($this->course);
        $this->course->chats->push($chat);
        $this->reset(['chatText','file']);
        $this->emitNotify('پیا با موفقیت ارسال شد');
    }

    private function uploadFiles()
    {
        $file = [];
        foreach ($this->file as $value) {
            if (isset($value) && !empty($value))
                $file[] = getDisk(StorageEnum::PRIVATE)->put('new_courses/'.$this->course->title, $value);
        }

        return $file;
    }

    public function updatedFile()
    {
//        dd($this->file);
    }

    public function download($file)
    {
        try {
            return getDisk(StorageEnum::PRIVATE)->download($file);
        } catch (\Exception $e) {
            $this->emitNotify('خظا در هنگام دانلود فایل','warning');
            Log::error($e->getMessage());
        }
    }
}
