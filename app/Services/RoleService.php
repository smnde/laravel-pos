<?php

namespace App\Services;

use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepository;

class RoleService
{
    protected $role;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->role = $roleRepository;
    }

    public function create($data)
    {
        $role = Role::create(['name' => $data['name']]);
        return $role;
    }

    public function update($data, $id)
    {
        $role = $this->role->getByID($id);
        $role->update(['name' => $data['name']]);
        return $role;
    }

    public function delete($id)
    {
        $this->role->getByID($id)->delete();
    }
}