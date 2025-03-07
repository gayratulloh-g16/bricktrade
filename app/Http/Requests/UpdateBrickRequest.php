<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrickRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'name_uz'         => 'required|string|max:255',
            'name_ru'         => 'required|string|max:255',
            'name_en'         => 'required|string|max:255',
            'price'           => 'required|numeric|min:0',
            'description_uz'  => 'required|string',
            'description_ru'  => 'required|string',
            'description_en'  => 'required|string',
            'residual'        => 'required|integer|min:0',
            // Images are optional on update.
            'images'          => 'nullable|array',
            'images.*'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
