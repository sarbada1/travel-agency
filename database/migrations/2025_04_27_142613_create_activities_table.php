<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration_hours')->nullable();
            $table->string('difficulty_level')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->string('status')->default('active');
            $table->foreignId('user_id')->constrained();
            $table->json('meta_data')->nullable(); // For additional activity-specific metadata
            $table->timestamps();
        });

        // Link activities to categories
        Schema::create('activity_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['activity_id', 'category_id']);
        });

        // Link activities to tour packages
        Schema::create('activity_tour_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');
            $table->boolean('is_optional')->default(false);
            $table->decimal('additional_cost', 10, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['activity_id', 'tour_package_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_tour_package');
        Schema::dropIfExists('activity_category');
        Schema::dropIfExists('activities');
    }
};