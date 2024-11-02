<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Teacher_id'=>Teacher::all()->random()->id,
            'Course_id'=>Course::all()->random()->id,
            'Subject_id'=>Subject::all()->random()->id,
            'video_url'=>fake()->url(),
            'name_video'=>fake()->name(),
               ];
    }
}
