<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }


    public function rules(): array
    {
        return [
            'user_id'  => 'required|integer|exists:users,id',
            'order_id' => 'required|integer|exists:orders,id',
            'rating'   => 'required|numeric|min:0|max:5',
            'text'     => 'required|string',
        ];
    }
}
