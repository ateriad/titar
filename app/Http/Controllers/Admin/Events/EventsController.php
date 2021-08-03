<?php

namespace App\Http\Controllers\Admin\Events;

use App\Enums\ProductTypes;
use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use App\Models\Product;
use App\Models\Event;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::orderByDesc('id')
            ->where(function (Builder $event) use ($request) {
                if ($q = $request->input('q')) {
                    $event->where('title', 'like', "%$q%");
                }

                if (auth()->user()->isSuperAdmin() == false) {
                    $productIds = Product::where('author_id' , '=', auth()->id())
                        ->pluck('id')
                        ->toArray();

                    $event->whereIn('product_id', $productIds);
                }
            })
            ->paginate(10);


        return view('pages.admin.events.index', [
            'events' => $events,
        ]);
    }

    public function create()
    {
        return view('pages.admin.events.create', [
            'categories' => EventCategory::where('parent_id', '!=', 0)
                ->orderByDesc('id')
                ->get(),
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
            'title' => ['required', 'max:255', 'unique:events'],
            'category' => ['nullable', 'exists:event_categories,id'],
            'publisher' => ['nullable'],
            'content' => ['required', 'max:1024'],
        ]);

        $event = DB::transaction(function () use ($request) {
            $product = new Product();
            $product->type = ProductTypes::EVENT;
            $product->author_id = auth()->id();
            $product->save();

            $event = new Event();
            $event->product_id = $product->id;
            $event->author_id = auth()->id();
            $event->title = $request->input('title');
            $event->content = $request->input('content');
            $event->publisher = $request->input('publisher');
            $event->save();

            $event->attribute('url', $request->input('url'));
            $event->attribute('banner', $request->input('banner'));
            $event->attribute('banner_mobile', $request->input('banner_mobile'));
            $event->attribute('thumbnail', $request->input('thumbnail'));
            $event->attribute('thumbnail_mobile', $request->input('thumbnail_mobile'));

            if ($request->input('category')) {
                $event->categories()->attach($request->input('category'));
            }

            return $event;
        });
        return redirect()->route('admin.events.edit', ['event' => $event])->with('success', trans('words.item.created'));
    }

    public function edit(Event $event)
    {
        return view('pages.admin.events.edit', [
            'event' => $event,
            'categories' => EventCategory::where('parent_id', '!=', 0)
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    /**
     * @param Event $event
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     * @throws ValidationException
     * @throws Throwable
     */
    public function update(Event $event, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', Rule::unique('events')->ignore($event->id)],
            'category' => ['nullable', 'exists:event_categories,id'],
            'publisher' => ['nullable'],
            'content' => ['required', 'max:1024'],
            'url' => ['required', 'url', 'starts_with:https', 'max:255'],
            'thumbnail' => ['required', 'url', 'starts_with:https', 'max:255'],
            'banner' => ['nullable', 'url', 'starts_with:https', 'max:255'],
        ]);

        $event->title = $request->input('title');
        $event->content = $request->input('content');
        $event->publisher = $request->input('publisher');
        $event->attribute('url', $request->input('url'));
        $event->attribute('banner', $request->input('banner'));
        $event->attribute('banner_mobile', $request->input('banner_mobile'));
        $event->attribute('thumbnail', $request->input('thumbnail'));
        $event->attribute('thumbnail_mobile', $request->input('thumbnail_mobile'));
        $event->save();

        DB::transaction(function () use ($event, $request) {
            $event->categories()->detach();

            if ($request->input('category')) {
                $event->categories()->attach($request->input('category'));
            }
        });

        return back()->with('success', trans('words.item.updated'));
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Event $event)
    {
        DB::transaction(function () use ($event) {
            $event->product->delete();
            $event->delete();
        });

        return back()->with('success', trans('words.item.deleted'));
    }
}
