<?php

namespace App\Http\Requests\Application;

use App\Models\JobApplication;
use App\Rules\DoesHaveApplication;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class ViewApplicationRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "application_id"=>["required","integer","exists:job_application,id"],
        ];
    }

    public function messages():array
    {
        return [
            "application_id.required"=>"Please fill in the job posting ID field.",
            "application_id.integer"=>"Job posting ID must be at integer.",
            "application_id.exists"=>"Job posting Id of this id has not been found.",

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     * @throws AuthorizationException
     */
    public function authorize(): bool
    {
        $post = JobApplication::query()->findOrFail($this->input('application_id'));
        if ($this->user()->cannot('view', $post)) {
            throw new AuthorizationException('You do not have permission to view this application.');
        }
        return true;
    }
}
