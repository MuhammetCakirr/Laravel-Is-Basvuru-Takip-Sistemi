<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\JobResource;
use App\Models\JobPosting;
use App\Repositories\PostRepository;
use App\Services\PostService;
use App\Traits\ResponseApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

//    public function getUnresponsivePostOwners()
//    {
//        $applications = DB::table('job_application')
//            ->join('job_posting', 'job_application.job_posting_id', '=', 'job_posting.id')
//            ->where('job_application.first_view', 0)
//            ->where('job_posting.post_status_id', 1)
//            ->select('job_application.job_posting_id', DB::raw('count(*) as application_count'))
//            ->groupBy('job_application.job_posting_id')
//            ->get();
//
//        $unresponsivePostOwners = [];
//
//        foreach ($applications as $application) {
//            $jobPosting = JobPosting::query()->find($application->job_posting_id);
//            $postOwner = $jobPosting->user->name;
//
//            if (isset($unresponsivePostOwners[$postOwner])) {
//                $unresponsivePostOwners[$postOwner] += $application->application_count;
//            } else {
//                $unresponsivePostOwners[$postOwner] = $application->application_count;
//            }
//        }
//        dd($unresponsivePostOwners);
//        foreach ($unresponsivePostOwners as $key=>$value) {
//          dd($key,$value);
//        }
//
//    }
}
