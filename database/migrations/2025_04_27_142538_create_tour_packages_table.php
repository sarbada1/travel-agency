<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('duration_days');
            $table->decimal('regular_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->string('difficulty_level')->nullable();
            $table->integer('group_size')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->float('rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // Category relationships
        Schema::create('category_tour_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['category_id', 'tour_package_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_tour_package');
        Schema::dropIfExists('tour_packages');
    }
};