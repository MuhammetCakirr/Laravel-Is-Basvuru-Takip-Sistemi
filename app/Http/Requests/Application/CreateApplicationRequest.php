<?php

namespace App\Http\Requests\Application;

use App\Models\JobPosting;
use App\Rules\DoesHaveApplication;
use App\Rules\IsPostActive;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "job_posting_id"=>["required","integer","exists:job_posting,id",new IsPostActive()],
            "cover_letter"=>["required","string"],
        ];
    }

    public function messages():array{
        return [
            "job_posting_id.required"=>"Please fill in the job posting ID field.",
            "job_posting_id.integer"=>"Job posting ID must be at integer.",
            "job_posting_id.exists"=>"Job posting Id of this id has not been found.",
            "cover_letter.required"=>"Please fill in the cover letter  field.",
            "cover_letter.string"=>"Cover letter  must be at string.",

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
