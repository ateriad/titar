<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Exceptions\ApiErrorException;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{
    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Product $product, Request $request)
    {
        $this->validate($request, [
            'per_page' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        return new JsonResponse(
            Comment::with('user')
                ->whereProductId($product->id)
                ->orderByDesc('id')
                ->paginate($request->input('per_page', 10))
        );
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Product $product, Request $request)
    {
        $this->validate($request, [
            'content' => ['required', 'string', 'min:1', 'max:500'],
        ]);

        $comment = new Comment();
        $comment->product_id = $product->id;
        $comment->user_id = auth()->id();
        $comment->content = $request->input('content');
        $comment->is_accepted = false;
        $comment->save();

        return new JsonResponse($comment);
    }

    /**
     * @param Product $product
     * @param Comment $comment
     * @param Request $request
     * @return JsonResponse
     * @throws ApiErrorException
     * @throws ValidationException
     */
    public function update(Product $product, Comment $comment, Request $request)
    {
        $this->validate($request, [
            'content' => ['required', 'string', 'min:1', 'max:500'],
        ]);

        if ($comment->user_id != auth()->id() || $comment->product_id != $product->id) {
            throw new ApiErrorException('Forbidden.', 403);
        }

        $comment->content = $request->input('content');
        $comment->save();

        return new JsonResponse($comment);
    }
}
