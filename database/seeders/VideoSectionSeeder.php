<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, check if a video section already exists to avoid duplicates
        $exists = DB::table('sections')->where('type', 'video')->exists();

        if (!$exists) {
            DB::table('sections')->insert([
                'type' => 'video',
                'title' => 'Tanıtım Videomuz',
                'subtitle' => 'SOHO GÜVENLİK',
                'content' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Default Rick Roll (or placeholder) to prove functionality :D 
                'image' => null,
                'bg_color' => null,
                'settings' => null,
                'order' => 2, // Place it after hero (usually order 1)
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
