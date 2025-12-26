<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            // Trust Indicators
            $table->string('trust_indicator_1')->nullable()->after('background_image');
            $table->string('trust_indicator_2')->nullable();
            $table->string('trust_indicator_3')->nullable();

            // Secondary CTA
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_url')->nullable();

            // Dashboard Stats (for mockup)
            $table->string('stat_1_value')->nullable();
            $table->string('stat_1_label')->nullable();
            $table->string('stat_2_value')->nullable();
            $table->string('stat_2_label')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->dropColumn([
                'trust_indicator_1',
                'trust_indicator_2',
                'trust_indicator_3',
                'cta_secondary_text',
                'cta_secondary_url',
                'stat_1_value',
                'stat_1_label',
                'stat_2_value',
                'stat_2_label',
            ]);
        });
    }
};
