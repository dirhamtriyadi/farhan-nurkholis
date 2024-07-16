<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'stock-barang.list',
            'stock-barang.create',
            'stock-barang.edit',
            'stock-barang.delete',
            'barang-masuk.list',
            'barang-masuk.create',
            'barang-masuk.edit',
            'barang-masuk.delete',
            'barang-keluar.list',
            'barang-keluar.create',
            'barang-keluar.edit',
            'barang-keluar.delete',
            'laporan.list',
            'user.list',
            'user.create',
            'user.edit',
            'user.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
