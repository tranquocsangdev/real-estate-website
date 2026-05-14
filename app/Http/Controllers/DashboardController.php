<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDataDashboard()
    {
        $tong_post = Post::where('status', Post::HOAT_DONG)
                        ->count();

        $tong_user = KhachHang::count();

        return response([
            'tong_post' => $tong_post,
            'tong_user' => $tong_user,
        ]);
    }
}
