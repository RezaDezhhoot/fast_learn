<?php

namespace App\Observers;

use App\Models\Organization;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function created(Organization $organization)
    {
        //
    }

    /**
     * Handle the Organization "updated" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function updated(Organization $organization)
    {
        //
    }

    /**
     * Handle the Organization "deleted" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function deleted(Organization $organization)
    {
        try {
            DB::beginTransaction();
            $organization->child()->forceDelete();
            $organization->courses()->update(['organization_id' => null]);
            foreach ($organization->users as $value) 
                if (!is_null($value->details)) 
                    $value->details->details->update(['organization_id' => null]);
                
        
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $organization->restore();
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the Organization "restored" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function restored(Organization $organization)
    {
        //
    }

    /**
     * Handle the Organization "force deleted" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function forceDeleted(Organization $organization)
    {
        //
    }
}
