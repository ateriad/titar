<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use App\Models\Slide;
use App\Models\Video;
use Illuminate\Http\Request;
use Lang;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('q');

        $videos = Video::where('title', 'like', "%$query%")
            ->paginate(50);

        $title = trans('words.search-result' , ['query' => $query]);

        return view('pages.front.videos.list', [
            'videos' => $videos,
            'title' => $title ,
        ]);
    }
}
