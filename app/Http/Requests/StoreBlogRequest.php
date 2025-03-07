<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }


    public function rules(): array
    {
        return [
            'category_id' => 'integer|required|exists:categories,id',
            'title_uz' => 'string|required',
            'title_ru' => 'string|required',
            'title_en' => 'string|required',
            'text_uz' => 'string|required',
            'text_ru' => 'string|required',
            'text_en' => 'string|required',
            'image' => 'nullable',
        ];
    }
}
