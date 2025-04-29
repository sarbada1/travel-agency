<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            // Add more fields for better flexibility
            $table->json('meta_data')->nullable()->after('status');
            $table->json('structured_data')->nullable()->after('meta_data');
            $table->string('tour_code')->nullable()->after('name');
            $table->dateTime('availability_start')->nullable()->after('status');
            $table->dateTime('availability_end')->nullable()->after('availability_start');
            $table->tinyInteger('featured_order')->nullable()->after('is_featured');
            $table->tinyInteger('popular_order')->nullable()->after('is_popular');
            $table->string('seo_title')->nullable()->after('meta_data');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->text('seo_keywords')->nullable()->after('seo_description');
        });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn([
                'meta_data', 'structured_data', 'tour_code', 
                'availability_start', 'availability_end',
                'featured_order', 'popular_order',
                'seo_title', 'seo_description', 'seo_keywords'
            ]);
        });
    }
};