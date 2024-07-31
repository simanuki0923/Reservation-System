<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
                'role' => 'administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 必要に応じて他の管理者データも追加

            [
                'name' => 'Store Representative',
                'password' => Hash::make('admin'),
                'role' => 'store_representative',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        
    }
}
