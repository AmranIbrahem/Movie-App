<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use Carbon\Carbon;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            [
                'user_id' => 1,
                'movie_id' => 1,
                'series_id' => null,
                'rating' => 4.5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'movie_id' => 2,
                'series_id' => null,
                'rating' => 3.8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'movie_id' => null,
                'series_id' => 1,
                'rating' => 4.9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'movie_id' => null,
                'series_id' => 2,
                'rating' => 4.7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Rating::insert($ratings);
    }
}
