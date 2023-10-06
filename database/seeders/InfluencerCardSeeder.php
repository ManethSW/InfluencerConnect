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
        $user = \App\Models\User::find(3); 

        \App\Models\InfluencerCard::create([
            'user_id' => $user, 
            'avatar' => 'images/influencer-1.png', // path to the avatar image
            'influencer_category_id' => 1, // assuming an influencer category with id 1 exists
            'rating' => 4,
            'description' => $user->description,
            'visible' => true,
        ]);
    }
}
