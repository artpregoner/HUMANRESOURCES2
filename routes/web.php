<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

require __DIR__ . '/auth.php';

// employee portal
require __DIR__ . '/portal/portal.php';
require __DIR__ . '/portal/self-service.php';
require __DIR__ . '/portal/helpdesk.php';
require __DIR__ . '/portal/claims.php';
