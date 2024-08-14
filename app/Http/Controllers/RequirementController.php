<?php

namespace App\Http\Controllers;

use App\Http\Requests\Requirement\CreateRequirementRequest;
use App\Http\Requests\Requirement\DeleteRequirementRequest;
use App\Http\Requests\Requirement\UpdateRequirementRequest;
use App\Services\RequirementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    private RequirementService $service;

    public function __construct()
    {
        $this->service = new RequirementService();
    }

    public function create(CreateRequirementRequest $request): JsonResponse
    {
        $req = $this->service->create($request);
        return $req->successOperationResponse($req, "Requirement", "create", 200);
    }

    public function delete(DeleteRequirementRequest $request): JsonResponse
    {
        $req = $this->service->delete($request);
        return $req->successOperationResponse($req, "Requirement", "delete", 200);
    }

    public function update(UpdateRequirementRequest $request): JsonResponse
    {
        $req = $this->service->update($request);
        return $req->successOperationResponse($req, "Requirement", "update", 200);
    }
}
