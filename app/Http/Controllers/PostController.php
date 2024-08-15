<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\JobResource;
use App\Repositories\PostRepository;
use App\Services\PostService;
use App\Traits\ResponseApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public PostService $service;
    public PostRepository $repository;
    use ResponseApi;

    public function __construct()
    {
        $this->service = new PostService();
        $this->repository=new PostRepository();
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
        $posts = $this->repository->allPosts();
        return $this->successResponse(JobResource::collection($posts),"All job postings have been brought.",200);
    }


    public function getById(int $id):JsonResponse
    {
        $post= $this->repository->showPostById($id);
        return $this->successResponse(JobResource::make($post),"job post have been brought.",200);
    }

    public function getAllMyPost(Request $request): JsonResponse
    {
        $posts= $this->repository->getAllMyPosts($request->user()->id);
        return $this->successResponse(JobResource::collection($posts),"All your post have been brought.",200);
    }

//    public function getMyPostById(int $id)
//    {
//
//    }


}
