<?php

namespace App\Http\Controllers\Admin\Videos;

use App\Enums\ProductTypes;
use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use App\Models\Product;
use App\Models\Video;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class VideosController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::orderByDesc('id')
            ->where(function (Builder $video) use ($request) {
                if ($q = $request->input('q')) {
                    $video->where('title', 'like', "%$q%");
                }
                if (auth()->user()->isSuperAdmin() == false) {
                    $productIds = Product::where('author_id' , '=', auth()->id())
                        ->pluck('id')
                        ->toArray();

                    $video->whereIn('product_id', $productIds);
                }

            })
            ->paginate(10);


        return view('pages.admin.videos.index', [
            'videos' => $videos,
        ]);
    }

    public function create()
    {
        return view('pages.admin.videos.create', [
            'categories' => VideoCategory::where('parent_id', '!=', 0)->orderByDesc('id')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     * @throws ValidationException
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', 'unique:videos'],
            'category' => ['nullable', 'exists:video_categories,id'],
            'year' => ['nullable', 'integer', 'digits:4'],
            'genre' => ['nullable'],
            'publisher' => ['nullable'],
            'content' => ['required', 'max:1024'],
        ]);

        $video = DB::transaction(function () use ($request) {
            $product = new Product();
            $product->type = ProductTypes::VIDEO;
            $product->author_id = auth()->id();
            $product->save();

            $video = new Video();
            $video->product_id = $product->id;
            $video->title = $request->input('title');
            $video->content = $request->input('content');
            $video->year = $request->input('year');
            $video->genre = $request->input('genre');
            $video->publisher = $request->input('publisher');
            $video->save();

            if ($request->input('category')) {
                $video->categories()->attach($request->input('category'));
            }
            return $video;
        });
        return redirect()->route('admin.videos.edit', ['video' => $video])->with('success', trans('videos.created'));
    }

    public function edit(Video $video)
    {
        return view('pages.admin.videos.edit', [
            'video' => $video,
            'categories' => VideoCategory::where('parent_id', '!=', 0)->orderByDesc('id')->get(),
        ]);
    }

    /**
     * @param Video $video
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     * @throws ValidationException
     * @throws Throwable
     */
    public function update(Video $video, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', Rule::unique('videos')->ignore($video->id)],
            'category' => ['nullable', 'exists:video_categories,id'],
            'year' => ['nullable', 'integer', 'digits:4'],
            'genre' => ['nullable'],
            'publisher' => ['nullable'],
            'content' => ['required', 'max:1024'],
            'url' => ['required', 'url', 'starts_with:https', 'max:255'],
            'thumbnail' => ['required', 'url', 'starts_with:https', 'max:255'],
            'banner' => ['nullable', 'url', 'starts_with:https', 'max:255'],
        ]);

        $video->title = $request->input('title');
        $video->content = $request->input('content');
        $video->year = $request->input('year');
        $video->genre = $request->input('genre');
        $video->publisher = $request->input('publisher');
        $video->attribute('url', $request->input('url'));
        $video->attribute('banner', $request->input('banner'));
        $video->attribute('banner_mobile', $request->input('banner_mobile'));
        $video->attribute('thumbnail', $request->input('thumbnail'));
        $video->attribute('thumbnail_mobile', $request->input('thumbnail_mobile'));
        $video->save();

        DB::transaction(function () use ($video, $request) {
            $video->categories()->detach();

            if ($request->input('category')) {
                $video->categories()->attach($request->input('category'));
            }
        });

        return back()->with('success', trans('videos.updated'));
    }

    /**
     * @param Video $video
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Video $video)
    {
        DB::transaction(function () use ($video) {
            $video->product->delete();
            $video->delete();
        });

        return back()->with('success', trans('videos.deleted'));
    }
}
