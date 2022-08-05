<?php

namespace App\Observers;

use App\Models\Executive;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try {
            DB::beginTransaction();
            $executive->child()->forceDelete();
            $executive->courses()->update(['executive_id' => null]);
            foreach ($executive->users as $value) 
                if (!is_null($value->details)) 
                    $value->details->details->update(['executive_id' => null]);
                
        
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $executive->restore();
            Log::error($e->getMessage());
        }
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
