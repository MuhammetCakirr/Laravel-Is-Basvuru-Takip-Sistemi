<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository
{
    public function create(int $userId, int $level, string $name): Skill
    {
        return Skill::query()->create(
            [
                'name' => $name,
                'user_id' => $userId,
                'level' => $level,
            ]
        );
    }

    public function delete(int $skillId): Skill
    {
        $skill = Skill::query()->findOrFail($skillId);
        $skill->delete();

        return $skill;
    }

    public function update(int $skillId, array $data): Skill
    {
        $skill = Skill::query()->findOrFail($skillId);
        $skill->update($data);

        return $skill;

    }
}
