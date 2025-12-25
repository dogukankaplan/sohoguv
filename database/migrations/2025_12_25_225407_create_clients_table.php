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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Client name
            $table->string('logo')->nullable(); // Logo path
            $table->string('website')->nullable(); // Client website URL
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true); // Visibility toggle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
