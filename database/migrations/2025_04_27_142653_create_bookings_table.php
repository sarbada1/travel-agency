<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->string('status')->default('pending'); // pending, confirmed, cancelled, completed
            $table->text('special_requirements')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending'); // pending, paid, partially_paid, refunded
            $table->string('payment_id')->nullable(); // External payment reference ID
            $table->json('meta_data')->nullable(); // For additional booking-specific data
            $table->timestamps();
        });

        // Booking travelers
        Schema::create('booking_travelers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('type')->default('adult'); // adult, child
            $table->json('meta_data')->nullable(); // For additional traveler-specific data
            $table->timestamps();
        });

        // Optional activities booked
        Schema::create('booking_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->date('activity_date')->nullable();
            $table->timestamps();
            
            $table->unique(['booking_id', 'activity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_activities');
        Schema::dropIfExists('booking_travelers');
        Schema::dropIfExists('bookings');
    }
};