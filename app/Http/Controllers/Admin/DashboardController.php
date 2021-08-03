<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Clients;
use App\Http\Controllers\Controller;
use App\Models\AdVisit;
use App\Models\SignInActivity;
use App\Models\Visit;
use Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $signInLogs = SignInActivity::whereUserId(Auth::id())->orderByDesc('id')->paginate(10);

        $videoVisits = Visit::all();
        $videoVisitsCount = $videoVisits->count();

        $adVisitsCount = adVisit::count();

        $webVisitsCount = $videoVisits->where('source', Clients::WEB)->count();

        $androidVisitsCount = $videoVisits->where('source', Clients::ANDROID)->count();

        $windowsVisitsCount = $videoVisits->where('source', Clients::WINDOWS)->count();

        return view('pages.admin.dashboard', [
            'signInLogs' => $signInLogs,
            'videoVisitsCount' => $videoVisitsCount,
            'adVisitsCount' => $adVisitsCount,
            'webVisitsCount' => $webVisitsCount,
            'androidVisitsCount' => $androidVisitsCount,
            'windowsVisitsCount' => $windowsVisitsCount,
        ]);
    }
}
