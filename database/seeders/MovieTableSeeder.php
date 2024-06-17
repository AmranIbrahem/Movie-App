<?php

namespace Database\Seeders;

use App\Models\movies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            // Movie 1
            [
                'title' => "The Shawshank Redemption",
                'summary' => "Over the course of several years, two convicts form a friendship, seeking consolation and, eventually, redemption through basic compassion.",
                'release_date' => "2023",
                'director' => "Frank Darabont",
                'category_id' => "1",
                'main_photo' => 'wallpaperflare.com_wallpaper.jpg',
                'video' => 'wallpaperflare.com_wallpaper.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],

            // Movie 2
            [
                'title' => "Aquaman and the Lost Kingdom",
                'summary' => "Aquaman and the Lost Kingdom is a 2023 American superhero film based on the DC character Aquaman.",
                'release_date' => "2022",
                'director' => "James Wan",
                'category_id' => "2",
                'main_photo' => 'wallpaperflare.com_wallpaper.jpg',
                'video' => 'wallpaperflare.com_wallpaper.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],

            // Movie 3
            [
                'title' => "007",
                'summary' => "The James Bond film series is a British series of spy films based on the fictional character of MI6 agent James Bond, '007', who originally appeared in a series of books by Ian Fleming.",
                'release_date' => "2020",
                'director' => "Frank Darabont",
                'category_id' => "1",
                'main_photo' => 'wallpaperflare.com_wallpaper.jpg',
                'video' => 'wallpaperflare.com_wallpaper.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],

            // Add more movies here...
            // Movie 4
            [
                'title' => "Interstellar",
                'summary' => "Interstellar is a 2014 science fiction film directed by Christopher Nolan.",
                'release_date' => "2014",
                'director' => "Christopher Nolan",
                'category_id' => "1",
                'main_photo' => 'wallpaperflare.com_wallpaper.jpg',
                'video' => 'wallpaperflare.com_wallpaper.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],

            // Movie 5
            [
                'title' => "Inception",
                'summary' => "Inception is a 2010 science fiction action film written and directed by Christopher Nolan.",
                'release_date' => "2010",
                'director' => "Christopher Nolan",
                'category_id' => "1",
                'main_photo' => 'wallpaperflare.com_wallpaper.jpg',
                'video' => 'wallpaperflare.com_wallpaper.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($movies as $movie) {
            $imagePath = 'public/storage/Photos/Movies/' . $movie['main_photo'];
                $videoPath = 'public/storage/Viedos/Movies/' . $movie['video'];

            $fileExists = File::exists($imagePath);
            $fileExistsv = File::exists($videoPath);
            if (!$fileExists && !$fileExistsv) {
                continue;
            }

            $imageName = basename($imagePath);
            $VideoName = basename($videoPath);

            movies::insert([
                'title' => $movie['title'],
                'summary' => $movie['summary'],
                'release_date' => $movie['release_date'],
                'director' => $movie['director'],
                'category_id' => $movie['category_id'],
                'main_photo' => "/storage/Photos/Movies/$imageName",
                'video' => "/storage/Viedos/Movies/$VideoName",
                'created_at' => $movie['created_at'],
                'updated_at' => $movie['updated_at'],
            ]);
        }
    }
}
