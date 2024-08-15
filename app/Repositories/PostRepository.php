<?php

namespace App\Repositories;

use App\Models\JobPosting;
use Illuminate\Database\Eloquent\Collection;

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

    public function allPosts(): Collection
    {
        return JobPosting::query()->with('user','requirements','applications.user','applications.status','applications.user.skills')->get();
    }

    public function showPostById(int $postId):JobPosting
    {
        return JobPosting::query()->where('id',$postId)->with('user','requirements','applications.user')->first();
    }


    public function getMyPostById(int $postId,int $userId)
    {
//        $posts=JobPosting::query()->where('id'$)
    }

    public function getAllMyPosts(int $userId): Collection
    {
       return JobPosting::query()->where('user_id',$userId)->with('user','applications.user','requirements','applications.user','applications.user.skills')->get();

    }
}
