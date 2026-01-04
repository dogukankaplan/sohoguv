<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix incorrect section types
        if (Schema::hasTable('sections')) {
            // Update solutions_hero to hero
            DB::table('sections')
                ->where('type', 'solutions_hero')
                ->update(['type' => 'hero']);

            // Update solutions_cta to cta
            DB::table('sections')
                ->where('type', 'solutions_cta')
                ->update(['type' => 'cta']);

            // Log the changes (optional - will show in migration output)
            $updated = DB::table('sections')
                ->whereIn('type', ['hero', 'cta'])
                ->count();

            if ($updated > 0) {
                echo "\n✓ Fixed {$updated} section type(s)\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes if needed
        if (Schema::hasTable('sections')) {
            DB::table('sections')
                ->where('type', 'hero')
                ->whereNotNull('id')
                ->update(['type' => 'solutions_hero']);

            DB::table('sections')
                ->where('type', 'cta')
                ->whereNotNull('id')
                ->update(['type' => 'solutions_cta']);
        }
    }
};
