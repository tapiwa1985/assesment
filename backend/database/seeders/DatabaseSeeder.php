<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $pdo = DB::getPdo();
        $pdo->beginTransaction();
        $this->call(UsersTableSeeder::class);
        $userStatement = $pdo->prepare("SELECT setval('users_id_seq', (SELECT MAX(id) FROM users)+1);");
        $userStatement->execute();
        $this->call(BookingsTableSeeder::class);
        $bookingStatement = $pdo->prepare("SELECT setval('bookings_booking_id_seq', (SELECT MAX(booking_id) FROM bookings)+1);");
        $bookingStatement->execute();
        $pdo->commit();
    }
}
