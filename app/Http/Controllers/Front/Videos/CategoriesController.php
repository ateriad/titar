<?php

namespace App\Http\Controllers\Front\Videos;

use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use App\Models\Slide;
use App\Models\Video;

class CategoriesController extends Controller
{
    public function show(int $category)
    {
        if ($category == 0) {
            $videos = Video::orderByDesc('id')->paginate(52);
            $title = trans('videos.all');
        } else {
            /** @var VideoCategory $categoryModel */
            $categoryModel = VideoCategory::findOrFail($category);
            $title = $categoryModel->title;
            $videos = $categoryModel->videos()->orderByDesc('id')->paginate(52);
        }

        $categorySlides = Slide::whereCategoryId($category)->orderBy('id' , 'desc')->get();
        $categorySlides->count() == 0 ? $categorySlides = Slide::whereCategoryId(0)
            ->orderBy('id' , 'desc')->get() : true ;

        return view('pages.front.videos.list', [
            'categorySlides' => $categorySlides,
            'videos' => $videos,
            'title' => $title,
        ]);
    }
}
