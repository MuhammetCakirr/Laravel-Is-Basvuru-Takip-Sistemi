<?php

namespace App\Services;

use App\Http\Requests\Application\CreateApplicationRequest;
use App\Http\Requests\Application\DeleteApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Http\Requests\Application\ViewApplicationRequest;
use App\Jobs\SendEmailJob;
use App\Mail\ApplicationSent;
use App\Models\JobApplication;
use App\Repositories\ApplicationRepository;
use Illuminate\Support\Facades\Mail;

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
        $application= $this->repository->create((int)$validateData['job_posting_id'],$request->user()->id,$validateData['cover_letter']);
        dispatch(new SendEmailJob(["operation"=>"appCreate","subject"=>"Başvurunu ilan sahibine gönderdik.","userName"=>$application->user->name,"postOwner"=>$application->post->user->name]));
        return $application;
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

    public function getApplicationOfMyPost(ViewApplicationRequest $request):JobApplication
    {
        $validatedData=$request->validated();
        $application= $this->repository->getApplicationOfMyPost($validatedData['application_id']);
        if($application->first_view===1){
            dispatch(new SendEmailJob(["operation"=>"appViewed","subject"=>"Başvurun İlan Sahibi tarafından görüntülendi.","userName"=>$application->user->name,"postOwner"=>$application->post->user->name]));
        }
        return $application;
    }
}
