<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->enum('category', ['client', 'partner', 'solution_partner'])
                ->default('client')
                ->after('name');
        });

        // Mevcut tüm kayıtları 'client' kategorisine ata
        DB::table('clients')->update(['category' => 'client']);
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
