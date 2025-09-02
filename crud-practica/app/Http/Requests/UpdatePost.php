<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdatePost extends FormRequest
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
        $postId = $this->route('post') instanceof \App\Models\Post
            ? $this->route('post')->id
            : $this->route('post');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'title')->ignore($postId),
            ],
            'content' => 'required|string',
        ];
    }

    public function attributes() : array
    {
        return [
            'title' => 'título',
            'content' => 'contenido',
        ];
    }

    public function messages() : array
    {
        return [
            'title.required' => 'El :attribute es obligatorio.',
            'title.string' => 'El :attribute debe ser una cadena de texto.',
            'title.max' => 'El :attribute no puede tener más de :max caracteres.',
            'title.unique' => 'El :attribute ya existe.',
            'content.required' => 'El :attribute es obligatorio.',
            'content.string' => 'El :attribute debe ser una cadena de texto.',
        ];
    }
}
