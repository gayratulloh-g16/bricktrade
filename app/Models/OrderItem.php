<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'brick_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    /**
     * An order item belongs to an order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * An order item references a brick.
     */
    public function brick()
    {
        return $this->belongsTo(Brick::class);
    }
}
