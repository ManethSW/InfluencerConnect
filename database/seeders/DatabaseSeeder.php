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

        // \App\Models\User::create([
        //     'name' => 'Super Admin 2',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'phone' => '1234569991',
        //     'role_id' => UserRole::SuperAdministrator,
        //     'status' => 1,
        // ]);
    }
}
