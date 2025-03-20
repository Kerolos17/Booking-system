<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'Live Music Night',
                'description' => 'Enjoy a night of live music with top artists.',
                'event_date' => Carbon::now()->addDays(5),
                'total_seats' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comedy Show',
                'description' => 'Laugh out loud with our best comedians.',
                'event_date' => Carbon::now()->addDays(10),
                'total_seats' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DJ Party',
                'description' => 'Dance all night with our hottest DJs.',
                'event_date' => Carbon::now()->addDays(15),
                'total_seats' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
