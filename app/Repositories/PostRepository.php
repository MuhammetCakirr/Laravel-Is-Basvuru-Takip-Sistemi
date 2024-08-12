<?php

namespace App\Repositories;

use App\Models\JobPosting;

class PostRepository
{
    public function create(int $userId, string $title, string $desc,
        string $jobTitle, string $location, string $typeOfWork, int $price): JobPosting
    {

        return JobPosting::query()->create(
            [
                'user_id' => $userId,
                'post_title' => $title,
                'post_description' => $desc,
                'job_title' => $jobTitle,
                'location' => $location,
                'type_of_work' => $typeOfWork,
                'price' => $price,
            ]
        );
    }

    public function delete(int $postId): JobPosting
    {
        $post = JobPosting::query()->findOrFail($postId);
        $post->delete();

        return $post;
    }

    public function update(int $postId, array $data): JobPosting
    {
        $post = JobPosting::query()->findOrFail($postId);
        $post->update($data);

        return $post;

    }
}
