<?php

namespace App\Actions\dashboard\Access\Permission;

use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionAction
{
    public function execute($PermissionData)
    {

        $guardName = $PermissionData->guard_name;
        $name = $PermissionData->name;
        $mainPermission = Permission::updateOrCreate(
            ['slug' => $PermissionData->slug],
            [
                'name' => $name,
                'guard_name' => $guardName,
            ]
        );

        return $mainPermission;
    }
}
