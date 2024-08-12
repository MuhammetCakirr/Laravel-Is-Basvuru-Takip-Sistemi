<?php

namespace App\Observers;

use App\Models\Skill;
use App\Models\SkillHistory;

class SkillObserver
{
    /**
     * Handle the Skill "created" event.
     */
    public function created(Skill $skill): void
    {
        SkillHistory::query()->create(
            [
                'skill_id' => $skill->getId(),
                'user_id' => request()->user()->id,
                'action' => 'Skill created.',
                'detail' => 'User has added the skill.',
            ]
        );
    }

    public function updated(Skill $skill): void
    {
        $details = $skill->findChanges($skill);

        SkillHistory::query()->create([
            'skill_id' => $skill->getId(),
            'user_id' => request()->user()->id,
            'action' => 'Skill updated.',
            'detail' => $details,
        ]);
    }

    public function deleted(Skill $skill): void
    {
        SkillHistory::query()->create([
            'skill_id' => $skill->getId(),
            'user_id' => request()->user()->id,
            'action' => 'Skill deleted.',
            'detail' => 'User has deleted the skill.',
        ]);
    }
}
