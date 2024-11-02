<?php

namespace Database\Factories;

use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'image' => fake()->randomElement([
                '6 (2).jpg',
                '6 (3).jpg',
                '6 (4).jpg',
                '6 (5).jpg',
                '6 (6).jpg',
                '6 (7).jpg',
            ]),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->e164PhoneNumber(),
            'governorate_id' => Governorate::all()->random()->id,
            'bio'=>fake()->text()

        ];
    }
}
