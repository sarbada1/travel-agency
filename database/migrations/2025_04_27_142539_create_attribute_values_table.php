.php
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
            $table->longText('rich_text_value')->nullable();
            $table->json('json_value')->nullable();
            $table->integer('display_order')->default(0); 
            $table->text('text_value')->nullable();
            $table->text('long_text_value')->nullable();
            $table->json('array_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->decimal('numeric_value', 15, 2)->nullable();
            $table->string('item_key')->nullable();
            $table->timestamps();          
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};