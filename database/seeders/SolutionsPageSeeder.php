<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolutionsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Hero Section for Solutions Page
        Section::updateOrCreate(
            ['type' => 'solutions_hero'],
            [
                'title' => 'Kurumsal Çözümlerimiz',
                'subtitle' => 'Kurumsal',
                'content' => 'İşletmenizin ihtiyaçlarına özel, uçtan uca entegre güvenlik ve teknoloji altyapıları tasarlıyoruz.',
                'is_active' => true,
                'order' => 1,
            ]
        );

        // 2. CTA Section for Solutions Page
        Section::updateOrCreate(
            ['type' => 'solutions_cta'],
            [
                'title' => 'Projeniz İçin Hazırız',
                'subtitle' => null,
                'content' => 'Kurumsal güvenlik ve teknoloji ihtiyaçlarınız için ücretsiz keşif ve danışmanlık hizmetimizden yararlanın.',
                'is_active' => true,
                'order' => 99,
            ]
        );

        // 3. Stats Settings
        $settings = [
            'solutions_stat_1_value' => '500+',
            'solutions_stat_1_label' => 'Tamamlanan Proje',
            'solutions_stat_2_value' => '%98',
            'solutions_stat_2_label' => 'Müşteri Memnuniyeti',
            'solutions_stat_3_value' => '24/7',
            'solutions_stat_3_label' => 'Kesintisiz Destek',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
