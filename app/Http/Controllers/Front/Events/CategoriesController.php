<?php

namespace App\Http\Controllers\Front\Events;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use App\Models\Slide;
use App\Models\Event;

class CategoriesController extends Controller
{
    public function show(int $category)
    {
        if ($category == 0) {
            $events = Event::paginate(50);
            $title = trans('words.events.all');
        } else {
            /** @var EventCategory $categoryModel */
            $categoryModel = EventCategory::findOrFail($category);
            $title = $categoryModel->title;
            $events = $categoryModel->events()->paginate(50);
        }

        $slides = Slide::whereCategoryId($category)->orderBy('id' , 'desc')->get();
        $slides->count() == 0 ? $slides = Slide::whereCategoryId(0)
            ->orderBy('id' , 'desc')->get() : true ;

        return view('pages.front.events.list', [
            'slides' => $slides,
            'events' => $events,
            'title' => $title,
        ]);
    }
}
