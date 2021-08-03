<?php

namespace App\Http\Controllers\Admin\Images;

use App\Enums\ProductTypes;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ImageCategory;
use App\Models\Product;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class ImagesController extends Controller
{
    public function index(Request $request)
    {
        $images = Image::orderByDesc('id')
            ->where(function (Builder $image) use ($request) {
                if ($q = $request->input('q')) {
                    $image->where('title', 'like', "%$q%");
                }

                if (auth()->user()->isSuperAdmin() == false) {
                    $productIds = Product::where('author_id' , '=', auth()->id())
                        ->pluck('id')
                        ->toArray();

                    $image->whereIn('product_id', $productIds);
                }
            })
            ->paginate(10);


        return view('pages.admin.images.index', [
            'images' => $images,
        ]);
    }

    public function create()
    {
        return view('pages.admin.images.create', [
            'categories' => ImageCategory::where('parent_id', '!=', 0)->orderByDesc('id')->get(),
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
            'title' => ['required', 'max:255', 'unique:images'],
            'category' => ['nullable', 'exists:image_categories,id'],
            'year' => ['nullable', 'integer', 'digits:4'],
            'genre' => ['nullable'],
            'publisher' => ['nullable'],
            'content' => ['required', 'max:1024'],
        ]);

        $image = DB::transaction(function () use ($request) {
            $product = new Product();
            $product->type = ProductTypes::IMAGE;
            $product->author_id = auth()->id();
            $product->save();

            $image = new Image();
            $image->product_id = $product->id;
            $image->title = $request->input('title');
            $image->content = $request->input('content');
            $image->year = $request->input('year');
            $image->genre = $request->input('genre');
            $image->publisher = $request->input('publisher');
            $image->save();

            if ($request->input('category')) {
                $image->categories()->attach($request->input('category'));
            }
            return $image;
        });

        return redirect()->route('admin.images.edit', ['image' => $image])->with('success', trans('words.item.created'));
    }

    public function edit(Image $image)
    {
        return view('pages.admin.images.edit', [
            'image' => $image,
            'categories' => ImageCategory::where('parent_id', '!=', 0)->orderByDesc('id')->get(),
        ]);
    }

    /**
     * @param Image $image
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     * @throws ValidationException
     * @throws Throwable
     */
    public function update(Image $image, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', Rule::unique('images')->ignore($image->id)],
            'category' => ['nullable', 'exists:image_categories,id'],
            'year' => ['nullable', 'integer', 'digits:4'],
            'genre' => ['nullable'],
            'publisher' => ['nullable'],
            'content' => ['required', 'max:1024'],
            'url' => ['required', 'url', 'starts_with:https', 'max:255'],
            'thumbnail' => ['required', 'url', 'starts_with:https', 'max:255'],
            'banner' => ['nullable', 'url', 'starts_with:https', 'max:255'],
        ]);

        $image->title = $request->input('title');
        $image->content = $request->input('content');
        $image->year = $request->input('year');
        $image->genre = $request->input('genre');
        $image->publisher = $request->input('publisher');
        $image->attribute('url', $request->input('url'));
        $image->attribute('banner', $request->input('banner'));
        $image->attribute('banner_mobile', $request->input('banner_mobile'));
        $image->attribute('thumbnail', $request->input('thumbnail'));
        $image->attribute('thumbnail_mobile', $request->input('thumbnail_mobile'));
        $image->save();

        DB::transaction(function () use ($image, $request) {
            $image->categories()->detach();

            if ($request->input('category')) {
                $image->categories()->attach($request->input('category'));
            }
        });

        return back()->with('success', trans('words.item.updated'));
    }

    /**
     * @param Image $image
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Image $image)
    {
        DB::transaction(function () use ($image) {
            $image->product->delete();
            $image->delete();
        });

        return back()->with('success', trans('words.item.deleted'));
    }
}
