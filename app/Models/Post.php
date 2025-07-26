<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'id_client',
        'id_category',
        'id_subcategory',
        'thumbnail',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'location',
        'address',
        'project_name',
        'phone',
        'zalo_link',
        'map_link',
        'images',
    ];
}
