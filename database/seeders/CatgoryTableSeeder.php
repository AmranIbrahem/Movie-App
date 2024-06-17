<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category;
class CatgoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catgorys=[
            ['description' => 'Action'],
            ['description' => 'Romantic'],
            ['description' => 'Comedy'],
            ['description' => 'Drama'],
            ['description' => 'Sci-Fi'],
            ['description' => 'Horror'],

        ];

        category::insert($catgorys);
    }
}
