<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_title' => ['string'],
            'post_description' => ['string'],
            'job_title' => ['string'],
            'location' => ['string'],
            'type_of_work' => ['string'],
            'price' => ['integer'],

        ];
    }

    public function messages(): array
    {
        return [
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
     */
    public function authorize(): bool
    {
        return true;
    }
}
