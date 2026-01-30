<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachHangController extends Controller
{
    public function actionRegister(Request $request)
    {
        KhachHang::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);
        Toastr::success('Đăng ký thành công! Vui lòng đăng nhập để tiếp tục', 'Success');
        return redirect('/user/login');
    }

    public function actionLogin(Request $request)
    {
        $data['email']      = $request->email;
        $data['password']   = $request->password;
        $check = Auth::guard('khach_hangs')->attempt($data);
        if ($check) {
            $khach_hang = KhachHang::where('email', $request->email)
                                    ->where('is_active', 1)
                                    ->first();
            if ($khach_hang) {
                Toastr::success("Bạn đã đăng nhập thành công!", 'Success!');
                return redirect('/');
            } else {
                Toastr::error("Tài khoản đã bị khóa", 'Error!');
                Auth::guard('khach_hangs')->logout();
                return redirect()->back();
            }
        } else {
            Toastr::error("Email hoặc mật khẩu không chính xác", 'Error!');
            return redirect()->back();
        }
    }

    public function actionLogout()
    {
        Auth::guard('khach_hangs')->logout();
        Toastr::success("Bạn đã đăng xuất thành công!", 'Success!');
        return redirect('/user/login');
    }
}
