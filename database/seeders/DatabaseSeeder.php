<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
            'role_id' => UserRole::SuperAdministrator,
            'status' => 1,
        ]);

//        \App\Models\User::create([
//            'name' => 'Maneth Weerasinghe',
//            'email' => 'maneth@gmail.com',
//            'password' => Hash::make('maneth1234'),
//            'phone' => '0771234123',
//            'address' => 'No 8, Galle Road',
//            'role_id' => UserRole::Influencer,
//            'status' => 1,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Kasun Perera',
//            'email' => 'kasun@gmail.com',
//            'password' => Hash::make('kasun1234'),
//            'phone' => '0771234122',
//            'address' => 'No 9, Galle Road',
//            'role_id' => UserRole::Influencer,
//            'status' => 1,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Kamal Perera',
//            'email' => 'kamal@gmail.com',
//            'password' => Hash::make('kamal1234'),
//            'phone' => '07712345612',
//            'address' => 'No 10, Galle Road',
//            'role_id' => UserRole::Influencer,
//            'status' => 1,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Chanuka Gamage',
//            'email' => 'chanuka@gmail.com',
//            'password' => Hash::make('chanuka1234'),
//            'phone' => '0771234566',
//            'address' => 'No 11, Galle Road',
//            'role_id' => UserRole::Influencer,
//            'status' => 0,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Dilshan Perera',
//            'email' => 'dilshan@gmail.com',
//            'password' => Hash::make('dilshan1234'),
//            'phone' => '0771234565',
//            'address' => 'No 12, Galle Road',
//            'role_id' => UserRole::Influencer,
//            'status' => 1,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Softlogic',
//            'email' => 'softlogic@gmail.com',
//            'password' => Hash::make('softlogic1234'),
//            'phone' => '07712345123',
//            'address' => 'No 11, Galle Road',
//            'business_type' => 'Technology',
//            'business_size' => 1000,
//            'business_website' => 'https://softlogic.lk',
//            'role_id' => UserRole::Business,
//            'status' => 1,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Dialog',
//            'email' => 'dialog@gmail.com',
//            'password' => Hash::make('dialog1234'),
//            'phone' => '0771234567',
//            'address' => 'No 475, Union Place',
//            'business_type' => 'Telecommunication',
//            'business_size' => 2000,
//            'business_website' => 'https://www.dialog.lk',
//            'role_id' => UserRole::Business,
//            'status' => 1,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Singer',
//            'email' => 'singer@gmail.com',
//            'password' => Hash::make('singer1234'),
//            'phone' => '0771234568',
//            'address' => 'No 80, Nawam Mawatha',
//            'business_type' => 'Consumer Electronics',
//            'business_size' => 1500,
//            'business_website' => 'https://www.singersl.com',
//            'role_id' => UserRole::Business,
//            'status' => 0,
//        ]);
//
//        \App\Models\User::create([
//            'name' => 'Cargills',
//            'email' => 'cargills@gmail.com',
//            'password' => Hash::make('cargills1234'),
//            'phone' => '0771234569',
//            'address' => 'No 40, York Street',
//            'business_type' => 'Retail',
//            'business_size' => 5000,
//            'business_website' => 'https://www.cargillsceylon.com',
//            'role_id' => UserRole::Business,
//            'status' => 1,
//        ]);
//
//        $this->call([
//            CategorySeeder::class,
//            InfluencerCardSeeder::class,
//        ]);
    }
}
