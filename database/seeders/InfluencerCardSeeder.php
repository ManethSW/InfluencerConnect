<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfluencerCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\InfluencerCard::create([
            'user_id' => 2, 
            'avatar' => 'images/influencer-1.png', // path to the avatar image
            'influencer_category_id' => 1, // assuming an influencer category with id 1 exists
            'rating' => 4,
            'description' => 'Fitness guru inspiring, healthier lives with workouts and wellness advice',
            'visible' => true,
        ]);

        \App\Models\InfluencerCard::create([
            'user_id' => 3, 
            'avatar' => 'images/influencer-2.png', // path to the avatar image
            'influencer_category_id' => 2, // assuming an influencer category with id 1 exists
            'rating' => 4,
            'description' => 'Fashion and beauty influencer, setting trends and sharing makeup tips',
            'visible' => true,
        ]);
        
        \App\Models\InfluencerCard::create([
            'user_id' => 4, 
            'avatar' => 'images/influencer-2.png', // path to the avatar image
            'influencer_category_id' => 3, // assuming an influencer category with id 1 exists
            'rating' => 5,
            'description' => 'Fitness guru inspiring, healthier lives with workouts and wellness advice',
            'visible' => true,
        ]);

        \App\Models\InfluencerCard::create([
            'user_id' => 5, 
            'avatar' => 'images/influencer-2.png', // path to the avatar image
            'influencer_category_id' => 4, // assuming an influencer category with id 1 exists
            'rating' => 5,
            'description' => 'Fashion and beauty influencer, setting trends and sharing makeup tips',
            'visible' => true,
        ]);
    }
}
