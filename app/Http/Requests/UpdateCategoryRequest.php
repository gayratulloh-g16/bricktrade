<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }


    public function rules(): array
    {
        return [
            'name_uz' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
        ];
    }
}
