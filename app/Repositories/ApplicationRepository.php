<?php

namespace App\Repositories;

use App\Models\JobApplication;
use App\Models\JobPosting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ApplicationRepository
{

    public function create(int $jobPostingId,int $userId, string $coverLetter):JobApplication
    {
        $jobApplication= JobApplication::query()->create(
            [
                "job_posting_id"=>$jobPostingId,
                "user_id"=>$userId,
                "status_id"=>1,
                "cover_letter"=>$coverLetter,
                "first_view"=>0

            ]
        );
        return $jobApplication->load(['status', 'user', 'post', 'post.user']);

    }
    public function delete(int $applicationId): JobApplication
    {
        $application=JobApplication::query()->find($applicationId);
        $application->update(["status_id"=>8]);
        return $application;

    }
    public function update(int $applicationId,string $coverLetter): JobApplication
    {
        $application=JobApplication::query()->find($applicationId);

        $application->update(["cover_letter"=>$coverLetter]);

        return $application;
    }

    public function getAllMyApplication(int $userId): Collection
    {
        return JobApplication::query()->where("user_id",$userId)->with(["status","user","post","post.user"])->get();
    }
    public function getApplicationOfMyPost(int $appId)
    {
         $application=JobApplication::query()->find($appId);
         $application->update(["first_view"=>(int)$application->first_view + 1]);
         return $application->load(['status', 'user', 'post', 'post.user']);
    }

}
