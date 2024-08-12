<?php

namespace App\Http\Requests\Skill;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class CreateSkillRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'string'],
            'level' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please fill in the name field.',
            'level.required' => 'Please fill in the level field.',
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
        //        $user=User::query()->find($this->user()->id);

        //        return $this->user()->can('create',$user);
        if ($this->user()->cannot('create')) {
            throw new AuthorizationException('You do not have permission to create skill.');
        }

        return true;

    }
}
