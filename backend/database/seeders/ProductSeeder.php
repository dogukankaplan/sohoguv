<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     */
    public function run(): void
    {
        \App\Models\Product::where('category', 'colorvu')->delete();

        $subCategories = [
            'bullet' => [
                'title' => 'Sabit Bullet (Mermi) Tip Kameralar',
                'description' => 'Geniş alan gözetimi için klasik ve caydırıcı tasarım.',
                'image' => '/storage/products/bullet.png',
                'products' => [
                    [
                        'name' => '4MP ColorVu Bullet Kamera',
                        'code' => 'DS-2CD2047G2-L',
                        'features' => ['Çözünürlük' => '4 MP', 'Lens' => '2.8mm/4mm', 'WDR' => '130dB', 'Aydınlatma' => '40m']
                    ],
                    [
                        'name' => '8MP (4K) ColorVu Bullet Kamera',
                        'code' => 'DS-2CD2087G2-L',
                        'features' => ['Çözünürlük' => '8 MP (4K)', 'Lens' => '2.8mm/4mm/6mm', 'Smart' => 'Sanal Sınır', 'Aydınlatma' => '60m']
                    ],
                ]
            ],
            'turret' => [
                'title' => 'Sabit Taret (Turret) Tip Kameralar',
                'description' => 'İç ve dış mekan uyumlu, IR yansıması yapmayan özel tasarım.',
                'image' => '/storage/products/turret.png',
                'products' => [
                    [
                        'name' => '2MP ColorVu Turret Kamera',
                        'code' => 'DS-2CD2327G2-L',
                        'features' => ['Çözünürlük' => '2 MP', 'Lens' => '2.8mm', 'Mikrofon' => 'Dahili', 'Aydınlatma' => '30m']
                    ],
                    [
                        'name' => '4MP Pro Series Turret',
                        'code' => 'DS-2CD2347G2-LU',
                        'features' => ['Çözünürlük' => '4 MP', 'Lens' => '2.8mm', 'Mikrofon' => 'Gürültü Önleyici', 'Aydınlatma' => '30m']
                    ],
                ]
            ],
            'dome' => [
                'title' => 'Sabit Dome (Kubbe) Tip Kameralar',
                'description' => 'Vandalizme dayanıklı (IK10), estetik ve kompakt.',
                'image' => '/storage/products/dome.png',
                'products' => [
                    [
                        'name' => '4MP Vandal-Proof Dome',
                        'code' => 'DS-2CD2147G2-SU',
                        'features' => ['Çözünürlük' => '4 MP', 'Dayanıklılık' => 'IK10 / IP67', 'Ses' => 'Giriş/Çıkış', 'Lens' => '2.8mm']
                    ],
                ]
            ],
            'varifocal' => [
                'title' => 'Motorlu Varifokal (Zoom Özellikli) Kameralar',
                'description' => 'Kurulum sırasında ve sonrasında ayarlanabilir görüş açısı.',
                'image' => '/storage/products/varifocal.png',
                'products' => [
                    [
                        'name' => '4MP Varifokal Bullet',
                        'code' => 'DS-2CD2647G2-LZS',
                        'features' => ['Çözünürlük' => '4 MP', 'Lens' => '2.8-12mm Motorize', 'Zoom' => '4x Optik', 'Aydınlatma' => '60m']
                    ],
                    [
                        'name' => '8MP Varifokal Dome',
                        'code' => 'DS-2CD2787G2-LZS',
                        'features' => ['Çözünürlük' => '8 MP', 'Lens' => '2.8-12mm Motorize', 'Dayanıklılık' => 'IK10', 'Aydınlatma' => '40m']
                    ],
                ]
            ]
        ];

        foreach ($subCategories as $key => $catData) {
            foreach ($catData['products'] as $prod) {
                \App\Models\Product::create([
                    'name' => $prod['name'],
                    'slug' => \Illuminate\Support\Str::slug($prod['name'] . '-' . $prod['code']),
                    'description' => $catData['description'] . ' (' . $prod['code'] . ')',
                    'category' => 'colorvu',
                    'sub_category' => $key, // 'bullet', 'turret', etc.
                    'image' => $catData['image'],
                    'features' => $prod['features'],
                ]);
            }
        }
    }
}
