<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class KhachHang extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'khach_hangs';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];
}
