<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }


    public function rules(): array
    {
        return [
            'user_id'   => 'required|integer|exists:users,id',
            'brick_id'  => 'required|integer|exists:bricks,id',
            'rating'    => 'required|numeric|min:0|max:5',
            'text'      => 'required|string',
        ];
    }
}
