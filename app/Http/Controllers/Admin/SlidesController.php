<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\VideoCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SlidesController extends Controller
{
    public function index()
    {
        return view('pages.admin.slides.index', [
            'slides' => Slide::all(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.slides.create', [
            'categories' => VideoCategory::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'button' => ['required', 'max:16'],
            'category_id' => ['nullable', 'exists:video_categories,id'],
            'image' => ['required', 'url'],
            'link' => ['required', 'url'],
            'description' => ['required', 'max:1024'],
        ]);

        $slide = new Slide();
        $slide->title = $request->input('title');
        $slide->button = $request->input('button');
        $slide->category_id = $request->input('category_id') ?: 0;
        $slide->image = $request->input('image');
        $slide->image_mobile = $request->input('image_mobile');
        $slide->link = $request->input('link');
        $slide->description = $request->input('description');
        $slide->product_type = 1;
        $slide->save();

        return back()->with('success', trans('slides.created'));
    }

    public function edit(Slide $slide)
    {
        return view('pages.admin.slides.edit', [
            'slide' => $slide,
            'categories' => VideoCategory::all(),
        ]);
    }

    /**
     * @param Slide $slide
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Slide $slide, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'button' => ['required', 'max:16'],
            'category_id' => ['nullable', 'exists:video_categories,id'],
            'image' => ['required', 'url'],
            'link' => ['required', 'url'],
            'description' => ['required', 'max:1024'],
        ]);

        $attributes = $request->only([
            'title',
            'button',
            'category_id',
            'image',
            'image_mobile',
            'link',
            'description',
        ]);

        $attributes['category_id'] = $attributes['category_id'] ?? 0;

        $slide->update($attributes);

        return back()->with('success', trans('slides.updated'));
    }

    /**
     * @param int $slide
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $slide)
    {
        Slide::whereId($slide)->delete();

        return back()->with('success', trans('slides.deleted'));
    }
}
