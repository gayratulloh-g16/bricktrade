<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }


    public function rules(): array
    {
        return [
            'blog_id' => 'required|integer|exists:blogs,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required',
            'comment' => 'required|string',
        ];
    }
}
