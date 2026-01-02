<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('url')->nullable();
                $table->string('route')->nullable();
                $table->string('location')->default('header')->comment('header, footer_col_1, footer_col_2, etc');
                $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->boolean('new_tab')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
