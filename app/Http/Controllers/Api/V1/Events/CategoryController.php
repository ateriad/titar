<?php

namespace App\Http\Controllers\Api\V1\Events;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * @param EventCategory $category
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function show(Request $request, EventCategory $category)
    {
        $this->validate($request, [
            'per_page' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        return new JsonResponse(
            $category
                ->events()
                ->with(['attributes', 'product'])
                ->paginate($request->input('per_page', 10))
        );
    }
}
