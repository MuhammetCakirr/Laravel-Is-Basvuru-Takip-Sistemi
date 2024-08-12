<?php

namespace App\Policies;

use App\Models\JobPosting;
use App\Models\JobRequirement;
use App\Models\User;

class JobRequirementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobPosting $post): bool
    {
        return $user->getId() === $post->getUserId();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, JobPosting $jobPosting): bool
    {
        return $user->getId() === $jobPosting->getUserId();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobRequirement $jobRequirement): bool
    {

        return $user->getId() === $jobRequirement->post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobRequirement $jobRequirement): bool
    {
        return $user->getId() === $jobRequirement->post->user_id;
    }
}
