<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@paspark.com',
            'password' => Hash::make('password'),
            'phone' => '0901234567',
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Test users
        $testUsers = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '0912345678',
                'role' => 'user',
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'tranthib@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '0923456789',
                'role' => 'user',
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Lê Văn C',
                'email' => 'levanc@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '0934567890',
                'role' => 'user',
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Phạm Thị D',
                'email' => 'phamthid@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '0945678901',
                'role' => 'user',
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Hoàng Văn E',
                'email' => 'hoangvane@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '0956789012',
                'role' => 'user',
                'is_active' => true,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($testUsers as $user) {
            User::create($user);
        }

        $this->command->info('Users seeded successfully!');
        $this->command->info('Admin: admin@paspark.com / password');
        $this->command->info('Test users: nguyenvana@gmail.com (and others) / password');
    }
}
