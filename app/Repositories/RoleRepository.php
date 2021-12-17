<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        return $this->role->get();
    }

    public function getById($id)
    {
        return $this->role->where('id', $id)->firstOrFail();
    }

    public function getByName($name)
    {
        return $this->role->where('name', $name)->firstOrFail();
    }
}