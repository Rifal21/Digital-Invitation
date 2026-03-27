<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Utama (Rifal)
        User::create([
            'name' => 'Rifal Admin',
            'email' => 'rifal@gmail.com',
            'password' => Hash::make('falkur21'),
            'role' => 'admin',
        ]);

        // Secondary Admin
        User::create([
            'name' => 'Admin Amora',
            'email' => 'admin@amora.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular User
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
        ]);

        $this->call([
            ThemeSeeder::class,
            PackageSeeder::class,
            PaymentMethodSeeder::class,
        ]);

        // Global Settings
        \App\Models\Setting::set('admin_fee', '2500');
    }
}
