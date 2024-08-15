<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\CreateApplicationRequest;
use App\Http\Requests\Application\DeleteApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Http\Resources\JobApplicationResource;
use App\Http\Resources\JobResource;
use App\Repositories\ApplicationRepository;
use App\Services\ApplicationService;
use App\Traits\ResponseApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    private ApplicationService $service;
    use ResponseApi;
    public function __construct()
    {
        $this->service=new ApplicationService();
    }
    public function create(CreateApplicationRequest $request): JsonResponse
    {
        $application= $this->service->create($request);
        return $application->successOperationResponse($application,"Your Application ","submitted.",statusCode: 200);
    }
    public function delete(DeleteApplicationRequest $request): JsonResponse
    {
        $application=$this->service->delete($request);
        return $application->successOperationResponse($application,"Your Application ","cancelled.",statusCode: 200);
    }

    public function update(UpdateApplicationRequest $request): JsonResponse
    {
        $application=$this->service->update($request);
       return $application->successOperationResponse($application,"Your Application ","updated.",statusCode: 200);
    }
    public function getAllMyApplication(Request $request)
    {
        $repository= new ApplicationRepository();
        $applications= $repository->getAllMyApplication($request->user()->id);

        return $this->successResponse($applications,"All your applications have been brought.",200);
    }
    public function getMyApplicationById(int $id)
    {

    }
}
