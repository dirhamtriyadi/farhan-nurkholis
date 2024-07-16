<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $role = Role::create(['name' => 'manager']);

        $permissions = Permission::where('name', 'like', 'laporan.list')->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $manager->assignRole([$role->id]);

        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $role = Role::create(['name' => 'staff']);

        $permissions = Permission::whereIn('name', ['barang-masuk.list', 'barang-masuk.create', 'barang-keluar.list', 'barang-keluar.create'])->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $staff->assignRole([$role->id]);
    }
}
