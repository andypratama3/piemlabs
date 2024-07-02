<?php

namespace App\Http\Controllers\dashboard\Access;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $limit = 10;
        $roles = Role::orderby('name','asc')->paginate($limit);
        $count = $roles->count();
        $no = $count - (($roles->currentPage() - 1) * $limit);

        $permissions = Permission::select('name','slug','guard_name')->groupBy('name','slug', 'guard_name')->orderBy('name')->get();
        return view('content.dashboard.access.role.index', compact('roles', 'no', 'count','permissions'));
    }

    public function create()
    {
        return view('content.dashboard.access.role.create');
    }
}
