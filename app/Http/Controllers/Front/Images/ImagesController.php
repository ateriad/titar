<?php

namespace App\Http\Controllers\Front\Images;

use App\Enums\AdvertisementStatuses;
use App\Enums\Clients;
use App\Enums\ReactionTypes;
use App\Http\Controllers\Controller;
use App\Jobs\Advertisement\AdVisitJob;
use App\Jobs\Products\VisitJob;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Reaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ImagesController extends Controller
{
    public function preview(Image $image)
    {
        $likes = $dislikes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $image->product_id)
            ->groupBy('type')
            ->get();

        foreach ($reactions as $reaction) {
            $reaction['type'] == ReactionTypes::LIKE && $likes++;
            $reaction['type'] == ReactionTypes::DISLIKE && $dislikes++;
        }

        /** @var Reaction $r */
        $r = Reaction::whereProductId($image->product_id)
            ->whereUserId(auth()->id())
            ->first();

        $reaction = $r ? $reaction = $r->type : 0;

        $comments = Comment::whereProductId($image->product_id)
            ->whereIsAccepted(true)
            ->paginate(10);

        $visitCount = $image->product->visits()->count();

        return view('pages.front.images.preview', [
            'image' => $image,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'visitCount' => $visitCount,
            'reaction' => $reaction,
            'comments' => $comments,
        ]);
    }

    public function show(Image $image)
    {
        $type = Str::endsWith($image->attribute('url'), '.m3u8') ? 'application/x-mpegURL' : 'image/jpeg';
        $this->dispatch(new VisitJob($image->product_id, auth()->id(), request()->ip(), Clients::WEB));

        return view('pages.front.images.player', [
            'image' => $image,
            'type' => $type,
        ]);
    }

    /**
     * @param Image $image
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function react(Image $image, Request $request)
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
            'product_id' => $image->product_id,
            'user_id' => auth()->id(),
        ], [
            'type' => $request->input('type'),
        ]);

        $likes = $dislikes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $image->product_id)
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
     * @param Image $image
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function comment(Image $image, Request $request)
    {
        $this->validate($request, [
            'content' => ['required'],
        ]);

        $comment = new Comment();
        $comment->is_accepted = false;
        $comment->user_id = auth()->id();
        $comment->product_id = $image->product_id;
        $comment->content = $request->input('content');
        $comment->save();

        return back()->with('success', trans('comments.sent'));
    }
}
