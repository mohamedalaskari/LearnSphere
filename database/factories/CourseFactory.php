<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->randomElement([
                '6 (2).jpg',
                '6 (3).jpg',
                '6 (4).jpg',
                '6 (5).jpg',
                '6 (6).jpg',
                '6 (7).jpg',
            ]),
            'name' => fake()->randomElement([
                'First Aid',
                'Healthy Nutrition',
                'Fitness Training',
                'Martial Arts Training',
                'Classical Physics',
                'Organic Chemistry',
                'Civil Engineering',
                'Biology',
                'Financial Accounting',
                'Sales Strategies',
                'Graphic Design',
                'Video Editing',
                'Web Design',
                'Photography',
                'Digital Painting',
            ]),
            'price' => fake()->randomFloat(3),
            'discount' => fake()->randomFloat(4, 0, 1),
            'number_of_videos' => fake()->randomNumber(2),
            'Subject_id' => Subject::all()->random()->id,
            'teacher_id' => Teacher::all()->random()->id,
            'bio' => fake()->text(),

        ];
    }
}
