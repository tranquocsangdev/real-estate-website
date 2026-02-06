<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'type',
        'tieu_de',
        'noi_dung',
        'id_doi_tuong',
        'is_read',
    ];

    const KHACH_HANG_REGISTER = 1;
    const KHACH_HANG_XEM_BLOG = 2;
    const KHACH_HANG_XEM_POST = 3;
    const KHACH_HANG_XEM_CATEGORY = 4;
}
