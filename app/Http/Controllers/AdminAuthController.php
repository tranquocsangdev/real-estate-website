<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function actionLogin(Request $request)
    {

        $data['email']      = $request->email;
        $data['password']   = $request->password;
        $check = Auth::guard('nhanVien')->attempt($data);
        if ($check) {
            $nhan_vien = NhanVien::where('email', $request->email)
                ->where('is_open', 1)
                ->first();
            if ($nhan_vien) {
                Toastr::success("Bạn đã đăng nhập thành công!");
                return redirect('/admin/lich-lam-viec/dang-ky');
            } else {
                Toastr::error("Tài khoản đã bị khóa");
                Auth::guard('nhanVien')->logout();
                return redirect()->back();
            }
        } else {
            Toastr::error("Email hoặc mật khẩu không chính xác");
            return redirect()->back();
        }
    }
}
