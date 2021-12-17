<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAll()
    {
        return $this->permission->get();
    }

    public function getById($id)
    {
        return $this->permission->where('id', $id)->firstOrFail();
    }
}