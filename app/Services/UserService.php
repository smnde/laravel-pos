<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserService
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function create($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['role']);
        return $user;
    }

    public function update($data, $id)
    {
        $user = $this->user->getByID($id);
        $user->update([
            'name' => $data['name'],
            'username' => $data['username'],
        ]);
        return $user;
    }

    public function delete($id)
    {
        $this->user->getByID($id)->delete();
    }

}