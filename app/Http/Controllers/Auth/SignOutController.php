<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class SignOutController extends Controller
{
    public function handle()
    {
        Auth::logout();

        return redirect()->route('auth.otp.show');
    }
}
