<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function actionLogin(Request $request)
    {
        $data['email']      = $request->email;
        $data['password']   = $request->password;
        $check = Auth::guard('admin')->attempt($data);
        if ($check) {
            $admin = Admin::where('email', $request->email)
                              ->where('is_open', 1)
                              ->first();
            if ($admin) {
                Toastr::success("Bạn đã đăng nhập thành công!", 'Success');
                return redirect('/admin/category');
            } else {
                Toastr::error("Tài khoản đã bị khóa", 'Error');
                Auth::guard('admin')->logout();
                return redirect()->back();
            }
        } else {
            Toastr::error("Email hoặc mật khẩu không chính xác", 'Error');
            return redirect()->back();
        }
    }

    public function actionLogout()
    {
        Auth::guard('admin')->logout();
        Toastr::success("Bạn đã đăng xuất thành công!", 'Success');
        return redirect('/admin/login');
    }
}
