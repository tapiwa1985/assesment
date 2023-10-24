<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'email' => 'john@gmail.com',
                'password' => bcrypt('secret'),
                'name' => 'John Smith'
            ],
            [
                'id'=> 2,   
                'email' => 'mary@gmail.com',
                'password' => bcrypt('secret'),
                'name' => 'Mary Smith'
            ]
        ];

        DB::table('users')->insert($users);
    }
}
