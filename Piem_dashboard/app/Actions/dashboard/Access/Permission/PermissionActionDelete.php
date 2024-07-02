<?php

namespace App\Actions\dashboard\Access\Permission;

use App\Models\Permission;

class PermissionActionDelete
{
    public function execute($slug)
    {
        $permission = Permission::where('slug', $slug)->firstOrFail();
        $permission->delete();
        return $permission;
    }
}
