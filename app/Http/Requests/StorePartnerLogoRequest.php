<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerLogoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048'
        ];
    }
}
