<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'rating',
        'text',
    ];

    /**
     * Feedback belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Feedback is related to an order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
