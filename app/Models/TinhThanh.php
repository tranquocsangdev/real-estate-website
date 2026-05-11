<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TinhThanh extends Model
{
    protected $table = 'tinh_thanhs';

    protected $fillable = [
        'code',
        'name',
        'english_name',
        'administrative_level',
        'decree',
    ];

    public function xaPhuongs(): HasMany
    {
        return $this->hasMany(XaPhuong::class, 'id_thuoc_tinh_thanh', 'code');
    }
}

