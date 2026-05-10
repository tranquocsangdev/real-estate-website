<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'views',
        'status',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
}
