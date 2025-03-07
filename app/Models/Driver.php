<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'vehicle_number',
    ];

    /**
     * A driver can be assigned to many orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
