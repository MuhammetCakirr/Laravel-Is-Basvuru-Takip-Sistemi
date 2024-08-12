<?php

namespace App\Http\Requests\Skill;

use App\Models\Skill;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'skill_id' => ['exists:skills,id', 'integer', 'required'],
            'name' => ['sometimes', 'string', 'min:3'],
            'level' => ['integer', 'sometimes'],
        ];

    }

    public function messages(): array
    {
        return [
            'skill_id.required' => 'Please fill in the skill ID field.',
            'skill_id.integer' => 'Skill ID must be at integer.',
            'skill_id.exists' => 'the skill Id of this id has not been found.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.string' => 'Name must be at string.',
            'level.integer' => 'Name must be at integer.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @throws AuthorizationException
     */
    public function authorize(): bool
    {
        $skill = Skill::query()->findOrFail($this->input('skill_id'));
        if ($this->user()->cannot('update', $skill)) {
            throw new AuthorizationException('You do not have permission to update this skill.');
        }

        return true;
    }
}
