<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $user = User::create([
            'name' => 'err',
            'username' => 'err',
            'password' => Hash::make('123qweasd'),
        ]);
        $user->assignRole($role);
    }
}
