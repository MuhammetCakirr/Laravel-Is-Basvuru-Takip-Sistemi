<?php

namespace App\Http\Requests\Application;

use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Rules\DoesHaveApplication;
use App\Rules\IsPostActive;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "application_id"=>["required","integer","exists:job_application,id",new DoesHaveApplication()],
        ];
    }

    public function messages():array{
        return [
            "application_id.required"=>"Please fill in the job application ID field.",
            "application_id.integer"=>"Application ID must be at integer.",
            "application_id.exists"=>"Application ID of this id has not been found.",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     * @throws AuthorizationException
     */
    public function authorize(): bool
    {
        $post = JobApplication::query()->findOrFail($this->input('application_id'));
        if ($this->user()->cannot('update', $post)) {
            throw new AuthorizationException('You do not have permission to cancel this application.');
        }

        return true;

    }
}
