<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'driver_id',
        'order_date',
        'total_amount',
        'order_status',
        'shipping_address',
    ];

    /**
     * An order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An order is assigned a driver.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * An order has many order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * An order may have one feedback.
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
