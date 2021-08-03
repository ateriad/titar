<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = EventCategory::orderBy('title')->paginate(10);

        return view('pages.admin.events.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('pages.admin.events.categories.create', [
            'root_categories' => EventCategory::whereParentId(0)
                ->orderByDesc('id')
                ->get(),
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
            'title' => ['required', 'max:255', 'unique:event_categories'],
            'description' => ['required', 'max:1024'],
            'parent_id' => ['nullable'],
            'image' => ['required_unless:parent_id, 0'],
            'position' => ['nullable', 'integer'],
        ]);

        $category = new EventCategory();
        $category->title = $request->input('title');
        $category->parent_id = $request->input('parent_id');
        $category->image = $request->input('image');
        $category->description = $request->input('description');
        $category->position = $request->input('position');
        $category->save();
        return back()->with('success', trans('categories.created'));
    }

    public function edit(EventCategory $category)
    {
        return view('pages.admin.events.categories.edit', [
            'category' => $category,
            'root_categories' => EventCategory::whereParentId(0)
                ->where('id', '!=', $category->id)
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    /**
     * @param EventCategory $category
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(EventCategory $category, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', Rule::unique('event_categories')->ignore($category->id)],
            'parent_id' => ['nullable'],
            'description' => ['required', 'max:1024'],
            'image' => ['required_unless:parent_id,0'],
            'position' => ['nullable', 'integer'],
        ]);
        $category->update($request->only(['parent_id', 'title', 'description', 'image', 'position']));

        return back()->with('success', trans('categories.updated'));
    }

    /**
     * @param int $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $category)
    {
        $category = EventCategory::whereId($category)->firstOrFail();

        $children = $category->children;
        foreach ($children as $c) {
            $c->parent_id = 0;
            $c->save();
        }

        $category->delete();

        return back()->with('success', trans('categories.deleted'));
    }
}
