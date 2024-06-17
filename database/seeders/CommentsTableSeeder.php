<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                'user_id' => 1,
                'movie_id' => 1,
                'series_id' => null,
                'comment' => 'Great movie!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'movie_id' => 2,
                'series_id' => null,
                'comment' => 'Not bad, but could be better.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'movie_id' => null,
                'series_id' => 1,
                'comment' => 'Amazing series, loved every episode!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'movie_id' => null,
                'series_id' => 2,
                'comment' => 'Couldn\'t stop watching!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Comment::insert($comments);
    }
}
