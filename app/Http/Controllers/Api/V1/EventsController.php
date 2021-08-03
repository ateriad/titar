<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Jobs\Products\VisitJob;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
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
            Event::with(['product', 'attributes', 'categories'])
                ->orderByDesc('id')
                ->paginate($request->input('per_page', 10))
        );
    }

    public function show(Request $request, Event $event)
    {
        $event->load(['product', 'attributes', 'categories']);

        $this->dispatch(new VisitJob(
                $event->product_id,
                auth()->id(),
                request()->ip(),
                $request->header('source'))
        );

        return new JsonResponse($event);
    }
}
