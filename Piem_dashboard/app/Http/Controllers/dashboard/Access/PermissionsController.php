<?php

namespace App\Http\Controllers\dashboard\Access;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTransferObjects\PermissionData;
use App\Actions\dashboard\Access\Permission\PermissionAction;
use App\Actions\dashboard\Access\Permission\PermissionActionDelete;

class PermissionsController extends Controller
{
    public function index()
    {
        $limit = 10;
        $permissions = Permission::select('name','guard_name','slug')->orderBy('name')->paginate($limit);
        $count = $permissions->total();
        $no = $limit * ($permissions->currentPage() - 1);

        return view('content.dashboard.access.permissions.index', compact('permissions', 'count','no'));
    }

    public function create()
    {
        return view('content.dashboard.access.permissions.create');
    }

    public function store(PermissionData $PermissionData, PermissionAction $permissionAction)
    {
        $permissionAction->execute($PermissionData);
        flash()->success('Success Menambahkan Task');

        return redirect()->route('dashboard.access.permissions.index');
    }

    public function show(Permission $permission)
    {
        return view('content.dashboard.access.permisions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('content.dashboard.access.permissions.edit', compact('permission'));
    }


    public function update(PermissionData $PermissionData, PermissionAction $permissionAction, Permission $permission)
    {
        $permissionAction->execute($PermissionData, $permission);
        flash()->success('Success Update Permission');

        return redirect()->route('dashboard.access.permissions.index');
    }

    public function destroy(PermissionActionDelete $permissionActionDelete, $slug)
    {
        $permission = $permissionActionDelete->execute($slug);

        // Assuming you have a flash() function or similar for flashing messages
        flash()->success('Permission deleted successfully.');

        return redirect()->route('dashboard.access.permissions.index');
    }
}
