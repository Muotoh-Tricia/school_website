<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all staff users and create staff records
        User::where('role', 'staff')->each(function ($user) {
            Staff::factory()->create([
                'user_id' => $user->id,
                'position' => 'Lecturer', 
            ]);
        });
    }
}
