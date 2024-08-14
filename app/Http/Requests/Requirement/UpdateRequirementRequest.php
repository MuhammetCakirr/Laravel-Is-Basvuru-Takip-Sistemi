<?php

namespace App\Http\Requests\Requirement;

use App\Models\JobRequirement;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequirementRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "req_id"=>['required','integer','exists:job_requirement,id'],
            "require"=>['required','string']
        ];
    }
    public function messages():array{
        return[
            'req_id.required' => 'Please fill in the requirement ID field.',
            'req_id.integer' => 'Requirement ID must be at integer.',
            'req_id.exists' => 'Requirement ID of this id has not been found.',
            'require.required'=>"Please fill in the require field.",
            'require.string'=>"Require must be at string.",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     * @throws AuthorizationException
     */
    public function authorize(): bool
    {
        $req=JobRequirement::query()->findOrFail($this->input('req_id'));
        if($this->user()->cannot('update',$req))
        {
            throw new AuthorizationException('You have no authority to update this requirement.');
        }
        return true;
    }
}
