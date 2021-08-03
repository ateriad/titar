<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\AdvertisementStatuses;
use App\Enums\Clients;
use App\Http\Controllers\Controller;
use App\Jobs\Advertisement\AdVisitJob;
use App\Jobs\Products\VisitJob;
use App\Models\Advertisement;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VideosController extends Controller
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
            Video::with(['product', 'attributes', 'categories'])
                ->orderByDesc('id')
                ->paginate($request->input('per_page', 10))
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'search' => ['required']
        ]);

        $q = $request->input('search');

        return new JsonResponse(
            Video::with(['product', 'attributes', 'categories'])
                ->where('title', 'like', "%$q%")
                ->orderByDesc('id')
                ->paginate($request->input('per_page', 10))
        );
    }

    public function show(Request $request, Video $video)
    {
        $video->load(['product', 'attributes', 'categories']);

        $this->dispatch(new VisitJob(
            $video->product_id,
            auth()->id(),
            request()->ip(),
            $request->header('source'))
        );

        $advertisement = Advertisement::whereStatus(AdvertisementStatuses::ENABLE)->inRandomOrder()->first();
        if ($advertisement !== null) {
            $this->dispatch(new AdVisitJob(
                $video->product_id,
                $advertisement->id,
                auth()->id(),
                request()->ip(),
                $request->header('source'))
            );
        }

        return new JsonResponse([
            'video' => $video,
            'advertisement' => $advertisement
        ]);
    }
}
