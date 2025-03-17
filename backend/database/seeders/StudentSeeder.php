<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all student users and create student records
        User::where('userTypes_id', '1')->each(function ($user) {
            Student::factory()->create([
                'user_id' => $user->id,
                'level' => collect([100, 200, 300, 400, 500, 600])->random(),
            ]);
        });
    }
}
