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
        // 1. Main Introduction Video (Top)
        $introExists = DB::table('sections')
            ->where('type', 'video')
            ->where('title', 'Tanıtım Videomuz')
            ->exists();

        if (!$introExists) {
            DB::table('sections')->insert([
                'type' => 'video',
                'title' => 'Tanıtım Videomuz',
                'subtitle' => 'SOHO GÜVENLİK',
                'content' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'image' => null,
                'bg_color' => null,
                'settings' => null,
                'order' => 2, // After Hero
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. ColorVu 3.0 Technology Video (Bottom)
        $colorVuExists = DB::table('sections')
            ->where('type', 'video')
            ->where('title', 'ColorVu 3.0 Teknolojisi')
            ->exists();

        if (!$colorVuExists) {
            DB::table('sections')->insert([
                'type' => 'video',
                'title' => 'ColorVu 3.0 Teknolojisi',
                'subtitle' => 'KARANLIKTA BİLE RENKLİ GÖRÜNTÜ',
                'content' => 'https://www.youtube.com/watch?v=E8lir7rf4rY', // Hikvision ColorVu Demo
                'image' => null,
                'bg_color' => 'bg-slate-900', // Dark theme for tech vibe
                'settings' => null,
                'order' => 9, // After Solution Partners (approx order 8)
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
