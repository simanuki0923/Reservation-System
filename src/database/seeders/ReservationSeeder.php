<?php

namespace Database\Seeders;
use App\Models\Reservation;

use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'user_id' => 1,
            'restaurant_id' => 1,
            'reservation_date' => '2024-07-20',
            'reservation_time' => '12:00:00',
            'number_of_people' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
