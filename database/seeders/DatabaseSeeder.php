<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use App\Models\User;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin1234'),
                'role_id' => UserRole::SuperAdministrator,
                'status' => 1,
            ],
            [
                'name' => 'Maneth Weerasinghe',
                'email' => 'maneth@gmail.com',
                'password' => Hash::make('maneth1234'),
                'role_id' => UserRole::Influencer,
                'status' => 1,
            ],
            [
                'name' => 'Kasun Perera',
                'email' => 'kasun@gmail.com',
                'password' => Hash::make('kasun1234'),
                'role_id' => UserRole::Influencer,
                'status' => 1,
            ],
            [
                'name' => 'Kamal Perera',
                'email' => 'kamal@gmail.com',
                'password' => Hash::make('kamal1234'),
                'role_id' => UserRole::Influencer,
                'status' => 1,
            ],
            [
                'name' => 'Chanuka Gamage',
                'email' => 'chanuka@gmail.com',
                'password' => Hash::make('chanuka1234'),
                'role_id' => UserRole::Influencer,
                'status' => 0,
            ],
            [
                'name' => 'Dilshan Perera',
                'email' => 'dilshan@gmail.com',
                'password' => Hash::make('dilshan1234'),
                'role_id' => UserRole::Influencer,
                'status' => 1,
            ],
            [
                'name' => 'Softlogic',
                'email' => 'softlogic@gmail.com',
                'password' => Hash::make('softlogic1234'),
                'role_id' => UserRole::Business,
                'status' => 1,
            ],
            [
                'name' => 'Dialog',
                'email' => 'dialog@gmail.com',
                'password' => Hash::make('dialog1234'),
                'role_id' => UserRole::Business,
                'status' => 1,
            ],
            [
                'name' => 'Singer',
                'email' => 'singer@gmail.com',
                'password' => Hash::make('singer1234'),
                'role_id' => UserRole::Business,
                'status' => 0,
            ],
            [
                'name' => 'Cargills',
                'email' => 'cargills@gmail.com',
                'password' => Hash::make('cargills1234'),
                'role_id' => UserRole::Business,
                'status' => 1,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);

            $avatar = app('avatar');
            $image = $avatar->create($user->name)->getImageObject()->encode('png');
            $path = 'public/avatars/'.$user->id.'.png';
            Storage::put($path, (string) $image);

            $user->avatar = $path;
            $user->save();
        }

        $this->call([
            CategorySeeder::class,
            FeaturedInfluencerSeeder::class,
            CollaborationSeeder::class,
            ProposalSeeder::class,
        ]);
    }
}
