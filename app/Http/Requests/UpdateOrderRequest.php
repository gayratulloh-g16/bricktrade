<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

 
    public function rules(): array
    {
        return [
            'user_id'           => 'required|integer|exists:users,id',
            'driver_id'         => 'required|integer|exists:drivers,id',
            'order_date'        => 'required|date',
            'total_amount'      => 'required|numeric|min:0',
            'order_status'      => 'required|string|max:50',
            'shipping_address'  => 'required|string|max:255',
            'order_items'       => 'required|array|min:1',
            'order_items.*.brick_id'   => 'required|integer|exists:bricks,id',
            'order_items.*.quantity'   => 'required|integer|min:1',
            'order_items.*.unit_price' => 'required|numeric|min:0',
            'order_items.*.subtotal' => 'required|numeric|min:0',
        ];
    }
}
