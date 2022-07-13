<?php

namespace App\Observers;

use App\Models\Homework;

class HomeworkObserver
{
    /**
     * Handle the Homework "created" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function created(Homework $homework)
    {
        //
    }

    /**
     * Handle the Homework "updated" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function updated(Homework $homework)
    {
        //
    }

    /**
     * Handle the Homework "deleted" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function deleted(Homework $homework)
    {
        $homeworkDisk = getDisk($homework->storage);
        if (!empty($homework->file) && $homeworkDisk->exists($homework->file))
            $homeworkDisk->delete($homework->file);
    }

    /**
     * Handle the Homework "restored" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function restored(Homework $homework)
    {
        //
    }

    /**
     * Handle the Homework "force deleted" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function forceDeleted(Homework $homework)
    {
        //
    }
}
