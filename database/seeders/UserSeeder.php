<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('password')
            ],
            [
                'name' => 'First Customer',
                'email' => 'firstcustomer@email.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('first')
            ],
            [
                'name' => 'Second Customer',
                'email' => 'secondcustomer@email.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('second')
            ]
        ]);
    }
}
