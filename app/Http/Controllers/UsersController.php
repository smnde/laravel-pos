<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermisisonRequest;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    private $user, $role, $permission;
    
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->user = $userRepository;
        $this->role = $roleRepository;
        $this->permission = $permissionRepository;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('pages.users.index', compact('users'));
    }
    
    public function store(StoreUserRequest $request, USerService $service)
    {
        $service->create($request->all());
        return redirect()->back()->with('success', 'User baru berhasil ditambahkan');
    }

    public function update(StoreUserRequest $request, UserService $service, $id)
    {
        $service->update($request->all(), $id);
        return response('success');
    }

    public function destroy(UserService $service, $id)
    {
        $service->delete($id);
        return response('success');
    }

    public function roles($id)
    {
        $user = $this->user->getById($id);
        $roles = $this->role->getAll()->pluck('name');
        return view('pages.users.set_role', compact('user', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $this->validate($request, ['role' => 'required']);
        $user = $this->user->getById($id);
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'Role berhasil di set');
    }

    public function permission(Request $request)
    {
        $role = $request->get('role');
        $permissions = null;
        $hasPermission = null;

        $roles = $this->role->getAll()->pluck('name');
        if(!empty($role)) {
            $getRole = $this->role->getByName($role);
            $hasPermission = DB::table('role_has_permissions')
                            ->select('permissions.name')
                            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                            ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            $permissions = $this->permission->getAll()->pluck('name');
        }
        return view('pages.users.permissions', compact('roles' ,'permissions', 'hasPermission'));
    }

    public function storePermission(StorePermisisonRequest $request, PermissionService $service)
    {
        $service->create($request->all());
        return redirect()->back()->with('success', 'berhasil');
    }

    public function setPermission(Request $request, $name)
    {
        $role = $this->role->getByName($name);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('success', 'berhasil');
    }
}
