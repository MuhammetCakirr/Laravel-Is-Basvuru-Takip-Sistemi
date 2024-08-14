<?php

namespace App\Http\Requests\Requirement;

use App\Models\JobPosting;
use App\Models\JobRequirement;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequirementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "req_id"=>['required','integer','exists:job_requirement,id']
        ];
    }
    public function messages():array{
        return [
            'req_id.required' => 'Please fill in the requirement ID field.',
            'req_id.integer' => 'Requirement ID must be at integer.',
            'req_id.exists' => 'Requirement ID of this id has not been found.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     * @throws AuthorizationException
     */
    public function authorize(): bool
    {
        $req=JobRequirement::query()->findOrFail($this->input('req_id'));
        if($this->user()->cannot('delete',$req))
        {
            throw new AuthorizationException('You have no authority to delete this requirement.');
        }
        return true;
    }
}
