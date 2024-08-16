<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddDatabaseUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $password=123456;
        $users = [
            [
                "name" => "Selman",
                "email" => "selman@example.com",
                "title" => "Information System Engineer"
            ],
            [
                "name" => "Ayşe",
                "email" => "ayse@example.com",
                "title" => "Software Developer"
            ],
            [
                "name" => "Mehmet",
                "email" => "mehmet@example.com",
                "title" => "Project Manager"
            ],
            [
                "name" => "Zeynep",
                "email" => "zeynep@example.com",
                "title" => "Data Scientist"
            ],
            [
                "name" => "Ali",
                "email" => "ali@example.com",
                "title" => "DevOps Engineer"
            ],
            [
                "name" => "Fatma",
                "email" => "fatma@example.com",
                "title" => "Product Owner"
            ],
            [
                "name" => "Ahmet",
                "email" => "ahmet@example.com",
                "title" => "QA Engineer"
            ],
            [
                "name" => "Emine",
                "email" => "emine@example.com",
                "title" => "UX Designer"
            ],
            [
                "name" => "Hasan",
                "email" => "hasan@example.com",
                "title" => "Backend Developer"
            ],
            [
                "name" => "Elif",
                "email" => "elif@example.com",
                "title" => "Frontend Developer"
            ],
        ];
        foreach ($users as $userData) {
            $userData['password'] = Hash::make('123456');
            User::query()->create($userData);
        }


    }
}
