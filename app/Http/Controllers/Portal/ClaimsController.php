<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClaimsController extends Controller
{
    public function create(){
        return view('portal.claims.create');
    }
    public function read(){
        return view('portal.claims.read');
    }
}
