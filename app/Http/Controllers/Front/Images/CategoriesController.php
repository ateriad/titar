<?php

namespace App\Http\Controllers\Front\Images;

use App\Http\Controllers\Controller;
use App\Models\ImageCategory;
use App\Models\VideoCategory;
use App\Models\Slide;
use App\Models\Image;

class CategoriesController extends Controller
{
    public function show(int $category)
    {
        if ($category == 0) {
            $images = Image::paginate(50);
            $title = trans('words.images.all');
        } else {
            /** @var ImageCategory $categoryModel */
            $categoryModel = ImageCategory::findOrFail($category);
            $title = $categoryModel->title;
            $images = $categoryModel->images()->paginate(50);
        }

        return view('pages.front.images.list', [
            'images' => $images,
            'title' => $title,
        ]);
    }
}
