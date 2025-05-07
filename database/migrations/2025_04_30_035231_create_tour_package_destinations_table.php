<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tour_package_destinations')) {
            Schema::create('tour_package_destinations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tour_package_id')->constrained('tour_packages')->onDelete('cascade');
                $table->foreignId('destination_id')->constrained('categories')->onDelete('cascade');
                $table->timestamps();
                
                $table->unique(['tour_package_id', 'destination_id'], 'unique_tour_destination');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_package_destinations');
    }
};