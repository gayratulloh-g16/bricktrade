<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'brick_id',
        'rating',
        'text',
    ];

    /**
     * A review belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A review belongs to a brick.
     */
    public function brick()
    {
        return $this->belongsTo(Brick::class);
    }
}
