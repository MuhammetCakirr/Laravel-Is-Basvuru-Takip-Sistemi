<?php

namespace App\Observers;

use App\Models\JobApplication;
use App\Models\JobApplicationHistory;
use App\Models\JobRequirement;
use App\Models\JobRequirementHistory;

class JobApplicationObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(JobApplication $application): void
    {

        JobApplicationHistory::query()->create(
            [
                'job_posting_id' => (int) $application->job_posting_id,
                'user_id' => (int) request()->user()->id,
                'job_application_id'=> (int) $application->id,
                'action' => 'Application created.',
                'detail' => 'User has applied for a job.',
            ]
        );
    }

    public function updated(JobApplication $application): void
    {
        $details = $application->findChanges($application);

        JobApplicationHistory::query()->create(
            [
                'job_posting_id' =>(int) $application->job_posting_id,
                'user_id' => (int) request()->user()->id,
                'job_application_id'=> $application->getId(),
                'action' => 'Application updated.',
                'detail' => $details,
            ]
        );
    }

    public function deleted(JobApplication $application): void
    {
        JobApplicationHistory::query()->create(
            [
                'job_posting_id' => $application->post->id,
                'user_id' => request()->user()->id,
                'job_application_id'=>$application->getId(),
                'action' => 'Application deleted.',
                'detail' => "User has canceled the job application.",
            ]
        );

    }
}
