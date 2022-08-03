<?php

namespace App\Observers;

use App\Models\Executive;

class ExecutiveObserver
{
    /**
     * Handle the Executive "created" event.
     *
     * @param  \App\Models\Executive  $executive
     * @return void
     */
    public function created(Executive $executive)
    {
        //
    }

    /**
     * Handle the Executive "updated" event.
     *
     * @param  \App\Models\Executive  $executive
     * @return void
     */
    public function updated(Executive $executive)
    {
        //
    }

    /**
     * Handle the Executive "deleted" event.
     *
     * @param  \App\Models\Executive  $executive
     * @return void
     */
    public function deleted(Executive $executive)
    {
        //
    }

    /**
     * Handle the Executive "restored" event.
     *
     * @param  \App\Models\Executive  $executive
     * @return void
     */
    public function restored(Executive $executive)
    {
        //
    }

    /**
     * Handle the Executive "force deleted" event.
     *
     * @param  \App\Models\Executive  $executive
     * @return void
     */
    public function forceDeleted(Executive $executive)
    {
        //
    }
}
