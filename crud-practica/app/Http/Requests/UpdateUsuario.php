<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuario extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user') instanceof \App\Models\User
            ? $this->route('user')->id
            : $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'sometimes', // o 'sometimes' si no quieres editar el correo
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
    public function attributes(){
        return [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la :attribute no coincide.',
        ];
    }
}
