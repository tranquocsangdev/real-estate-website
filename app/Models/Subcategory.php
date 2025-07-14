<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'id_category',
        'status',
    ];
}
