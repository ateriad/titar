<?php

namespace App\Http\Controllers\Front\Videos;

use App\Enums\AdvertisementStatuses;
use App\Enums\Clients;
use App\Enums\ReactionTypes;
use App\Http\Controllers\Controller;
use App\Jobs\Advertisement\AdVisitJob;
use App\Jobs\Products\VisitJob;
use App\Models\Advertisement;
use App\Models\AdVisit;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class VideosController extends Controller
{
    public function preview(Video $video)
    {
        /** @var Reaction $r */
        $r = Reaction::whereProductId($video->product_id)
            ->whereUserId(auth()->id())
            ->first();

        $reaction = $r ? $reaction = $r->type : 0;

        $comments = Comment::whereProductId($video->product_id)
            ->whereIsAccepted(true)
            ->paginate(10);

        $visitCount = $video->product->visits()->count();

        return view('pages.front.videos.preview', [
            'video' => $video,
            'visitCount' => $visitCount,
            'reaction' => $reaction,
            'comments' => $comments,
        ]);
    }

    public function show(Video $video)
    {
        $type = Str::endsWith($video->attribute('url'), '.m3u8') ? 'application/x-mpegURL' : 'video/mp4';
        $this->dispatch(new VisitJob($video->product_id, auth()->id(), request()->ip(), Clients::WEB));

        $advertisement = Advertisement::whereStatus(AdvertisementStatuses::ENABLE)->inRandomOrder()->first();
        if ($advertisement !== null) {
            $this->dispatch(new AdVisitJob($video->product_id, $advertisement->id, auth()->id(), request()->ip(), Clients::WEB));
        }

        return view('pages.front.videos.player', [
            'video' => $video,
            'type' => $type,
            'advertisement' => $advertisement,
        ]);
    }

    /**
     * @param Video $video
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function react(Video $video, Request $request)
    {
        if (empty(auth()->id())) {
            return new JsonResponse([
                'error' => 'Unauthorized.',
            ], 401);
        }

        $this->validate($request, [
            'type' => ['required', 'in:' . join(',', ReactionTypes::values())],
        ]);

        Reaction::updateOrInsert([
            'product_id' => $video->product_id,
            'user_id' => auth()->id(),
        ], [
            'type' => $request->input('type'),
        ]);

        $likes = $dislikes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $video->product_id)
            ->groupBy('type')
            ->get();

        foreach ($reactions as $reaction) {
            $reaction['type'] == ReactionTypes::LIKE && $likes++;
            $reaction['type'] == ReactionTypes::DISLIKE && $dislikes++;
        }

        return new JsonResponse([
            'likes' => $likes,
            'dislikes' => $dislikes,
            'reaction' => $request->input('type'),
        ]);
    }

    /**
     * @param Video $video
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function comment(Video $video, Request $request)
    {
        $this->validate($request, [
            'content' => ['required'],
        ]);

        $comment = new Comment();
        $comment->is_accepted = false;
        $comment->user_id = auth()->id();
        $comment->product_id = $video->product_id;
        $comment->content = $request->input('content');
        $comment->save();

        return back()->with('success', trans('comments.sent'));
    }
}
