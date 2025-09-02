<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComment extends FormRequest
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
        $commentId = $this->route('comment') instanceof \App\Models\Comment
            ? $this->route('comment')->id
            : $this->route('comment');

        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'post_id' => [
                'required',
                'integer',
                'exists:posts,id',
            ],
            'content' => [
                'required',
                'string',
                'max:1000',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'usuario',
            'post_id' => 'publicación',
            'content' => 'comentario',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.integer' => 'El :attribute debe ser un número entero.',
            'user_id.exists' => 'El :attribute seleccionado no existe.',
            'post_id.required' => 'La :attribute es obligatoria.',
            'post_id.integer' => 'La :attribute debe ser un número entero.',
            'post_id.exists' => 'La :attribute seleccionada no existe.',
            'content.required' => 'El :attribute es obligatorio.',
            'content.string' => 'El :attribute debe ser una cadena de texto.',
            'content.max' => 'El :attribute no puede tener más de :max caracteres.',
        ];
    }
}
