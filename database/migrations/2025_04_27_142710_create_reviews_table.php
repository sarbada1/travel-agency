<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('reviewable'); // Can be used for tour packages, destinations, activities
            $table->string('title')->nullable();
            $table->text('comment');
            $table->integer('rating'); // 1-5 stars
            $table->boolean('is_verified')->default(false);
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->json('meta_data')->nullable(); // Additional review data
            $table->timestamps();

            // Prevent duplicate reviews
            $table->unique(['user_id', 'reviewable_id', 'reviewable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};