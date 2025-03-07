<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'vehicle_number' => 'required|string',
        ];
    }
}
