<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@influencerconnect.com',
            'password' => Hash::make('adminpassword'),
            'phone' => '1234569990',
            'role_id' => UserRole::SuperAdministrator,
            'status' => 1,
        ]);

        \App\Models\User::create([
            'name' => 'Jason Maverick',
            'email' => 'jason@gmail.com',
            'password' => Hash::make('jason1234'),
            'phone' => '84321931-12',
            'description' => 'Fitness guru inspiring, healthier lives with workouts and wellness advice',
            'role_id' => UserRole::Influencer,
            'status' => 1,
        ]);

        \App\Models\User::create([
            'name' => 'Emily Johnson',
            'email' => 'emily@gmail.com',
            'password' => Hash::make('emily1234'),
            'phone' => '84321931-11',
            'description' => 'Fashion and beauty influencer, setting trends and sharing makeup tips',
            'role_id' => UserRole::Influencer,
            'status' => 1,
        ]);

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
