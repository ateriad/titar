<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Enums\ReactionTypes;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Reaction;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReactionsControllers extends Controller
{
    public function index(Product $product)
    {
        $all = [];
        foreach (ReactionTypes::all() as $type) {
            $all[$type] = 0;
        }

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $product->id)
            ->groupBy('type')
            ->get();

        foreach ($reactions as $reaction) {
            $all[$reaction['type']] = $reaction['c'];
        }

        $userReaction = null;
        $reaction = Reaction::whereProductId($product->id)->whereUserId(Auth::id())->first();
        if ($reaction) {
            $userReaction = $reaction->type;
        }

        return new JsonResponse([
            'all' => $all,
            'user' => $userReaction,
        ]);
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
            'type' => ['required', 'in:' . implode(',', ReactionTypes::all())],
        ]);

        Reaction::updateOrInsert([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
        ], [
            'type' => $request->input('type'),
        ]);

        return new JsonResponse([
            'type' => $request->input('type'),
        ]);
    }
}
