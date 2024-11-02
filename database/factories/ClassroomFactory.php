<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classroom'=>fake()->randomElement([
                'First gradeprimary',
                'Second gradeprimary',
                'Third gradeprimary',
                'Fourth gradeprimary',
                'Fifth gradeprimary',
                'Sixth gradeprimary',
                'First gradepreparatory',
                'Second gradepreparatory',
                'Third gradepreparatory',
                'First gradesecondary',
                'Second gradesecondary',
                'Third gradesecondary',
            ]),
        ];
    }
}
