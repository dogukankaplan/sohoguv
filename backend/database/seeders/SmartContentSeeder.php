<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SmartContentSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to ensure clean slate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        Slider::truncate();
        Blog::truncate();
        Setting::truncate();
        DB::table('media')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Settings (Dynamic Texts) ---
        $settings = [
            ['group' => 'home', 'key' => 'home_services_title', 'value' => 'Hizmetlerimiz'],
            ['group' => 'home', 'key' => 'home_services_subtitle', 'value' => 'Eviniz ve işyeriniz için en modern güvenlik çözümleri.'],
            ['group' => 'home', 'key' => 'home_blog_title', 'value' => 'Güvenlik Dünyası'],
            ['group' => 'home', 'key' => 'home_blog_subtitle', 'value' => 'Sektörden en güncel haberler ve ipuçları.'],
            ['group' => 'home', 'key' => 'home_references_title', 'value' => 'Referanslarımız'],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+90 212 123 45 67'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'info@sohoguvenlik.com'],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => 'Maslak Mah. Büyükdere Cad. No:1 Sarıyer/İstanbul'],
        ];
        Setting::insert($settings);

        // --- Sliders ---
        $slider1 = Slider::create([
            'title' => 'Geleceğin Güvenlik Teknolojileri',
            'subtitle' => 'Yapay zeka destekli izleme sistemleri ile 7/24 güvendesiniz.',
            'button_text' => 'Keşfet',
            'button_link' => '/services',
            'order' => 1,
            'is_active' => true,
        ]);
        $this->addDetails($slider1, 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?q=80&w=2070&auto=format&fit=crop');

        $slider2 = Slider::create([
            'title' => 'Akıllı Ev Ve Alarm Sistemleri',
            'subtitle' => 'Evinizi cebinizden yönetin, her an haberdar olun.',
            'button_text' => 'İletişime Geç',
            'button_link' => '/contact',
            'order' => 2,
            'is_active' => true,
        ]);
        $this->addDetails($slider2, 'https://images.unsplash.com/photo-1558002038-1091a16600a3?q=80&w=2070&auto=format&fit=crop');

        // --- Services ---
        $servicesData = [
            [
                'title' => 'CCTV Kamera Sistemleri',
                'summary' => 'Yüksek çözünürlüklü ve gece görüşlü kamera sistemleri ile kör nokta kalmasın.',
                'image' => 'https://images.unsplash.com/photo-1579869847514-7c1a19d2d2ad?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'title' => 'Hırsız Alarm Sistemleri',
                'summary' => 'Hassas sensörler ve anlık bildirim sistemi ile davetsiz misafirlere geçit yok.',
                'image' => 'https://images.unsplash.com/photo-1599139363768-b74306385d8d?q=80&w=800&auto=format&fit=crop' // Generic tech image
            ],
            [
                'title' => 'Yangın İhbar Sistemleri',
                'summary' => 'Erken uyarı sistemleri ile can ve mal güvenliğinizi maksimuma çıkarın.',
                'image' => 'https://images.unsplash.com/photo-1549419619-33887ae9f53c?q=80&w=800&auto=format&fit=crop' // Smoke abstract
            ],
            [
                'title' => 'Geçiş Kontrol Sistemleri',
                'summary' => 'Kartlı ve biyometrik geçiş sistemleri ile personel takibini kolaylaştırın.',
                'image' => 'https://images.unsplash.com/photo-1623945202652-325db1649033?q=80&w=800&auto=format&fit=crop' // Access control
            ]
        ];

        foreach ($servicesData as $data) {
            $service = Service::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'summary' => $data['summary'],
                'content' => $data['summary'] . ' Detaylı içerik...',
                'is_active' => true,
            ]);
            $this->addDetails($service, $data['image']);
        }

        // --- Blogs ---
        $blogsData = [
            [
                'title' => 'Ev Güvenliğinde 5 Altın Kural',
                'excerpt' => 'Tatile çıkarken evinizi nasıl güvende tutarsınız? İşte uzman tavsiyeleri.',
                'image' => 'https://images.unsplash.com/photo-1560518883-ce09059ee971?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'title' => 'Yapay Zeka ve Güvenlik',
                'excerpt' => 'Güvenlik kameralarında yapay zeka devrimi başladı. Neleri değiştiriyor?',
                'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'title' => 'İşyeri Güvenliği Nasıl Sağlanır?',
                'excerpt' => 'İşyeriniz için en doğru güvenlik protokolleri ve sistemleri.',
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=800&auto=format&fit=crop'
            ]
        ];

        foreach ($blogsData as $data) {
            $blog = Blog::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['excerpt'] . ' Devamı...',
                'published_at' => now(),
                'user_id' => 1,
            ]);
            $this->addDetails($blog, $data['image']);
        }

        $this->command->info('Smart Content Seeded Successfully!');
    }

    private function addDetails($model, $url)
    {
        try {
            $model->addMediaFromUrl($url)->toMediaCollection(
                $model instanceof Slider ? 'sliders' : ($model instanceof Service ? 'services' : 'blogs')
            );
        } catch (\Exception $e) {
            // Fallback if download fails (e.g. timeout) - prevent crash
            // In dev environment we might just skip
        }
    }
}
