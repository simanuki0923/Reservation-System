<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
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
                'name' => 'admin01',
                'password' => Hash::make('admin'),
                'role' => 'administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'name' => 'admin02',
                'password' => Hash::make('admin'),
                'role' => 'store_representative',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
