<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Governorate;
use App\Models\Payment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoWatching;
use App\Models\Wishlist;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Governorate::factory(27)->create();
        Classroom::factory(12)->create();
        User::factory(100)->create();
        Subject::factory(13)->create();
        Teacher::factory(100)->create();
        Course::factory(15)->create();
        Video::factory(150)->create();
        Payment::factory(200)->create();
        VideoWatching::factory(200)->create();
        Wishlist::factory(100)->create();
    }
}
