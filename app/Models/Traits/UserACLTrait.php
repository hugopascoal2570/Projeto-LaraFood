<?php

namespace App\Models\Traits;

use App\Models\Permission;

trait UserACLTrait
{
    public function permissions()
    {

        $tenant = $this->tenant;
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }

    public function hasPermission(String $PermissionName): bool
    {

        return in_array($PermissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
