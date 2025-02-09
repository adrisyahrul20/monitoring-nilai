<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@mail.com',
                'password' => bcrypt('administrator'),
                'role' => 'admin',
            ],
            [
                'name' => 'Guru Sampel',
                'email' => 'gurusampel@mail.com',
                'password' => bcrypt('gurusampel'),
                'role' => 'guru',
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
