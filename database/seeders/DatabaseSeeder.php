<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private $permissions = [
        'user-list',
        'user-show',
        'user-create',
        'user-edit',
        'user-delete',
        'role-list',
        'role-show',
        'role-create',
        'role-edit',
        'role-delete',
        'permission-list',
        'permission-show',
        'permission-create',
        'permission-edit',
        'permission-delete',
    ];
    public function run(): void
    {

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
        ]);

        $admin = Role::create(['name' => 'Admin']);

        $admin->syncPermissions(Permission::all());

        $user->assignRole($admin);

    }
}
