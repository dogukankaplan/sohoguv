<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class HomeSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Remove existing home settings to avoid duplicates
        Setting::where('group', 'home')->delete();

        $settings = [
            ['group' => 'home', 'key' => 'home_services_title', 'value' => 'Hizmetlerimiz'],
            ['group' => 'home', 'key' => 'home_services_subtitle', 'value' => 'Güvenliğiniz için sunduğumuz profesyonel çözümler.'],
            ['group' => 'home', 'key' => 'home_blog_title', 'value' => 'Blog'],
            ['group' => 'home', 'key' => 'home_blog_subtitle', 'value' => 'Son haberler ve bilgilendirici makaleler.'],
            ['group' => 'home', 'key' => 'home_references_title', 'value' => 'Referanslarımız'],
        ];

        Setting::insert($settings);

        $this->command->info('Home Page settings seeded!');
    }
}
