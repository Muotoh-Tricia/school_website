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
        // Create an admin user
        // if (!User::where('email', 'admin@example.com')->exists()) {
        //     User::factory()->create([
        //         'userTypes_id' => 'admin',
        //         'full_name' => 'Admin User',
        //         'email' => 'admin@example.com',
        //         'password' => bcrypt('password'),
        //     ]);
        // }

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
