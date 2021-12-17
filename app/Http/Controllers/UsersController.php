<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermisisonRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $roles = $this->role->getAll();
        return view('pages.users.index', compact('users', 'roles'));
    }
    
    public function store(StoreUserRequest $request, USerService $service)
    {
        $service->create($request->all());
        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = $this->user->getByID($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, UserService $service, $id)
    {
        $service->update($request->all(), $id);
        return redirect()->route('users.index')->with('success', 'User berhasil diubah');
    }

    public function destroy(UserService $service, $id)
    {
        $service->delete($id);
        return redirect()->back()->with('success', 'User berhasil dihapus');
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
