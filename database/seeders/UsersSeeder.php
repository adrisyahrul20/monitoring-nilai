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
                'name' => 'Guru Mapel',
                'email' => 'gurumapel@mail.com',
                'password' => bcrypt('gurumapel'),
                'role' => 'guru',
            ],
            [
                'name' => 'Guru Wali Kelas',
                'email' => 'guruwalikelas@mail.com',
                'password' => bcrypt('guruwalikelas'),
                'role' => 'guru',
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@mail.com',
                'password' => bcrypt('siswa'),
                'role' => 'siswa',
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
