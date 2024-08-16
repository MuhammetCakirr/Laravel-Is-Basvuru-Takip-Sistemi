<?php

namespace App\Services;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Jobs\SendEmailJob;
use App\Models\JobPosting;
use App\Repositories\PostRepository;

class PostService
{
    public function create(CreatePostRequest $request): JobPosting
    {
        $validatedData = $request->validated();
        $repository = new PostRepository;

        $post=$repository->create((int) $request->user()->id, $validatedData['post_title'], $validatedData['post_description'],
            $validatedData['job_title'], $validatedData['location'], $validatedData['type_of_work'],
            (int) $validatedData['price']);

        dispatch(new SendEmailJob(["operation"=>"postCreate","subject"=>"İlanının başarılı şekilde oluşturuldu.","userName"=>$post->user->name]));

        return $post;
    }

    public function delete(DeletePostRequest $request): JobPosting
    {
        $validatedData = $request->validated();
        $repository = new PostRepository;

        return $repository->delete((int) $validatedData['post_id']);
    }

    public function update(UpdatePostRequest $request): JobPosting
    {
        $postId = $request->input('post_id');

        $validatedData = $request->validated();

        unset($validatedData['post_id']);

        $repository = new PostRepository;

        return $repository->update((int) $postId, $validatedData);
    }
}
