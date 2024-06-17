<?php

namespace Database\Seeders;

use App\Models\series;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $series = [
            [
                'title' => "Game of Thrones",
                'summary' => "Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.",
                'release_date' => "2011",
                'director' => "David Benioff, D.B. Weiss",
                'category_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "Stranger Things",
                'summary' => "When a young boy disappears, his mother, a police chief, and his friends must confront terrifying supernatural forces in order to get him back.",
                'release_date' => "2016",
                'director' => "The Duffer Brothers",
                'category_id' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "Breaking Bad",
                'summary' => "A high school chemistry teacher turned methamphetamine producer partners with a former student to secure his family's future.",
                'release_date' => "2008",
                'director' => "Vince Gilligan",
                'category_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "The Witcher",
                'summary' => "Geralt of Rivia, a solitary monster hunter, struggles to find his place in a world where people often prove more wicked than beasts.",
                'release_date' => "2019",
                'director' => "Lauren Schmidt Hissrich",
                'category_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "The Mandalorian",
                'summary' => "The travels of a lone bounty hunter in the outer reaches of the galaxy, far from the authority of the New Republic.",
                'release_date' => "2019",
                'director' => "Jon Favreau",
                'category_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "The Crown",
                'summary' => "Follows the political rivalries and romance of Queen Elizabeth II's reign and the events that shaped the second half of the twentieth century.",
                'release_date' => "2016",
                'director' => "Peter Morgan",
                'category_id' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "Friends",
                'summary' => "Follows the personal and professional lives of six twenty to thirty-something-year-old friends living in Manhattan.",
                'release_date' => "1994",
                'director' => "David Crane, Marta Kauffman",
                'category_id' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "Sherlock",
                'summary' => "A modern update finds the famous sleuth and his doctor partner solving crime in 21st century London.",
                'release_date' => "2010",
                'director' => "Mark Gatiss, Steven Moffat",
                'category_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "The Office",
                'summary' => "A mockumentary on a group of typical office workers, where the workday consists of ego clashes, inappropriate behavior, and tedium.",
                'release_date' => "2005",
                'director' => "Greg Daniels, Ricky Gervais, Stephen Merchant",
                'category_id' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "Money Heist",
                'summary' => "An unusual group of robbers attempt to carry out the most perfect heist in Spanish history - stealing 2.4 billion euros from the Royal Mint of Spain.",
                'release_date' => "2017",
                'director' => "Álex Pina",
                'category_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($series as $serie) {
            Series::create($serie);
        }


    }
}
