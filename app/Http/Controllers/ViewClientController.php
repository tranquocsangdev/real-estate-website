<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewClientController extends Controller
{
    public function viewLogin()
    {
        return view('Client.Login.index');
    }

    public function viewRegister()
    {
        return view('Client.Register.index');
    }
}
