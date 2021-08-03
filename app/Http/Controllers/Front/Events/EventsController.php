<?php

namespace App\Http\Controllers\Front\Events;

use App\Enums\Clients;
use App\Enums\ReactionTypes;
use App\Http\Controllers\Controller;
use App\Jobs\Products\VisitJob;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
{
    public function preview(Event $event)
    {
        $likes = $dislikes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $event->product_id)
            ->groupBy('type')
            ->get();

        foreach ($reactions as $reaction) {
            $reaction['type'] == ReactionTypes::LIKE && $likes++;
            $reaction['type'] == ReactionTypes::DISLIKE && $dislikes++;
        }

        /** @var Reaction $r */
        $r = Reaction::whereProductId($event->product_id)
            ->whereUserId(auth()->id())
            ->first();

        $reaction = $r ? $reaction = $r->type : 0;

        $comments = Comment::whereProductId($event->product_id)
            ->whereIsAccepted(true)
            ->paginate(10);

        $visitCount = $event->product->visits()->count();

        return view('pages.front.events.preview', [
            'event' => $event,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'visitCount' => $visitCount,
            'reaction' => $reaction,
            'comments' => $comments,
        ]);
    }

    public function show(Event $event)
    {
        $type = Str::endsWith($event->attribute('url'), '.m3u8') ? 'application/x-mpegURL' : 'event/mp4';
        $this->dispatch(new VisitJob($event->product_id , auth()->id() , request()->ip() , Clients::WEB));

        return view('pages.front.events.player', [
            'event' => $event,
            'type' => $type,
        ]);
    }

    /**
     * @param Event $event
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function react(Event $event, Request $request)
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
            'product_id' => $event->product_id,
            'user_id' => auth()->id(),
        ], [
            'type' => $request->input('type'),
        ]);

        $likes = $dislikes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $event->product_id)
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
     * @param Event $event
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function comment(Event $event, Request $request)
    {
        $this->validate($request, [
            'content' => ['required'],
        ]);

        $comment = new Comment();
        $comment->is_accepted = false;
        $comment->user_id = auth()->id();
        $comment->product_id = $event->product_id;
        $comment->content = $request->input('content');
        $comment->save();

        return back()->with('success', trans('comments.sent'));
    }
}
