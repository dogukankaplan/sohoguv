<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Services
        $services = [
            [
                'title' => 'Kamera Sistemleri',
                'slug' => 'kamera-sistemleri',
                'summary' => 'HD ve 4K çözünürlükte güvenlik kameraları ile 7/24 izleme imkanı. Gece görüşlü, hareketli, akıllı kamera çözümleri.',
                'content' => 'Profesyonel CCTV kamera sistemleri ile tesislerinizi 7/24 izleyin. HD, Full HD ve 4K çözünürlükte kameralar, gece görüş teknolojisi, hareket algılama ve akıllı tespit özellikleri ile tam güvenlik.',
                'is_active' => true,
            ],
            [
                'title' => 'Alarm Sistemleri',
                'slug' => 'alarm-sistemleri',
                'summary' => 'Kablosuz ve kablolu alarm sistemleri, hırsız alarmı, panik butonu ve akıllı alarm çözümleri.',
                'content' => 'En son teknoloji alarm sistemleri ile işyerinizi ve evinizi koruyun. Kablosuz teknoloji, mobil uygulama entegrasyonu ve 7/24 izleme merkezi desteği.',
                'is_active' => true,
            ],
            [
                'title' => 'Yangın İhbar Sistemleri',
                'slug' => 'yangin-ihbar-sistemleri',
                'summary' => 'Erken uyarı sistemi ile yangın risklerini minimize edin. Duman, ısı ve alev dedektörleri.',
                'content' => 'Tesislerinizin güvenliği için yangın algılama ve ihbar sistemleri. Akredite ürünler, profesyonel montaj ve TSE standartlarına uygunluk.',
                'is_active' => true,
            ],
            [
                'title' => 'Geçiş Kontrol Sistemleri',
                'slug' => 'gecis-kontrol-sistemleri',
                'summary' => 'Kartlı, şifreli ve biyometrik geçiş kontrol sistemleri ile yetkisiz girişleri engelleyin.',
                'content' => 'Akıllı geçiş kontrol sistemleri ile personel ve ziyaretçi takibi yapın. Kart okuyucu, parmak izi, yüz tanıma ve plaka okuma sistemleri.',
                'is_active' => true,
            ],
            [
                'title' => 'Akıllı Ev Sistemleri',
                'slug' => 'akilli-ev-sistemleri',
                'summary' => 'Evinizi akıllı cihazlarla yönetin. Aydınlatma, ısıtma, perde ve güvenlik entegrasyonu.',
                'content' => 'Evinizi akıllı teknolojilerle donatın. Ses komutu ile kontrol, uzaktan erişim, enerji tasarrufu ve konfor.',
                'is_active' => true,
            ],
            [
                'title' => 'Perimeter Güvenlik',
                'slug' => 'perimeter-guvenlik',
                'summary' => 'Çevre güvenlik sistemleri ile sınırlarınızı koruyun. Elektrikli çit, lazer bariyer ve sensörler.',
                'content' => 'Geniş alanların güvenliği için çevre koruma sistemleri. Elektrikli çit, lazer bariyer, mikrodalga sensörler ve entegre izleme.',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            DB::table('services')->updateOrInsert(
                ['slug' => $service['slug']],
                array_merge($service, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Sliders
        $sliders = [
            [
                'title' => 'Güvenliğiniz Bizim İşimiz',
                'subtitle' => 'İzmir ve Ege bölgesinde lider güvenlik çözümleri. 7/24 profesyonel hizmet.',
                'button_text' => 'Keşfet',
                'button_link' => '/services',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Akıllı Kamera Sistemleri',
                'subtitle' => '4K çözünürlük, gece görüş, mobil izleme ve yapay zeka destekli analizler.',
                'button_text' => 'Detaylı Bilgi',
                'button_link' => '/services/kamera-sistemleri',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Ücretsiz Keşif ve Proje',
                'subtitle' => 'Uzman kadromuz size özel güvenlik çözümü sunar. Hemen arayın!',
                'button_text' => 'İletişime Geç',
                'button_link' => '/contact',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            DB::table('sliders')->updateOrInsert(
                ['title' => $slider['title']],
                array_merge($slider, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // References
        $references = [
            ['title' => 'İzmir Büyükşehir Belediyesi', 'url' => '#', 'order' => 1],
            ['title' => 'Ege Üniversitesi', 'url' => '#', 'order' => 2],
            ['title' => 'Bornova AVM', 'url' => '#', 'order' => 3],
            ['title' => 'Karşıyaka Belediyesi', 'url' => '#', 'order' => 4],
            ['title' => 'İzmir Liman İşletmesi', 'url' => '#', 'order' => 5],
            ['title' => 'Konak Belediyesi', 'url' => '#', 'order' => 6],
        ];

        foreach ($references as $reference) {
            DB::table('references')->updateOrInsert(
                ['title' => $reference['title']],
                array_merge($reference, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Blogs
        $blogs = [
            [

                'title' => '2024 Güvenlik Trendleri: Yapay Zeka ve IoT',
                'slug' => '2024-guvenlik-trendleri',
                'excerpt' => 'Güvenlik sektöründe yapay zeka ve IoT teknolojilerinin yükselişi. 2024 yılında öne çıkan teknolojiler.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Güvenlik sektöründe yapay zeka ve IoT kullanımı her geçen gün artıyor...',
                'published_at' => now()->subDays(5),
                'user_id' => 1,
            ],
            [
                'title' => 'CCTV Kamera Seçiminde Dikkat Edilmesi Gerekenler',
                'slug' => 'cctv-kamera-secimi',
                'excerpt' => 'İşletmeniz veya eviniz için doğru kamera sistemini nasıl seçersiniz? Uzman tavsiyeleri.',
                'content' => 'CCTV kamera seçimi yaparken çözünürlük, gece görüşü, depolama kapasitesi ve görüş açısı gibi faktörlere dikkat edilmelidir...',
                'published_at' => now()->subDays(12),
                'user_id' => 1,
            ],
            [
                'title' => 'Yangın Algılama Sistemlerinde Yeni Nesil Teknolojiler',
                'slug' => 'yangin-algilama-teknolojileri',
                'excerpt' => 'Akıllı algılama algoritmaları ile yanlış alarm oranını minimuma indirin.',
                'content' => 'Yeni nesil yangın algılama sistemleri, yapay zeka destekli algoritmalar sayesinde gerçek yangından kaynaklanan dumanı diğer faktörlerden ayırt edebiliyor...',
                'published_at' => now()->subDays(20),
                'user_id' => 1,
            ],
        ];

        foreach ($blogs as $blog) {
            DB::table('blogs')->updateOrInsert(
                ['slug' => $blog['slug']],
                array_merge($blog, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Mehmet Yılmaz',
                'position' => 'Genel Müdür',
                'company' => 'Bornova Plaza AVM',
                'content' => 'SOHO Güvenlik ile çalışmaya başladığımızdan beri AVM\'mizin güvenliği konusunda hiçbir endişemiz kalmadı. Profesyonel ekip ve 7/24 destek hizmetinden çok memnunuz.',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ayşe Demir',
                'position' => 'İşletme Sahibi',
                'company' => 'Demir Otomotiv',
                'content' => 'Firmamdaki tüm kamera ve alarm sistemlerini SOHO Güvenlik kurdu. Hızlı montaj, kaliteli malzeme ve uygun fiyat. Herkese tavsiye ederim!',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Can Özkan',
                'position' => 'Teknik Müdür',
                'company' => 'Özkan İnşaat',
                'content' => 'Şantiyelerimizde geçiş kontrol ve kamera sistemleri için SOHO ile çalışıyoruz. Güvenilir, hızlı ve ekonomik çözümler sunuyorlar.',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimonials')->updateOrInsert(
                ['name' => $testimonial['name'], 'company' => $testimonial['company']],
                array_merge($testimonial, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Additional homepage settings
        $additionalSettings = [
            ['key' => 'home_stats_projects', 'value' => '500+', 'group' => 'home'],
            ['key' => 'home_stats_clients', 'value' => '300+', 'group' => 'home'],
            ['key' => 'home_stats_experience', 'value' => '15+', 'group' => 'home'],
            ['key' => 'home_stats_support', 'value' => '7/24', 'group' => 'home'],
            ['key' => 'home_why_title', 'value' => 'Neden SOHO Güvenlik?', 'group' => 'home'],
            ['key' => 'home_services_title', 'value' => 'Profesyonel Güvenlik Çözümleri', 'group' => 'home'],
            ['key' => 'home_references_title', 'value' => 'Güvenilir Referanslar', 'group' => 'home'],
            ['key' => 'home_blog_title', 'value' => 'Son Gelişmeler & Haberler', 'group' => 'home'],
        ];

        foreach ($additionalSettings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
