<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepository;

class PermissionService
{
    protected $permission;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permission = $permissionRepository;
    }

    public function create($data)
    {
        $permission = Permission::create(['name' => $data['name']]);
        return $permission;
    }

    public function delete($id)
    {
        $this->permission->where('id', $id)->delete();
    }
}