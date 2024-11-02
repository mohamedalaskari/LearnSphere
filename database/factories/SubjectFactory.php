<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->randomElement([
                'Math',
                'Science',
                'English',
                'Social Studies',
                'Physical Education',
                'Mathematics',
                'English Language Arts',
                'Science',
                'History/Social Studies',
                'Technology',
                'Foreign Languages',
                'Art',
                'Music'
            ]),
        ];
    }
}
