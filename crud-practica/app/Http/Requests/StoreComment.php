<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
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
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'content' => 'contenido',
            'post_id' => 'post',
            'user_id' => 'usuario',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'El :attribute es obligatorio.',
            'content.string' => 'El :attribute debe ser una cadena de texto.',
            'post_id.required' => 'El :attribute es obligatorio.',
            'post_id.exists' => 'El :attribute seleccionado no existe.',
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute seleccionado no existe.',
        ];
    }
}
