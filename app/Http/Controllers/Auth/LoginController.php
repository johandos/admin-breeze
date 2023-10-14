<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $maxAttempts = 3;
    protected $decayMinutes = 2;
}
