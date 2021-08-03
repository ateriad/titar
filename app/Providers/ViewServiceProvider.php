<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Slide;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        View::composer('pages.front.*', function ($view) {
            $view->with('rootEventCategories', EventCategory::whereParentId(0)->orderByDesc('position')->get());
            $view->with('rootVideoCategories', VideoCategory::whereParentId(0)->orderByDesc('position')->get());
            $view->with('slides', Slide::whereCategoryId(0)->orderByDesc('id')->get());
            $view->with('eventSlides', Event::orderByDesc('id')->take(12)->get());
        });

        View::composer('pages.admin.*', function ($view) {
           $view->with('usersCount', User::count());
           $view->with('videosCount', Video::count());
           $view->with('adCount', Advertisement::count());
           $view->with('eventCount', Event::count());
        });
    }
}
