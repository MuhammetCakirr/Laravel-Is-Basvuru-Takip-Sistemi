<?php

namespace App\Services;

use App\Http\Requests\Skill\CreateSkillRequest;
use App\Http\Requests\Skill\DeleteSkillRequest;
use App\Http\Requests\Skill\UpdateSkillRequest;
use App\Models\Skill;
use App\Repositories\SkillRepository;

class SkillService
{
    public function create(CreateSkillRequest $request): Skill
    {
        $validatedData = $request->validated();
        $repository = new SkillRepository;

        return $repository->create((int) $request->user()->id, (int) $validatedData['level'], $validatedData['name']);
    }

    public function delete(DeleteSkillRequest $request): Skill
    {
        $validatedData = $request->validated();
        $repository = new SkillRepository;

        return $repository->delete((int) $validatedData['skill_id']);
    }

    public function update(UpdateSkillRequest $request): Skill
    {
        $skillId = $request->input('skill_id');
        $validatedData = $request->validated();
        unset($validatedData['skill_id']);
        $repository = new SkillRepository;

        return $repository->update((int) $skillId, $validatedData);
    }
}
