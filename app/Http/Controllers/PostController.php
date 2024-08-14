<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\JobResource;
use App\Repositories\PostRepository;
use App\Repositories\RequirementRepository;
use App\Services\PostService;
use App\Traits\ResponseApi;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public PostService $service;
    use ResponseApi;

    public function __construct()
    {
        $this->service = new PostService;
    }

    public function create(CreatePostRequest $request): JsonResponse
    {
        $post = $this->service->create($request);

        return $post->successOperationResponse($post, 'Job',"created", 200);

    }

    public function delete(DeletePostRequest $request): JsonResponse
    {
        $post = $this->service->delete($request);

        return $post->successOperationResponse($post, 'Job','deleted', 200);
    }

    public function update(UpdatePostRequest $request): JsonResponse
    {
        $post = $this->service->update($request);

        return $post->successOperationResponse($post, 'Job','updated', 200);
    }

    public function getAll():JsonResponse
    {
        $repository=new PostRepository();
        $posts = $repository->allPosts();

        return $this->successResponse(JobResource::collection($posts),"All job postings have been brought.",200);
    }


    public function getById(int $id):JsonResponse
    {
        $repository=new PostRepository();
        $post= $repository->showPostById($id);
        return $this->successResponse(JobResource::make($post),"job post have been brought.",200);
    }
}
