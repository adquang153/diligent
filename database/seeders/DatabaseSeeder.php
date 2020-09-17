<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'full_name' => 'Manager',
                'email' => 'super@gmail.com',
                'password' => Hash::make('123123'),
                'user_type' => 'manager',
                'created_at' => Now(),
                'updated_at' => Now()
            ],
            [
                'full_name' => 'Member',
                'email' => 'member@gmail.com',
                'password' => Hash::make('123123'),
                'user_type' => 'member',
                'created_at' => Now(),
                'updated_at' => Now()
            ]
        ]);
    }
}
