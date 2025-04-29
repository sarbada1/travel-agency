<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_attribute_id')->constrained()->onDelete('cascade');
            $table->morphs('attributable'); // Can be used for any model that needs attributes
            $table->text('text_value')->nullable();
            $table->longText('rich_text_value')->nullable();
            $table->json('array_value')->nullable();
            $table->json('json_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->decimal('number_value', 15, 2)->nullable();
            $table->date('date_value')->nullable();
            $table->timestamps();
            
            // Unique constraint to prevent duplicate attribute values
            $table->unique(['package_attribute_id', 'attributable_id', 'attributable_type'], 'unique_attribute_value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};