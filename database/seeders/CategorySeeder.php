<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\InfluencerCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InfluencerCategory::create([
            'name' => 'Blogger',
            'status' => 1,
        ]);

        InfluencerCategory::create([
            'name' => 'Vlogger',
            'status' => 1,
        ]);

        InfluencerCategory::create([
            'name' => 'Short Video',
            'status' => 1,
        ]);

        InfluencerCategory::create([
            'name' => 'Podcaster',
            'status' => 1,
        ]);

        InfluencerCategory::create([
            'name' => 'Photographer',
            'status' => 1,
        ]);

        InfluencerCategory::create([
            'name' => 'Gamer',
            'status' => 1,
        ]);

        InfluencerCategory::create([
            'name' => 'Pets and Animals',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Travel and Adventure',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Music & Entertainment',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => '	Tech & Gadgets',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Gaming & Esports',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Fashion & Beauty',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Pets & Animals',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Food & Culinary',
            'status' => 1,
        ]);

        BusinessCategory::create([
            'name' => 'Fitness & Wellness',
            'status' => 1,
        ]);
    }
}
