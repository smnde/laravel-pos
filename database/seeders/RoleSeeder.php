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
        $permissions = [
            ['name' => 'lihat user', 'guard_name' => 'web'],
            ['name' => 'tambah user', 'guard_name' => 'web'],
            ['name' => 'tambah user', 'guard_name' => 'web'],
            ['name' => 'hapus user', 'guard_name' => 'web'],
            ['name' => 'lihat barang', 'guard_name' => 'web'],
            ['name' => 'tambah barang', 'guard_name' => 'web'],
            ['name' => 'edit barang', 'guard_name' => 'web'],
            ['name' => 'hapus barang', 'guard_name' => 'web'],
            ['name' => 'laporan', 'guard_name' => 'web'],
            ['name' => 'cek riwayat', 'guard_name' => 'web'],
            ['name' => 'penjualan', 'guard_name' => 'web'],
            ['name' => 'pembelian', 'guard_name' => 'web'],
            ['name' => 'pengembalian', 'guard_name' => 'web'],
        ];

        Permission::insert($permissions);
    }
}
