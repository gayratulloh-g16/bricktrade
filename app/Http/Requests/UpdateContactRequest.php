<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }


    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'text' => 'required',
        ];
    }
}
