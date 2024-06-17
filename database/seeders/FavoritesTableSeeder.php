<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;
use Carbon\Carbon;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $favorites = [
            ['series_id' => 1, 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['series_id' => 2, 'user_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['series_id' => 3, 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['series_id' => 4, 'user_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Favorite::insert($favorites);
    }
}
