<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'   => 'Sakura Haruno',
                'email'  => 'sakura@example.com',
                'phone'  => '+62 812 1111 1001',
                'role'   => 'Editor',
                'status' => 'Active',
            ],
            [
                'name'   => 'Naruto Uzumaki',
                'email'  => 'naruto@example.com',
                'phone'  => '+62 812 1111 1002',
                'role'   => 'Admin',
                'status' => 'Active',
            ],
            [
                'name'   => 'Hinata Hyuga',
                'email'  => 'hinata@example.com',
                'phone'  => '+62 812 1111 1003',
                'role'   => 'Viewer',
                'status' => 'Active',
            ],
            [
                'name'   => 'Sasuke Uchiha',
                'email'  => 'sasuke@example.com',
                'phone'  => '+62 812 1111 1004',
                'role'   => 'Editor',
                'status' => 'Inactive',
            ],
            [
                'name'   => 'Mikasa Ackerman',
                'email'  => 'mikasa@example.com',
                'phone'  => '+62 812 1111 1005',
                'role'   => 'Admin',
                'status' => 'Active',
            ],
            [
                'name'   => 'Levi Ackerman',
                'email'  => 'levi@example.com',
                'phone'  => '+62 812 1111 1006',
                'role'   => 'Editor',
                'status' => 'Active',
            ],
            [
                'name'   => 'Erwin Smith',
                'email'  => 'erwin@example.com',
                'phone'  => '+62 812 1111 1007',
                'role'   => 'Viewer',
                'status' => 'Inactive',
            ],
            [
                'name'   => 'Rem Rezero',
                'email'  => 'rem@example.com',
                'phone'  => '+62 812 1111 1008',
                'role'   => 'Viewer',
                'status' => 'Active',
            ],
            [
                'name'   => 'Gojo Satoru',
                'email'  => 'gojo@example.com',
                'phone'  => '+62 812 1111 1009',
                'role'   => 'Admin',
                'status' => 'Active',
            ],
            [
                'name'   => 'Zero Two',
                'email'  => 'zerotwo@example.com',
                'phone'  => '+62 812 1111 1010',
                'role'   => 'Editor',
                'status' => 'Active',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, ['password' => Hash::make('password123')])
            );
        }
    }
}
