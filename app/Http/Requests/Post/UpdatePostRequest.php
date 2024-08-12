<?php

namespace App\Http\Requests\Post;

use App\Models\JobPosting;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => ['exists:job_posting,id', 'integer', 'required'],
            'post_title' => ['sometimes', 'string'],
            'post_description' => ['sometimes', 'string'],
            'job_title' => ['sometimes', 'string'],
            'location' => ['sometimes', 'string'],
            'type_of_work' => ['sometimes', 'string'],
            'price' => ['sometimes', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'Please fill in the post ID field.',
            'post_id.integer' => 'Post ID must be at integer.',
            'post_id.exists' => 'the post Id of this id has not been found.',
            'post_title.string' => 'Title must be at string.',
            'post_description.string' => 'Description must be at string.',
            'job_title.string' => 'Job title must be at string.',
            'location.string' => 'Location must be at string.',
            'type_of_work.string' => 'Type of work must be at string.',
            'price.integer' => 'Price must be at integer.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @throws AuthorizationException
     */
    public function authorize(): bool
    {
        $post = JobPosting::query()->findOrFail($this->input('post_id'));
        if ($this->user()->cannot('update', $post)) {
            throw new AuthorizationException('You do not have permission to update this post.');
        }

        return true;
    }
}
