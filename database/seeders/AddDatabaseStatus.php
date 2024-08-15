<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddDatabaseStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::query()->create(
            [
                "name"=>"Received"
            ]
        );
        Status::query()->create(
            [
                "name"=>"Under Review"
            ]
        );
        Status::query()->create(
            [
                "name"=>"Interview Scheduled"
            ]
        );

        Status::query()->create(
            [
                "name"=>"Interview Completed"
            ]
        );
        Status::query()->create(
            [
                "name"=>"Offer Extended"
            ]
        );
        Status::query()->create(
            [
                "name"=>"Accepted"
            ]
        );
        Status::query()->create(
            [
                "name"=>"Rejected"
            ]
        );

        Status::query()->create(
            [
                "name"=>"Withdrawn"
            ]
        );

        Status::query()->create(
            [
                "name"=>"On Hold"
            ]
        );
    }
}
