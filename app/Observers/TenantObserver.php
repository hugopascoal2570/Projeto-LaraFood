<?php

namespace App\Observers;


use Illuminate\Support\Str;
use App\Models\Tenant;

class TenantObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function creating(Tenant $tenant)
    {
        $tenant->url = Str::kebab($tenant->name);
    }

    /**
     * Handle the tenant "updating" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function updating(Tenant $tenant)
    {
        $tenant->url = Str::kebab($tenant->name);
    }

    /**
     * Handle the Tenant "deleted" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function deleted(Tenant $tenant)
    {
        //
    }

    /**
     * Handle the Tenant "restored" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function restored(Tenant $tenant)
    {
        //
    }

    /**
     * Handle the Tenant "force deleted" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function forceDeleted(Tenant $tenant)
    {
        //
    }
}
