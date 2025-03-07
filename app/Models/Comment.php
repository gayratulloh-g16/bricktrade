<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'blog_id',
        'first_name',
        'last_name',
        'email',
        'comment',
    ];

    /**
     * A comment belongs to a blog.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
