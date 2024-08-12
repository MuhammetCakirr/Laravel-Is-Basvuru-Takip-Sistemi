<?php

namespace App\Http\Requests\Post;

use App\Models\JobPosting;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DeletePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => ['required', 'integer', 'exists:job_posting,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'Please fill in the post ID field.',
            'post_id.integer' => 'Post ID must be at integer.',
            'post_id.exists' => 'the post Id of this id has not been found.',
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
        if ($this->user()->cannot('delete', $post)) {
            throw new AuthorizationException('You do not have permission to delete this post.');
        }

        return true;
    }
}
