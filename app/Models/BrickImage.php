<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrickImage extends Model
{
    protected $fillable = [
        'brick_id',
        'image',
    ];

    /**
     * An image belongs to a brick.
     */
    public function brick()
    {
        return $this->belongsTo(Brick::class);
    }
}
