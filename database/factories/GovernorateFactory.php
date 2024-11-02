<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Governorate>
 */
class GovernorateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'governorate'=>fake()->randomElement([
                'Cairo',
                'Giza',
                'Alexandria',
                'Qalyubia',
                'Sharqia',
                'Dakahlia',
                'Menoufia',
                'Gharbia',
                'Kafr El Sheikh',
                'Damietta',
                'Port Said',
                'Ismailia',
                'Suez',
                'Beheira',
                'Matrouh',
                'Fayoum',
                'Beni Suef',
                'Minya',
                'Assiut',
                'Sohag',
                'Qena',
                'Luxor',
                'Aswan',
                'Red Sea',
                'New Valley',
                'North Sinai',
                'South Sinai',
            ])
        ];
    }
}

