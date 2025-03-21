<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>User::factory(),
            'position' => $this->faker->randomElement(['HOD', 'lecturer', 'cleaner', 'Dean']),
            // 'position' => collect(['HOD', 'Lecturer', 'Cleaner', 'Dean'])->shuffle()->first(),
        ];
    }
}
