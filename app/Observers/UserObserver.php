<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserHistory;

class UserObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(User $user): void
    {
        UserHistory::query()->create(
            [
                'user_id' => $user->getId(),
                'action' => 'User created.',
                'detail' => 'A user was created.',
            ]
        );
    }

    public function updated(User $user): void
    {

        $details = $user->findChanges($user);

        UserHistory::query()->create([
            'user_id' => $user->getId(),
            'action' => 'User updated.',
            'detail' => $details,
        ]);
    }

    public function deleted(User $user): void
    {
        UserHistory::query()->create([
            'user_id' => $user->getId(),
            'action' => 'User deleted.',
            'detail' => 'A user was deleted.',
        ]);
    }
}
