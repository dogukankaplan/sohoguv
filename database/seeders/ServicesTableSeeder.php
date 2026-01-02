<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Önce temizle
        DB::table('services')->truncate();

        $services = [
            [
                'title' => 'Akıllı Video Analiz Sistemleri',
                'description' => 'Yapay zeka destekli video analiz çözümleri ile proaktif güvenlik.',
                'image' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Gelişmiş yapay zeka algoritmaları sayesinde insan, araç ve nesne ayrımı yapabilen, şüpheli durumları anında tespit ederek operatörleri uyaran yeni nesil güvenlik çözümüdür. Sınır ihlali, yanlış yön tespiti, terk edilmiş nesne gibi senaryoları otomatik algılar.</p><ul><li>Nesne Sınıflandırma</li><li>Yoğunluk Haritası</li><li>Yüz Tanıma Entegrasyonu</li></ul>'
            ],
            [
                'title' => 'IP CCTV Güvenlik Çözümleri',
                'description' => 'Yüksek çözünürlüklü ve ölçeklenebilir kamera sistemleri.',
                'image' => 'https://images.unsplash.com/photo-1580894742597-87bc8789db3d?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Kurumsal ağ altyapınız üzerinde çalışan, yüksek çözünürlüklü (4K/8K) görüntü kalitesi sunan IP kamera sistemleridir. Merkezi yönetim yazılımları ile binlerce kamerayı tek bir noktadan izleme ve yönetme imkanı sunar.</p>'
            ],
            [
                'title' => 'Geçiş Kontrol ve Turnike',
                'description' => 'Personel ve ziyaretçi giriş-çıkışları için güvenli denetim.',
                'image' => 'https://images.unsplash.com/photo-1626960074219-5d67786ae822?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Kartlı, parmak izli veya yüz tanımalı geçiş kontrol sistemleri ile yetkisiz girişleri engelleyin. Hızlı geçiş turnikeleri, boy turnikeleri ve VIP geçiş kapıları ile entegre çalışabilen esnek çözümler.</p>'
            ],
            [
                'title' => 'Yangın Algılama Sistemleri',
                'description' => 'Erken uyarı sistemleri ile can ve mal güvenliğinizi koruyun.',
                'image' => 'https://images.unsplash.com/photo-1582234057630-6d427d143c08?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Endüstriyel tesisler, oteller ve ofisler için adresli ve konvansiyonel yangın algılama sistemleri. Duman, ısı ve alev dedektörleri ile yangın riskini en erken aşamada tespit eder ve ilgili senaryoları devreye sokar.</p>'
            ],
            [
                'title' => 'Plaka Tanıma Sistemleri',
                'description' => 'Otopark yönetimi ve güvenliği için %99 başarı oranlı tanıma.',
                'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Site, AVM ve kamu kurumları için araç giriş-çıkışlarını otomatikleştirin. Kara liste/beyaz liste yönetimi, bariyer entegrasyonu ve detaylı raporlama özellikleri sunan yüksek performanslı plaka tanıma yazılımları.</p>'
            ],
            [
                'title' => 'Çevre Güvenlik Çözümleri',
                'description' => 'Fiziksel sınır ihlallerine karşı radar ve sensör tabanlı koruma.',
                'image' => 'https://images.unsplash.com/photo-1585646197576-2679dc6e8b26?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Tesis sınırlarını korumak için radar, lidar, fiber optik sensör kablolar ve aktif IR bariyerler kullanıyoruz. İzinsiz giriş girişimlerini anında tespit edip kamera sistemini ilgili bölgeye yönlendirir.</p>'
            ],
            [
                'title' => 'Network ve Fiber Altyapı',
                'description' => 'Güvenlik sistemleri için kesintisiz ve yüksek hızlı ağ çözümleri.',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop',
                'content' => '<p>Tüm güvenlik sistemlerinin omurgasını oluşturan yapısal kablolama, fiber optik sonlandırma ve endüstriyel switch konfigürasyonları. Yedekli ve güvenli veri iletişimi sağlıyoruz.</p>'
            ],
            [
                'title' => 'Biyometrik Tanıma',
                'description' => 'Yüz, parmak izi ve iris tanıma teknolojileri.',
                'image' => 'https://images.unsplash.com/photo-1626961138865-eb793fb54832?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Kart taşıma zorunluluğunu ortadan kaldıran, kopyalanamaz güvenlik. Yüksek güvenlik gerektiren alanlar için temassız biyometrik çözümler.</p>'
            ],
            [
                'title' => 'Acil Anons ve Seslendirme',
                'description' => 'Binalar için EN-54 sertifikalı acil durum tahliye sistemleri.',
                'image' => 'https://images.unsplash.com/photo-1516280440614-6697288d5d38?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Yangın ve acil durumlarda otomatik tahliye mesajları yayınlayan, günlük kullanımda müzik ve anons yapılabilen profesyonel seslendirme sistemleri.</p>'
            ],
            [
                'title' => 'Araç Altı Görüntüleme',
                'description' => 'Nizamiye ve yüksek güvenlikli girişler için tarama sistemleri.',
                'image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=2070&auto=format&fit=crop',
                'content' => '<p>Giriş yapan araçların altını yüksek çözünürlüklü tarayarak yabancı nesne, patlayıcı veya kaçak malzeme tespiti yapar. Plaka tanıma sistemi ile entegre çalışarak tam güvenlik sağlar.</p>'
            ]
        ];

        foreach ($services as $index => $item) {
            DB::table('services')->insert([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'content' => $item['content'],
                'image' => null, // Kullanıcı görsel yüklemeli
                'seo_title' => $item['title'] . ' | SOHO Güvenlik',
                'seo_description' => $item['description'], // Use description for SEO description
                'order' => $index + 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
