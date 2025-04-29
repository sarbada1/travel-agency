<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('country');
            $table->string('continent');
            $table->text('description')->nullable();
            $table->decimal('base_price', 10, 2)->default(0);
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->string('status')->default('active');
            $table->foreignId('user_id')->constrained();
            $table->json('meta_data')->nullable(); // For additional destination-specific metadata
            $table->timestamps();
        });

        // Link destinations to categories
        Schema::create('category_destination', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['category_id', 'destination_id']);
        });

        // Link destinations to tour packages
        Schema::create('destination_tour_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['destination_id', 'tour_package_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_tour_package');
        Schema::dropIfExists('category_destination');
        Schema::dropIfExists('destinations');
    }
};