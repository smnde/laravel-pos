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
            ['name' => 'lihat user', 'guard' => 'web'],
            ['name' => 'tambah user', 'guard' => 'web'],
            ['name' => 'tambah user', 'guard' => 'web'],
            ['name' => 'hapus user', 'guard' => 'web'],
            ['name' => 'lihat barang', 'guard' => 'web'],
            ['name' => 'tambah barang', 'guard' => 'web'],
            ['name' => 'edit barang', 'guard' => 'web'],
            ['name' => 'hapus barang', 'guard' => 'web'],
            ['name' => 'laporan', 'guard' => 'web'],
            ['name' => 'cek riwayat', 'guard' => 'web'],
            ['name' => 'penjualan', 'guard' => 'web'],
            ['name' => 'pembelian', 'guard' => 'web'],
            ['name' => 'pengembalian', 'guard' => 'web'],
        ];

        Permission::insert($permissions);
    }
}
