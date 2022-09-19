<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'This is admin role to approve loan'
            ],
            [
                'name' => 'Customer',
                'description' => 'This is customer role to apply loan'
            ]
        ]);
    }
}
