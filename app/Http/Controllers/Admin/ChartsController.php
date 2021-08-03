<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Clients;
use App\Http\Controllers\Controller;
use App\Models\AdVisit;
use App\Models\Event;
use App\Models\SignInActivity;
use App\Models\User;
use App\Models\Video;
use App\Models\Visit;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ChartsController extends Controller
{
    public function index()
    {
        return view('pages.admin.charts.index');
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function showVideosVisits(Request $request)
    {
        $this->validate($request, [
            'video_id' => 'nullable|exists:videos,id',
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::now()->subMonth();
        }

        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        $videoId = $request->input('video_id', '');

        $product_id = '';
        if ($videoId !== '') {
            $product_id = Video::findOrFail($videoId)->product_id;
        }

        /** @var Collection $visits */
        $visits = Visit::select(DB::raw("COUNT(id) c, DATE_FORMAT(created_at, '%Y-%m-%d') d"))
            ->where(function (Builder $q) use ($product_id) {
                if ($product_id) {
                    $q->where('product_id', '=', $product_id);
                }
            })
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $labels = $data = [];

        $head = clone $from;
        while ($head->getTimestamp() <= $to->getTimestamp()) {
            $day = $head->format('Y-m-d');
            $visit = $visits->where('d', '=', $day)->first();
            $data[] = $visit ? $visit->c : 0;
            $labels[] = jDate(Carbon::createFromFormat('Y-m-d', $day), 'yyyy-MM-dd');
            $head = $head->addDay();
        }

        return view('pages.admin.charts.videos.visits', [
            'labels' => $labels,
            'data' => $data,
            'from' => $from,
            'to' => $to,
            'videoId' => $videoId,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function showEventsVisits(Request $request)
    {
        $this->validate($request, [
            'event_id' => 'nullable|exists:events,id',
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::now()->subMonth();
        }

        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        $eventId = $request->input('event_id', '');

        $productId = '';
        if ($eventId !== '') {
            $productId = Event::findOrFail($eventId)->product_id;
        }

        /** @var Collection $visits */
        $visits = Visit::select(DB::raw("COUNT(id) c, DATE_FORMAT(created_at, '%Y-%m-%d') d"))
            ->where(function (Builder $q) use ($productId) {
                if ($productId) {
                    $q->where('product_id', '=', $productId);
                }
            })
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $labels = $data = [];

        $head = clone $from;
        while ($head->getTimestamp() <= $to->getTimestamp()) {
            $day = $head->format('Y-m-d');
            $visit = $visits->where('d', '=', $day)->first();
            $data[] = $visit ? $visit->c : 0;
            $labels[] = jDate(Carbon::createFromFormat('Y-m-d', $day), 'yyyy-MM-dd');
            $head = $head->addDay();
        }

        return view('pages.admin.charts.events.visits', [
            'labels' => $labels,
            'data' => $data,
            'from' => $from,
            'to' => $to,
            'eventId' => $eventId,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function showAdvertisementsVisits(Request $request)
    {
        $this->validate($request, [
            'advertisement_id' => 'nullable|exists:advertisements,id',
            'user_id' => 'nullable|exists:users,id',
            'video_id' => 'nullable|exists:videos,id',
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::now()->subMonth();
        }

        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        $videoId = $request->input('video_id', '');

        $productId = '';
        if ($videoId !== '') {
            $productId = Video::findOrFail($videoId)->product_id;
        }

        $userId = $request->input('user_id', '');

        $advertisementId = $request->input('advertisement_id', '');

        /** @var Collection $adVisit */
        $adVisit = AdVisit::select(DB::raw("COUNT(id) c, DATE_FORMAT(created_at, '%Y-%m-%d') d"))
            ->where(function (Builder $q) use ($productId) {
                if ($productId) {
                    $q->where('product_id', '=', $productId);
                }
            })
            ->where(function (Builder $q) use ($advertisementId) {
                if ($advertisementId) {
                    $q->where('advertisement_id', '=', $advertisementId);
                }
            })
            ->where(function (Builder $q) use ($userId) {
                if ($userId) {
                    $q->where('user_id', '=', $userId);
                }
            })
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $labels = $data = [];

        $head = clone $from;
        while ($head->getTimestamp() <= $to->getTimestamp()) {
            $day = $head->format('Y-m-d');
            $v = $adVisit->where('d', '=', $day)->first();
            $data[] = $v ? $v->c : 0;
            $labels[] = jDate(Carbon::createFromFormat('Y-m-d', $day), 'yyyy-MM-dd');
            $head = $head->addDay();
        }

        return view('pages.admin.charts.advertisement.visits', [
            'labels' => $labels,
            'data' => $data,
            'from' => $from,
            'to' => $to,
            'videoId' => $videoId,
            'userId' => $userId,
            'advertisementId' => $advertisementId,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function showSource(Request $request)
    {
        $this->validate($request, [
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::now()->subMonth();
        }

        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        $start = $from->format('Y-m-d');
        $end = $to->format('Y-m-d');

        $c = Visit::where('source', '!=', null)->count();

        $web = Visit::whereSource(Clients::WEB)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->count();

        $windows = Visit::whereSource(Clients::WINDOWS)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->count();

        $android = Visit::whereSource(Clients::ANDROID)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->count();

        $ios = Visit::whereSource(Clients::IOS)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->count();

        $data['labels'][0] = 'web';
        $data['data'][0] = floor(($web / $c) * 100);
        $data['labels'][1] = 'windows';
        $data['data'][1] = floor(($windows / $c) * 100);
        $data['labels'][2] = 'android';
        $data['data'][2] = floor(($android / $c) * 100);
        $data['labels'][3] = 'ios';
        $data['data'][3] = floor(($ios / $c) * 100);;

        $data['chart'] = json_encode($data);

        return view('pages.admin.charts.source', [
            'data' => $data,
            'from' => $from,
            'to' => $to,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function showUsersSignIn(Request $request)
    {
        $this->validate($request, [
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::now()->subMonth();
        }

        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        /** @var Collection $activities */
        $activities = SignInActivity::select(DB::raw("COUNT(id) c, DATE_FORMAT(created_at, '%Y-%m-%d') d"))
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $labels = $data = [];

        $head = clone $from;
        while ($head->getTimestamp() <= $to->getTimestamp()) {
            $day = $head->format('Y-m-d');
            $user = $activities->where('d', '=', $day)->first();
            $data[] = $user ? $user->c : 0;
            $labels[] = jDate(Carbon::createFromFormat('Y-m-d', $day), 'yyyy-MM-dd');
            $head = $head->addDay();
        }

        return view('pages.admin.charts.users.sign-in', [
            'labels' => $labels,
            'data' => $data,
            'from' => $from,
            'to' => $to,
        ]);
    }

    public function showUsersSignUp(Request $request)
    {
        $this->validate($request, [
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::now()->subMonth();
        }

        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        /** @var Collection $users */
        $users = User::select(DB::raw("COUNT(id) c, DATE_FORMAT(created_at, '%Y-%m-%d') d"))
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $labels = $data = [];

        $head = clone $from;
        while ($head->getTimestamp() <= $to->getTimestamp()) {
            $day = $head->format('Y-m-d');
            $user = $users->where('d', '=', $day)->first();
            $data[] = $user ? $user->c : 0;
            $labels[] = jDate(Carbon::createFromFormat('Y-m-d', $day), 'yyyy-MM-dd');
            $head = $head->addDay();
        }

        return view('pages.admin.charts.users.sign-up', [
            'labels' => $labels,
            'data' => $data,
            'from' => $from,
            'to' => $to,
        ]);
    }
}
