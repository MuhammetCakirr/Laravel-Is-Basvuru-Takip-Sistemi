<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skill\CreateSkillRequest;
use App\Http\Requests\Skill\DeleteSkillRequest;
use App\Http\Requests\Skill\UpdateSkillRequest;
use App\Services\SkillService;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    private SkillService $service;

    public function __construct()
    {
        $this->service = new SkillService;
    }

    public function create(CreateSkillRequest $request): JsonResponse
    {
        $skill = $this->service->create($request);

        return $skill->successResponse($skill, 'Skill has been successfully created.', 200);
    }

    public function delete(DeleteSkillRequest $request): JsonResponse
    {
        $skill = $this->service->delete($request);

        return $skill->successResponse($skill, 'Skill has been successfully deleted.', 200);
    }

    public function update(UpdateSkillRequest $request): JsonResponse
    {
        $skill = $this->service->update($request);

        return $skill->successResponse($skill, 'Skill has been successfully updated.', 200);

    }
}
