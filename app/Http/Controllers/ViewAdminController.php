<?php

namespace App\Http\Controllers;

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
}
