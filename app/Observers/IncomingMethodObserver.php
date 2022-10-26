<?php

namespace App\Observers;

use App\Models\IncomingMethod;

class IncomingMethodObserver
{
    /**
     * Handle the IncomingMethod "created" event.
     *
     * @param  \App\Models\IncomingMethod  $incomingMethod
     * @return void
     */
    public function created(IncomingMethod $incomingMethod)
    {
        //
    }

    /**
     * Handle the IncomingMethod "updated" event.
     *
     * @param  \App\Models\IncomingMethod  $incomingMethod
     * @return void
     */
    public function updated(IncomingMethod $incomingMethod)
    {
        //
    }

    /**
     * Handle the IncomingMethod "deleted" event.
     *
     * @param  \App\Models\IncomingMethod  $incomingMethod
     * @return void
     */
    public function deleted(IncomingMethod $incomingMethod)
    {
        $incomingMethod->courses()->update([
            'incoming_method_id' => null
        ]);
    }

    /**
     * Handle the IncomingMethod "restored" event.
     *
     * @param  \App\Models\IncomingMethod  $incomingMethod
     * @return void
     */
    public function restored(IncomingMethod $incomingMethod)
    {
        //
    }

    /**
     * Handle the IncomingMethod "force deleted" event.
     *
     * @param  \App\Models\IncomingMethod  $incomingMethod
     * @return void
     */
    public function forceDeleted(IncomingMethod $incomingMethod)
    {
        $incomingMethod->courses()->update([
            'incoming_method_id' => null
        ]);
    }
}
