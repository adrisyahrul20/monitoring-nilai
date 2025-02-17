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
                'name' => 'Guru Walas',
                'email' => 'guruwalas@mail.com',
                'password' => bcrypt('guruwalas'),
                'role' => 'guru',
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepsek@mail.com',
                'password' => bcrypt('kepsek'),
                'role' => 'kepsek',
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
