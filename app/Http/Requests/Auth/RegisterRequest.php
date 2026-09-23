<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Введіть ваш email.',


            'password.required' => 'Введіть пароль.',
            'password.confirmed' => 'Паролі не співпадають.',
            'password.min' => 'Пароль має містити щонайменше :min символів.',
            'password.letters' => 'Пароль має містити хоча б одну літеру.',
            'password.mixed' => 'Пароль має містити великі та малі літери.',
            'password.numbers' => 'Пароль має містити хоча б одну цифру.',
            'password.symbols' => 'Пароль має містити хоча б один спецсимвол.',
            'password.uncompromised' => 'Цей пароль зустрічався в витоках даних, оберіть інший.',
        ];
    }
}
