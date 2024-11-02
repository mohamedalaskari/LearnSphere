<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VideoWatching>
 */
class VideoWatchingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Video_id'=>Video::all()->random()->id,
            'User_id'=>User::all()->random()->id,
            'count'=>fake()->randomNumber(1),
            'last_watch'=>fake()->date(),
        ];
    }
}
