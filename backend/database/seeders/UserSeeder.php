<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 student users
        User::factory(5)->create([
            'userTypes_id' => 1
        ]);

        // Create 5 staff users
        User::factory(5)->create([
            'userTypes_id' => 2
        ]);
    }
}
