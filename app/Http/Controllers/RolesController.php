<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Repositories\RoleRepository;
use App\Services\RoleService;

class RolesController extends Controller
{
    private $role;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->role = $roleRepository;
        // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:role-create', ['only' => ['store']]);
        // $this->middleware('permission:role-edit', ['only' => ['update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = $this->role->getAll();
        return view('pages.roles', compact('roles'));
    }

    public function store(StoreRoleRequest $request, RoleService $service)
    {
        $service->create($request->all());
        return redirect()->back()->with('succcess', 'Role baru berhasil ditambahkan');
    }

    public function update(StoreRoleRequest $request, RoleService $service, $id)
    {
        $service->update($request->all(), $id);
        return redirect()->back()->with('success', 'Role berhasil diubah');
    }

    public function destroy(RoleService $service, $id)
    {
        $service->delete($id);
        return redirect()->back()->with('success', 'Role berhasil dihapus');
    }
}
