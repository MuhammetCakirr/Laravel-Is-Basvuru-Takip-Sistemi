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
        //        $password=123456;
        //        User::query()->create(
        //            [
        //                "name"=>"Selman",
        //                "email"=>"selman@gmail.com",
        //                "password"=>Hash::make($password),
        //                "title"=>"Information System Engineer"
        //            ]
        //        );

        $user = User::query()->find(3);
        //        $user->delete();
        $user->update(
            [
                'title' => 'Computer Engineering',
            ]
        );

    }
}
