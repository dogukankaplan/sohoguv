<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class HomeSectionsSeeder extends Seeder
{
    /**
     * Seed the homepage sections.
     */
    public function run(): void
    {
        // Clear existing sections first
        Section::truncate();

        $sections = [
            [
                'type' => 'hero',
                'title' => 'GÜVENLİĞİNİZ BİZİM İŞİMİZ',
                'subtitle' => 'Yeni nesil güvenlik teknolojileri ile geleceğinizi koruma altına alın.',
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-white',
                'settings' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'stats',
                'title' => null,
                'subtitle' => null,
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-gray-50',
                'settings' => json_encode([
                    'stats' => [
                        ['value' => '15+', 'label' => 'Yıllık Tecrübe'],
                        ['value' => '1000+', 'label' => 'Mutlu Müşteri'],
                        ['value' => '50+', 'label' => 'Uzman Personel'],
                        ['value' => '81', 'label' => 'İlde Hizmet'],
                    ]
                ]),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'type' => 'services',
                'title' => 'Akıllı Çözümlerimiz',
                'subtitle' => 'İşletmeniz ve eviniz için en uygun, ölçeklenebilir ve güvenilir teknoloji altyapıları.',
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-white',
                'settings' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'type' => 'features',
                'title' => 'Neden SOHO Güvenlik?',
                'subtitle' => null,
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-gray-50',
                'settings' => json_encode([
                    'features' => [
                        [
                            'title' => 'Ulusal Hizmet Ağı',
                            'description' => 'Türkiye\'nin 81 ilinde kurulum ve teknik servis desteği.'
                        ],
                        [
                            'title' => 'Garantili İşçilik',
                            'description' => 'Yapılan tüm montaj ve kurulumlarımız firma garantisi altındadır.'
                        ],
                        [
                            'title' => 'Hızlı Müdahale',
                            'description' => 'Arıza durumunda 24 saat içerisinde teknik ekip yönlendirmesi.'
                        ],
                    ]
                ]),
                'order' => 4,
                'is_active' => true,
            ],
            [
                'type' => 'clients',
                'title' => null,
                'subtitle' => null,
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-white',
                'settings' => null,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'type' => 'testimonials',
                'title' => 'Müşterilerimiz Ne Diyor?',
                'subtitle' => null,
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-gray-50',
                'settings' => null,
                'order' => 6,
                'is_active' => true,
            ],
            [
                'type' => 'cta',
                'title' => 'Güvenliğiniz İçin Profesyonel Çözüm Zamanı',
                'subtitle' => 'Ücretsiz keşif hizmetimizden yararlanın, işletmeniz için en uygun güvenlik altyapısını birlikte planlayalım.',
                'content' => null,
                'image' => null,
                'bg_color' => 'bg-gradient',
                'settings' => null,
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }

        $this->command->info('✓ Created ' . count($sections) . ' homepage sections successfully!');
    }
}
