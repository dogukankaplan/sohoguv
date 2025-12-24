<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'SOHO Güvenlik Sistemleri', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'İzmir ve Ege bölgesinde güvenlik sistemleri konusunda uzman ekibimizle hizmetinizdeyiz. Kamera sistemleri, alarm sistemleri, yangın ihbar ve geçiş kontrol çözümleri.', 'group' => 'general'],

            // Contact
            ['key' => 'contact_address', 'value' => 'Kazımdirik, 364/1. Sk. Şaşmaz İş Merkezi No:9/1, 35100 Bornova/İzmir', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+90 (232) 000 00 00', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'info@sohoguvenlik.com', 'group' => 'contact'],

            // Social
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/sohoguvenlik', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/sohoguvenlik', 'group' => 'social'],

            // SEO
            ['key' => 'seo_keywords', 'value' => 'İzmir güvenlik sistemleri, kamera sistemleri, alarm sistemleri, CCTV İzmir', 'group' => 'seo'],

            // Home Page
            ['key' => 'home_hero_title', 'value' => 'Güvenliğiniz Bizim İşimiz', 'group' => 'home'],
            ['key' => 'home_hero_subtitle', 'value' => 'Profesyonel güvenlik çözümleri ile yanınızdayız', 'group' => 'home'],
        ];

        foreach ($settings as $setting) {
            \DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
