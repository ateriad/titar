<?php


namespace App\Http\Controllers\Api\V1\Events;


use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SliderController extends Controller
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
            Event::with(['product'])
                ->orderByDesc('id')
                ->take($request->input('per_page', 12))->get()
        );
    }
}
