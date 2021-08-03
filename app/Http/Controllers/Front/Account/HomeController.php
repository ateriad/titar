<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function show()
    {
        return view('pages.front.account.home', [
            'tab' => 'home',
        ]);
    }
}
