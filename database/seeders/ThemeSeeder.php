<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'slug' => 'modern',
                'name' => 'Memora Modern',
                'description' => 'Elegan, Bersih, dan Berkelas.',
                'tag' => 'Premium',
                'color' => '#0F172A'
            ],
            [
                'slug' => 'minimalist',
                'name' => 'White Minimalist',
                'description' => 'Sederhana namun penuh makna.',
                'tag' => 'Gratis',
                'color' => '#334155'
            ],
            [
                'slug' => 'rustic',
                'name' => 'Rustic Forest',
                'description' => 'Kehangatan alam yang romantis.',
                'tag' => 'Premium',
                'color' => '#5d4037',
            ],
            [
                'slug' => 'royal',
                'name' => 'Royal Night',
                'description' => 'Kemewahan emas di keheningan malam.',
                'tag' => 'Premium',
                'color' => '#d4af37'
            ],
            [
                'slug' => 'ethereal',
                'name' => 'Ethereal Garden',
                'description' => 'Pengalaman magis dengan animasi penuh.',
                'tag' => 'Premium+',
                'color' => '#0F172A'
            ],
            [
                'slug' => 'sage-organic',
                'name' => 'Sage Organic',
                'description' => 'Modern organic, sage green, dan interaktif.',
                'tag' => 'Premium+',
                'color' => '#7d8e7b'
            ],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(['slug' => $theme['slug']], $theme);
        }
    }
}
