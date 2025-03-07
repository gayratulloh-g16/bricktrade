<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brick extends Model
{
    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'price',
        'description_uz',
        'description_ru',
        'description_en',
        'residual',
    ];

    /**
     * A brick may have many images.
     */
    public function images()
    {
        return $this->hasMany(BrickImage::class);
    }

    /**
     * A brick can have many reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * A brick can be present in many order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
