<?php

namespace App\Helpers;

use App\Models\JobApplication;
use App\Models\JobPosting;

class JobPostingHelper
{
    public static function isActive(int $jobPostingId): bool
    {
        $jobPosting = JobPosting::query()->find($jobPostingId);
        return $jobPosting && $jobPosting->status->id == 1;
    }

    public static function isExists(int $jobPostingId): bool
    {
        $jobPosting = JobPosting::query()->find($jobPostingId);
        if (!$jobPosting){
            return false;
        }
        return true;
    }

    public static function doesHaveApp(int $jobPostingId,int $userId): bool
    {
        $isThereAppOfUser= JobApplication::query()->where('job_posting_id', $jobPostingId)->
        where('user_id',$userId)->first();
        if($isThereAppOfUser){
           return true;
        }
        return false;
    }


}
