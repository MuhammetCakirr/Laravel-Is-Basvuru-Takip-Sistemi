<?php

namespace App\Services;

use App\Http\Requests\Application\CreateApplicationRequest;
use App\Http\Requests\Application\DeleteApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Models\JobApplication;
use App\Repositories\ApplicationRepository;

class ApplicationService
{
    private ApplicationRepository $repository;
    public function __construct()
    {
        $this->repository=new ApplicationRepository();
    }

    public function create(CreateApplicationRequest $request): JobApplication
    {
        $validateData=$request->validated();
        return $this->repository->create((int)$validateData['job_posting_id'],$request->user()->id,$validateData['cover_letter']);
    }

    public function delete(DeleteApplicationRequest $request): JobApplication
    {
        $validateData=$request->validated();
        return  $this->repository->delete((int) $validateData['application_id']);
    }

    public function update(UpdateApplicationRequest $request): JobApplication
    {
        $validateData=$request->validated();
        return $this->repository->update((int) $validateData['application_id'],$validateData['cover_letter']);
    }
}
