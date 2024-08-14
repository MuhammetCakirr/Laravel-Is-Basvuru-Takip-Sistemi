<?php

namespace App\Services;

use App\Http\Requests\Requirement\CreateRequirementRequest;
use App\Http\Requests\Requirement\DeleteRequirementRequest;
use App\Http\Requests\Requirement\UpdateRequirementRequest;
use App\Models\JobPosting;
use App\Models\JobRequirement;
use App\Repositories\RequirementRepository;

class RequirementService
{
    private RequirementRepository $repository;
    public function __construct()
    {
        $this->repository=new RequirementRepository();
    }

    public function create(CreateRequirementRequest $request): JobPosting
    {
        $validatedData=$request->validated();
        foreach ($validatedData['requirement'] as $key=>$value)
        {
            $this->repository->create((int) $validatedData['post_id'],$value);
        }
        return $this->repository->showRequirementsPostById((int) $validatedData['post_id']);
    }
    public function delete(DeleteRequirementRequest $request):JobRequirement
    {
        $validatedData=$request->validated();
        return $this->repository->delete((int) $validatedData['req_id']);
    }

    public function update(UpdateRequirementRequest $request):JobRequirement
    {
        $validatedData=$request->validated();
        return  $this->repository->update((int) $validatedData['req_id'],$validatedData['require']);

    }
}
