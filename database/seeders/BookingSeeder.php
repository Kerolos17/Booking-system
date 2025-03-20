<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'event_id' => 1,
                'customer_name' => 'John Doe',
                'customer_email' => 'john@example.com',
                'customer_phone' => '123456789',
                'number_of_seats' => 2,
                'booking_time' => Carbon::now(),
                'status' => 'confirmed',
                'qr_code' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 2,
                'customer_name' => 'Jane Smith',
                'customer_email' => 'jane@example.com',
                'customer_phone' => '987654321',
                'number_of_seats' => 3,
                'booking_time' => Carbon::now(),
                'status' => 'pending',
                'qr_code' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
