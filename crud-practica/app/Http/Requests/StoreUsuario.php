<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuario extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
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
            'email.unique' => 'El :attribute ya está en uso.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la :attribute no coincide.',
        ];
    }
}
