<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewClientController extends Controller
{
    public function viewLogin()
    {
        if (Auth::guard('khach_hangs')->check()) {
            Toastr::error("Bạn đã đăng nhập rồi!", 'Error!');
            return redirect('/');
        }
        return view('Client.Login.index');
    }

    public function viewRegister()
    {
        if (Auth::guard('khach_hangs')->check()) {
            Toastr::error("Bạn đã đăng nhập rồi!", 'Error!');
            return redirect('/');
        }
        return view('Client.Register.index');
    }

    public function viewProfile()
    {
        return view('Client.User.Profile.index');
    }
}
