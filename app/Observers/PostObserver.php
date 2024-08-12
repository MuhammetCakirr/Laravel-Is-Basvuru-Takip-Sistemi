<?php

namespace App\Observers;

use App\Models\JobPosting;
use App\Models\JobPostingHistory;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(JobPosting $post): void
    {
        JobPostingHistory::query()->create(
            [
                'post_id' => $post->getId(),
                'user_id' => request()->user()->id,
                'action' => 'Post created.',
                'detail' => 'User has added the post.',
            ]
        );
    }

    public function updated(JobPosting $post): void
    {
        $details = $post->findChanges($post);

        JobPostingHistory::query()->create([
            'post_id' => $post->getId(),
            'user_id' => request()->user()->id,
            'action' => 'Post updated.',
            'detail' => $details,
        ]);
    }

    public function deleted(JobPosting $post): void
    {
        JobPostingHistory::query()->create([
            'post_id' => $post->getId(),
            'user_id' => request()->user()->id,
            'action' => 'Post deleted.',
            'detail' => 'User has deleted the post.',
        ]);
    }
}
