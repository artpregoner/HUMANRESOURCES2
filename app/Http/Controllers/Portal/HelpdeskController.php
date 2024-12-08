<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    public function read(){
        return view('portal.helpdesk.read');
    }
    public function create(){
        return view('portal.helpdesk.create');
    }
}
