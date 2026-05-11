<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'id_tinh_thanh',
        'id_xa_phuong',
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

    public function tinhThanh(): BelongsTo
    {
        return $this->belongsTo(TinhThanh::class, 'id_tinh_thanh');
    }

    public function xaPhuong(): BelongsTo
    {
        return $this->belongsTo(XaPhuong::class, 'id_xa_phuong');
    }
}

