<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Visit;
use DB;

class ReportsController extends Controller
{
    public function showPopularVideos()
    {
        $videoIds = Video::join('visits', 'videos.product_id', '=', 'visits.product_id')
            ->select('visits.product_id')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('product_id')
            ->orderByDesc('count')
            ->selectRaw('videos.id')
            ->groupBy('videos.id')
            ->pluck('id')
            ->toArray();

        $ids = implode(',', $videoIds);
        $videos = Video::whereIn('id', $videoIds)
            ->orderByRaw("FIELD(id, $ids)")
            ->paginate(10);

        return view('pages.admin.reports.videos.popular', [
            'videos' => $videos,
        ]);

    }
}
