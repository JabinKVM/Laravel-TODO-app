<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(

            [
                'email' => 'techsoul@gmail.com'
            ],

            [
                'name' => 'Administrator',

                'password' => Hash::make('techsoul123'),

                'role' => 'admin',

                'status' => true,
            ]

        );
    }
}