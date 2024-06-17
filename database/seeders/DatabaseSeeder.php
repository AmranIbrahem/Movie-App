<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CatgoryTableSeeder::class,
            MovieTableSeeder::class,
            SeriesTableSeeder::class,
            SeriesEpisodesTableSeeder::class,
            UserTableSeeder::class,
            CommentsTableSeeder::class,
            FavoriteMoviesTableSeeder::class,
            FavoritesTableSeeder::class,
            RatingsTableSeeder::class,

        ]);
    }
}
