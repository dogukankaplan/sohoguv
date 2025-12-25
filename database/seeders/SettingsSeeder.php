<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Site Bilgileri
            ['key' => 'site_name', 'value' => 'SOHO Güvenlik Sistemleri'],
            ['key' => 'site_tagline', 'value' => 'Güvenliği Sanata Dönüştürüyoruz'],

            // İletişim
            ['key' => 'phone', 'value' => '+90 (555) 123 45 67'],
            ['key' => 'email', 'value' => 'info@sohoguvenlik.com'],
            ['key' => 'address', 'value' => 'İstanbul, Türkiye'],
            ['key' => 'working_hours', 'value' => 'Pzt-Cum 09:00-18:00'],

            // Footer
            ['key' => 'footer_about', 'value' => 'Güvenlik ve teknoloji altyapılarınız için profesyonel çözümler.'],
            ['key' => 'footer_newsletter_title', 'value' => 'Bültenimize Abone Olun'],
            ['key' => 'footer_newsletter_desc', 'value' => 'E-posta ile güncellemelerden haberdar olun.'],
            ['key' => 'copyright', 'value' => '© [YEAR] SOHO Güvenlik Sistemleri. Tüm hakları saklıdır.'],

            // Butonlar
            ['key' => 'btn_explore', 'value' => 'Keşfetmeye Başla'],
            ['key' => 'btn_submit', 'value' => 'Gönder'],
            ['key' => 'btn_subscribe', 'value' => 'Abone Ol'],
            ['key' => 'btn_contact', 'value' => 'İletişime Geç'],
            ['key' => 'btn_quote', 'value' => 'Teklif Al'],

            // Form Placeholders
            ['key' => 'placeholder_name', 'value' => 'Adınız Soyadınız'],
            ['key' => 'placeholder_email', 'value' => 'E-posta Adresiniz'],
            ['key' => 'placeholder_phone', 'value' => 'Telefon Numaranız'],
            ['key' => 'placeholder_subject', 'value' => 'Konu'],
            ['key' => 'placeholder_message', 'value' => 'Mesajınız'],

            // SEO
            ['key' => 'meta_description', 'value' => 'İzmir\'de güvenlik sistemleri, kamera sistemleri ve alarm sistemleri konusunda uzman ekibimizle hizmetinizdeyiz.'],
            ['key' => 'meta_keywords', 'value' => 'güvenlik kamera, alarm sistemi, izmir güvenlik, kamera sistemi'],

            // Sayfa Başlıkları
            ['key' => 'page_home', 'value' => 'Ana Sayfa'],
            ['key' => 'page_about', 'value' => 'Hakkımızda'],
            ['key' => 'page_contact', 'value' => 'İletişim'],
            ['key' => 'page_references', 'value' => 'Referanslarımız'],
            ['key' => 'page_services', 'value' => 'Hizmetlerimiz'],

            // Mesajlar
            ['key' => 'msg_no_services', 'value' => 'Henüz hizmet eklenmemiş.'],
            ['key' => 'msg_no_clients', 'value' => 'Henüz referans eklenmemiş.'],
            ['key' => 'msg_no_testimonials', 'value' => 'Henüz yorum eklenmemiş.'],
            ['key' => 'msg_loading', 'value' => 'Yükleniyor...'],
            ['key' => 'msg_error', 'value' => 'Bir hata oluştu. Lütfen tekrar deneyin.'],
            ['key' => 'msg_success', 'value' => 'İşleminiz başarıyla tamamlandı!'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
