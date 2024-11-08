<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([
            [
                'name' => 'Fei Fei',
                'email' => 'feifeifry@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'operator',
            ],
            [
                'name' => 'Fey',
                'email' => 'feithemornstar@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'staff',
            ],
            [
                'name' => 'Tumbal Proyek',
                'email' => 'anontester69@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'customer',
            ],
        ]);

    }
}
