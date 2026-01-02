<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Define the SEO settings to be updated or inserted
        $seoSettings = [
            'site_name' => 'SOHO Güvenlik Sistemleri',
            'meta_description' => 'Türkiye genelinde profesyonel güvenlik, kamera, alarm ve yangın ihbar sistemleri. Kurumsal ve bireysel çözümler için 7/24 teknik destek.',
            'meta_keywords' => 'güvenlik sistemleri türkiye, kamera sistemleri, alarm sistemleri, yangın ihbar, akıllı ev sistemleri, plaka tanıma, turnike sistemleri, soho güvenlik',
            'hero_title' => 'Türkiye\'nin Güvenlik Sistemleri Lideri',
            'hero_subtitle' => 'Ev ve iş yerleriniz için son teknoloji güvenlik çözümleri sunuyoruz. Kamera sistemleri, alarm sistemleri ve daha fazlası.',
            'footer_about' => 'Güvenlik ve teknoloji altyapılarınız için Türkiye genelinde profesyonel çözümler sunuyoruz.',
            'address' => 'Türkiye Geneli Hizmet',
            'contact_hero_desc' => 'Türkiye\'nin her yerinden sorularınız için bize ulaşın. En kısa sürede size dönüş yapacağız.',
        ];

        foreach ($seoSettings as $key => $value) {
            // Check if setting exists
            $existing = DB::table('settings')->where('key', $key)->first();

            if ($existing) {
                // Update existing setting if it contains 'İzmir' or just generally to enforce national standard
                DB::table('settings')->where('key', $key)->update(['value' => $value]);
            } else {
                // Insert new setting
                DB::table('settings')->insert([
                    'key' => $key,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Update Services SEO if they exist
        // Replace 'İzmir' with 'Türkiye' in all service contents and titles if safe to do so
        // For now, we will focus on Settings table as per request
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting would require knowing the exact previous state, which is hard.
        // We will skip reverting specific text changes.
    }
};
