<?php

namespace App\Http\Controllers\Admin\Images;

use App\Http\Controllers\Controller;
use App\Models\ImageCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = ImageCategory::orderBy('title')->paginate(10);

        return view('pages.admin.images.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('pages.admin.images.categories.create', [
            'root_categories' => ImageCategory::whereParentId(0)
                ->orderByDesc('id')
                ->get() ,
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
            'title' => ['required', 'max:255', 'unique:video_categories'],
            'description' => ['required', 'max:1024'],
            'parent_id' => ['nullable'],
            'image' => ['required_unless:parent_id, 0'],
            'position' => ['nullable', 'integer'],
        ]);

        $category = new ImageCategory();
        $category->title = $request->input('title');
        $category->parent_id = $request->input('parent_id');
        $category->image = $request->input('image');
        $category->description = $request->input('description');
        $category->position = $request->input('position');
        $category->save();
        return back()->with('success', trans('categories.created'));
    }

    public function edit(ImageCategory $category)
    {
        return view('pages.admin.images.categories.edit', [
            'category' => $category,
            'root_categories' => ImageCategory::whereParentId(0)
                ->where('id' , '!=' , $category->id)
                ->orderByDesc('id')
                ->get() ,
            ]);
    }

    /**
     * @param ImageCategory $category
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(ImageCategory $category, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', Rule::unique('image_categories')->ignore($category->id)],
            'parent_id' => ['nullable'],
            'description' => ['required', 'max:1024'],
            'image' => ['required_unless:parent_id,0'],
            'position' => ['nullable', 'integer'],
        ]);
        $category->update($request->only(['parent_id', 'title', 'description' ,'image' , 'position']));

        return back()->with('success', trans('categories.updated'));
    }

    /**
     * @param int $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $category)
    {
        ImageCategory::whereId($category)->delete();

        return back()->with('success', trans('categories.deleted'));
    }
}
