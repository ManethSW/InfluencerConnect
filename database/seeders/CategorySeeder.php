<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\InfluencerCategory::create([
            'name' => 'Fashion and Beauty',
        ]);

        \App\Models\InfluencerCategory::create([
            'name' => 'Fitness and Wellness',
        ]);

        \App\Models\InfluencerCategory::create([
            'name' => 'Food and Culinary',
        ]);

        \App\Models\InfluencerCategory::create([
            'name' => 'Tech and Gadgets',
        ]);

        \App\Models\InfluencerCategory::create([
            'name' => 'Music and Entertainment',
        ]);

        \App\Models\InfluencerCategory::create([
            'name' => 'Gaming and Esports',
        ]);

        \App\Models\InfluencerCategory::create([
            'name' => 'Pets and Animals',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Travel and Adventure',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Home and Decor',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Parenting and Family',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Business and Finance',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Education and Learning',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Art and Design',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Sports and Fitness',
        ]);

        \App\Models\BusinessCategory::create([
            'name' => 'Beauty and Personal Care',
        ]);
    }
}
