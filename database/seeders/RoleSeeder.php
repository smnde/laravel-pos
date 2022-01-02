<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
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
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'hapus user']);
        Permission::create(['name' => 'lihat barang']);
        Permission::create(['name' => 'tambah barang']);
        Permission::create(['name' => 'edit barang']);
        Permission::create(['name' => 'hapus barang']);
        Permission::create(['name' => 'penjualan']);
        Permission::create(['name' => 'pembelian']);
        Permission::create(['name' => 'pengembalian']);
        Permission::create(['name' => 'pembelian']);
        Permission::create(['name' => 'cek histori']);
    }
}
