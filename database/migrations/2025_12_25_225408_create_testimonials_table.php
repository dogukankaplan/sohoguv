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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Customer name
            $table->string('company')->nullable(); // Company name
            $table->string('role')->nullable(); // Job title
            $table->text('content'); // Testimonial text
            $table->integer('rating')->default(5); // 1-5 star rating
            $table->string('photo')->nullable(); // Customer photo
            $table->boolean('is_featured')->default(false); // Show on homepage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
