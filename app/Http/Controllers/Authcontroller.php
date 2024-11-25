<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function loginPanel()
    {
        return view('auth.login');
    }
    public function home(){
        return view('portal.home');
    }
}
