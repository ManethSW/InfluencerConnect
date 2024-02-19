<?php

namespace Database\Seeders;

use App\Models\FeaturedInfluencer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturedInfluencerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeaturedInfluencer::create([
            'influencer_id' => 2,
            'influencer_category_id' => 1,
        ]);

        FeaturedInfluencer::create([
            'influencer_id' => 3,
            'influencer_category_id' => 2,
        ]);

        FeaturedInfluencer::create([
            'influencer_id' => 4,
            'influencer_category_id' => 4,
        ]);

        FeaturedInfluencer::create([
            'influencer_id' => 5,
            'influencer_category_id' => 5,
        ]);
    }
}
