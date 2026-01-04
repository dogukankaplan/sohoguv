<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Yeni Nesil Güvenlik Teknolojileri',
                'subtitle' => 'Akıllı kamera sistemleri ile işletmenizi 7/24 koruyun',
                'description' => 'Yapay zeka destekli kamera sistemleri, yüz tanıma ve hareket algılama özellikleri ile güvenliğinizi üst seviyeye taşıyın.',
                'button_text' => 'Hemen Keşfedin',
                'button_link' => '/services',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Alarm Sistemleri ile Tam Koruma',
                'subtitle' => 'Profesyonel alarm çözümleri ile hırsızlığa karşı tam önlem',
                'description' => '81 ilde kurulum ve 7/24 teknik destek ile alarm sistemleriniz her zaman aktif.',
                'button_text' => 'Teklif Alın',
                'button_link' => '/contact',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Yangın Algılama Sistemleri',
                'subtitle' => 'Erken müdahale ile can ve mal güvenliği',
                'description' => 'Akıllı yangın algılama sistemleri ile riskleri minimize edin, güvenle yaşayın.',
                'button_text' => 'Daha Fazla Bilgi',
                'button_link' => '/services',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }

        $this->command->info('✓ 3 örnek slider oluşturuldu!');
    }
}
