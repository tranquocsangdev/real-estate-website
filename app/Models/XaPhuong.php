<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XaPhuong extends Model
{
    protected $table = 'xa_phuongs';

    protected $fillable = [
        'code',
        'name',
        'id_code_tinh_thanh',
        'administrative_level',
    ];
}
