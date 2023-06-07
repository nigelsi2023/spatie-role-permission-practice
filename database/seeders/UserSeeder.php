<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $user_index = Permission::create(['name' => 'users.index']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_read = Permission::create(['name' => 'users.read']);
        $user_update = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);

        // Role Create and Permission Assign for Role
        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $user_index,
            $user_create,
            $user_read,
            $user_update,
            $user_delete
        ]);

        $user_role = Role::create(['name' => 'user']);
        $user_role->givePermissionTo([
            $user_index,
            $user_read
        ]);

        $admin = User::create([
            'name' => 'Demo Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678')
        ]);
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'user@mail.com',
            'password' => bcrypt('12345678')
        ]);
        
        $admin->assignRole($admin_role);
        $user->assignRole($user_role);
    }
}
