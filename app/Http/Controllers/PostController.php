<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public PostService $service;

    public function __construct()
    {
        $this->service = new PostService;
    }

    public function create(CreatePostRequest $request): JsonResponse
    {
        $post = $this->service->create($request);

        return $post->successResponse($post, 'Job Post  has been successfully created.', 200);

    }

    public function delete(DeletePostRequest $request): JsonResponse
    {
        $post = $this->service->delete($request);

        return $post->successResponse($post, 'Job Post  has been successfully deleted.', 200);
    }

    public function update(UpdatePostRequest $request): JsonResponse
    {
        $post = $this->service->update($request);

        return $post->successResponse($post, 'Job Post  has been successfully updated.', 200);
    }
}
