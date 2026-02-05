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
        'id_category',
        'id_subcategory',
        'views',
        'status',
    ];
}
