<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SelfServiceController extends Controller
{
    public function readPayslip() {
        return view('portal.self-service.payslip.read');
    }
}
