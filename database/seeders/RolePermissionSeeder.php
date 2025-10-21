<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Tạo Permissions
        $permissions = [
            // User permissions
            'view bookings',
            'create bookings',
            'update bookings',
            'delete bookings',
            'view payments',
            'create reviews',

            // Admin permissions
            'manage users',
            'manage parking lots',
            'manage bookings',
            'manage payments',
            'manage reviews',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Tạo Role: User
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view bookings',
            'create bookings',
            'update bookings',
            'delete bookings',
            'view payments',
            'create reviews',
        ]);

        // Tạo Role: Admin
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all()); // Admin có tất cả quyền

        // Gán role cho user đã tồn tại
        $users = User::all();
        foreach ($users as $user) {
            if ($user->role === 'admin') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
            }
        }

        $this->command->info('✅ Roles và Permissions đã được tạo thành công!');
    }
}
