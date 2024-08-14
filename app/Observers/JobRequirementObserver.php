<?php

namespace App\Observers;

use App\Models\JobRequirement;
use App\Models\JobRequirementHistory;

class JobRequirementObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(JobRequirement $requirement): void
    {
        JobRequirementHistory::query()->create(
            [
                'post_id' => $requirement->post->id,
                'user_id' => request()->user()->id,
                'requirement_id'=>$requirement->getId(),
                'action' => 'Requirement created.',
                'detail' => 'User has added the requirement.',
            ]
        );
    }

    public function updated(JobRequirement $requirement): void
    {
        $details = $requirement->findChanges($requirement);

        JobRequirementHistory::query()->create([
            'post_id' => $requirement->post->id,
            'user_id' => request()->user()->id,
            'requirement_id'=>$requirement->getId(),
            'action' => 'Requirement updated.',
            'detail' => $details,
        ]);
    }

    public function deleted(JobRequirement $requirement): void
    {
        JobRequirementHistory::query()->create([
            'post_id' => $requirement->post->id,
            'user_id' => request()->user()->id,
            'requirement_id'=>$requirement->getId(),
            'action' => 'Requirement deleted.',
            'detail' => 'User has deleted the requirement.',
        ]);
    }
}
