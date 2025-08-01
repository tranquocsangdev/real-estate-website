<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

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

    public function viewLogin()
    {
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

    public function viewChatNoiBo()
    {
        $users = Admin::where('id', '!=', auth()->id())->get();
        return view("Admin.ChatNoiBo.index", compact('users'));
    }
}
