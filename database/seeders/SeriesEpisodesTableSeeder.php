<?php

namespace Database\Seeders;

use App\Models\series;
use App\Models\Series_episodes;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class SeriesEpisodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $episodes = [
            [
                'number_episodes' => '1',
                'video' => 'episode1.mp4',
                'photo' => 'episode1.jpg',
                'id_series' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'number_episodes' => '2',
                'video' => 'episode2.mp4',
                'photo' => 'episode2.jpg',
                'id_series' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'number_episodes' => '1',
                'video' => 'episode1.mp4',
                'photo' => 'episode1.jpg',
                'id_series' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'number_episodes' => '2',
                'video' => 'episode2.mp4',
                'photo' => 'episode2.jpg',
                'id_series' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($episodes as $episode) {
            Series_episodes::create($episode);
        }
    }

}
