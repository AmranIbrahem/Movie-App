<?php

namespace Database\Seeders;

use App\Models\Favorite_Movie;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FavoriteMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $favoriteMovies = [
            ['movie_id' => 1, 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['movie_id' => 2, 'user_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['movie_id' => 3, 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['movie_id' => 4, 'user_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Favorite_Movie::insert($favoriteMovies);
    }
}
