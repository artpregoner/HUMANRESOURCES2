<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

require __DIR__ . '/auth.php';

// employee portal
require __DIR__ . '/portal/dashboard.php';
require __DIR__ . '/portal/helpdesk.php';
