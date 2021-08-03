<?php

namespace App\Http\Controllers\Front\Videos;

use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use App\Models\Slide;

class HomeController extends Controller
{
    public function show()
    {
        return view('pages.front.videos.home');
    }
}
