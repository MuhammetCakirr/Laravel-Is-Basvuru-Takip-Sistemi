<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddDatabasePostStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostStatus::query()->create(
            [
                "name"=>"active",

            ]
        );
        PostStatus::query()->create(
            [
                "name"=>"inactive",

            ]
        );
    }
}
