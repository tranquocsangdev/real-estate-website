<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ViewAdminController extends Controller
{
    public function viewCategory()
    {
        return view('Admin.Category.index');
    }

    public function viewSubCategory()
    {
        return view("Admin.Subcategory.index");
    }

    public function viewPost()
    {
        return view('Admin.Post.index');
    }

    public function viewAddPost()
    {
        return view('Admin.Post.create');
    }

    public function viewUpdatePost($id)
    {
        return view('Admin.Post.update', compact('id'));
    }

    public function viewLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/profile');
        }
        return view('Admin.Login.index');
    }

    public function viewAdmin()
    {
        return view('Admin.Admin.index');
    }

    public function viewProfile()
    {
        return view('Admin.Profile.index');
    }

    public function viewMessage()
    {
        return view('Admin.Message.index');
    }

    public function viewSettings()
    {
        return view('Admin.Settings.index', compact('settings'));
    }

    public function viewUserKhachHang()
    {
        return view('Admin.User.index');
    }
}
