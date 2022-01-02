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
            ['name' => 'lihat user'],
            ['name' => 'tambah user'],
            ['name' => 'tambah user'],
            ['name' => 'hapus user'],
            ['name' => 'lihat barang'],
            ['name' => 'tambah barang'],
            ['name' => 'edit barang'],
            ['name' => 'hapus barang'],
            ['name' => 'laporan'],
            ['name' => 'cek riwayat'],
            ['name' => 'penjualan'],
            ['name' => 'pembelian'],
            ['name' => 'pengembalian'],
        ];

        Permission::insert($permissions);
    }
}
