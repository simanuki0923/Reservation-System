<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        if (!$user) {
            $user = User::create([
                'id' => 1,
                'name' => 'name',
                'password' => bcrypt('password'),
                'email' => 'user@example.com',
            ]);
        }

        Favorite::create([
            'user_id' => $user->id,
            'restaurant_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}