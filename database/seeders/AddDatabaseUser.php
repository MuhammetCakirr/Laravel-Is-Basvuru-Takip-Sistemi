<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::query()->create(
            [
                "name"=>"Muhammet",
                "email"=>"mami@gmail.com",
                "password"=>Hash::make($password)

            ]
        );
        User::query()->create(
            [
                "name"=>"Mustafa",
                "email"=>"musti@gmail.com",
                "password"=>Hash::make($password)

            ]
        );
        User::query()->create(
            [
                "name"=>"Ahmet",
                "email"=>"ahmet@gmail.com",
                "password"=>Hash::make($password)

            ]
        );
    }
}
