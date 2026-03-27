<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::updateOrCreate(
            ['slug' => 'digital-invitation'],
            [
                'name' => 'Paket Digital Invitation',
                'price' => 50000,
                'description' => 'Akses penuh ke semua tema undangan digital premium Amora.',
                'features' => [
                    'Semua Tema Premium',
                    'Smooth Scrolling & Animasi',
                    'Digital Gift & Gift Cards',
                    'Masa Aktif Selamanya',
                    'Revisi Tanpa Batas'
                ]
            ]
        );

        Package::updateOrCreate(
            ['slug' => 'digital-plus-guestbook'],
            [
                'name' => 'Paket Digital + Buku Tamu Online',
                'price' => 99000,
                'description' => 'Solusi lengkap undangan digital dengan sistem buku tamu online cerdas.',
                'features' => [
                    'Semua Fitur Digital Invitation',
                    'Scan QR Code Buku Tamu',
                    'Data Kehadiran Realtime',
                    'Custom Message & Wishes VIP',
                    'Laporan Rekap Tamu (Excel)',
                    'Dashboard Buku Tamu Eksklusif'
                ]
            ]
        );
    }
}
