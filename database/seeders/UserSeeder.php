<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
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

        Permission::create(['name' => 'lihat user']);
        Permission::create(['name' => 'tambah user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'hapus user']);
        Permission::create(['name' => 'lihat barang']);
        Permission::create(['name' => 'tambah barang']);
        Permission::create(['name' => 'edit barang']);
        Permission::create(['name' => 'hapus barang']);
        Permission::create(['name' => 'penjualan']);
        Permission::create(['name' => 'pembelian']);
        Permission::create(['name' => 'pengembalian']);
        Permission::create(['name' => 'cek histori']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('lihat user');
        $role->givePermissionTo('tambah user');
        $role->givePermissionTo('edit user');
        $role->givePermissionTo('hapus user');
        $role->givePermissionTo('lihat barang');
        $role->givePermissionTo('tambah barang');
        $role->givePermissionTo('edit barang');
        $role->givePermissionTo('hapus barang');

        $user = User::create([
            'name' => 'err',
            'username' => 'err',
            'password' => Hash::make('123qweasd'),
        ]);
        $user->assignRole($role);
    }
}
