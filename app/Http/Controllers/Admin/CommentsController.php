<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CommentsController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'is_accepted' => 'in:0'
        ]);

        $isAccepted = $request->input('is_accepted');

        $comments = Comment::with('product', 'product.video')
            ->orderByDesc('id')
            ->where(function (Builder $q) use ($isAccepted) {
                if ($isAccepted === '0') {
                    $q->where('is_accepted', '=', '0');
                }
            })
            ->paginate(10);

        $menu = $isAccepted === '0' ? 'acceptable' : 'all';

        return view('pages.admin.comments.index', [
            'comments' => $comments,
            'menu' => $menu,
        ]);
    }

    public function accept(int $comment)
    {
        Comment::whereId($comment)->update(['is_accepted' => 1]);

        return back()->with('success', trans('comments.updated'));
    }

    /**
     * @param int $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $comment)
    {
        Comment::whereId($comment)->delete();

        return back()->with('success', trans('comments.deleted'));
    }
}
