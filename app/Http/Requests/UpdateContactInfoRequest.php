<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactInfoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }


    public function rules(): array
    {
        return [
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ];
    }
}
