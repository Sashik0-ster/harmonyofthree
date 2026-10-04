<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'max:20', 'min:3'],
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => 'Введіть будьласка ім\'я',
            'name.max' => 'Ім\'я має бути не більше 20 символів',
            'name.min' => 'Ім\'я має бути не меньше 3 символів'
        ];
    }
}
