<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'Bank BCA',
            'account_number' => '1234567890',
            'account_name' => 'Memora Studio Digital',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'DANA',
            'account_number' => '0812-3456-7890',
            'account_name' => 'Memora Studio Digital',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Bank Mandiri',
            'account_number' => '9876543210',
            'account_name' => 'Memora Studio Digital',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'DOKU (Otomatis)',
            'account_number' => 'GATEWAY',
            'account_name' => 'OFFICIAL PAYMENT GATEWAY',
            'is_active' => true,
        ]);
    }
}
