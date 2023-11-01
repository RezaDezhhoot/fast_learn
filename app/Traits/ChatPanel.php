<?php

namespace App\Traits;

use App\Enums\CourseEnum;
use App\Enums\StorageEnum;
use App\Repositories\Interfaces\NewCourseChatRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Illuminate\Support\Facades\Log;

trait ChatPanel
{
    public $chatText , $file  ;

    public function getStorage()
    {
        return property_exists($this,'customStorage') ? $this->customStorage : StorageEnum::PRIVATE;
    }



    private function uploadFiles($dir)
    {
        if (is_array($this->file)) {
            $file = [];
            foreach ($this->file as $value) {
                if (isset($value) && !empty($value))
                    $file[] = getDisk($this->getStorage())->put($dir, $value);
            }
        } else {
            $file = '';
            if (isset($this->file) && !empty($this->file))
                $file = getDisk($this->getStorage())->put($dir, $this->file);
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
            return getDisk($this->getStorage())->download($file);
        } catch (\Exception $e) {
            $this->emitNotify('خطا در هنگام دانلود فایل','warning');
            report($e);
        }
    }
}
