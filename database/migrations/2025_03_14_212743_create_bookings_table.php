<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->integer('number_of_seats');
            $table->dateTime('booking_time');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->string('qr_code')->nullable();
            $table->timestamps();

        });
        DB::statement("ALTER TABLE bookings ADD CONSTRAINT check_number_of_seats CHECK (number_of_seats <= 100)");
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
