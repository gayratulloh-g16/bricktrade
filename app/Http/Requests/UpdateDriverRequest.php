<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public function rules(): array
    {
        return [
            // User fields
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'password'        => 'nullable|string|min:8|confirmed',
            'phone_number'    => 'nullable|string',
            'address'         => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',

            // Driver-specific fields
            'vehicle_number'  => 'required|string',
            'latitude'        => 'nullable|numeric',
            'longitude'       => 'nullable|numeric',  
        ];
    }
}
