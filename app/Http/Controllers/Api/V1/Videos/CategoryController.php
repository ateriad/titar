<?php

namespace App\Http\Controllers\Api\V1\Videos;

use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'per_page' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        return new JsonResponse(
            VideoCategory::with('children')
                ->where('parent_id', '=', '0')
                ->paginate($request->input('per_page', 10))
        );
    }

    /**
     * @param VideoCategory $category
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function show(Request $request, VideoCategory $category)
    {
        $this->validate($request, [
            'per_page' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        return new JsonResponse(
            $category
                ->videos()
                ->with(['attributes', 'product'])
                ->paginate($request->input('per_page', 10))
        );
    }
}
