<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable(); // Short description/excerpt
            $table->longText('content')->nullable(); // Full content
            $table->string('image')->nullable(); // Main cover image
            $table->json('gallery')->nullable(); // Additional images
            $table->string('status')->default('completed'); // completed, ongoing
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->date('completion_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
