<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'category_id',
        'title_uz',
        'title_ru',
        'title_en',
        'text_uz',
        'text_ru',
        'text_en',
        'image',
    ];

    /**
     * A blog belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A blog can have many comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
