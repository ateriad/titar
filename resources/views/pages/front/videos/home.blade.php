@extends('pages.front._layout')

@section('title', 'پلتفرم واقعیت مجازی')

@section('head-links')
    @parent
@endsection

@section('main')
    <section id="premium">
        <div class="row">
            <div class="heading clearfix">
                <div class="large-2 columns">
                    <div class="navText show-for-large">
                        <a class="next secondary-button"><i class="fa fa-angle-right"></i></a>
                        <a class="prev secondary-button"><i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="large-10 columns">
                    <h4>رویداد‌ها</h4>
                </div>
            </div>
        </div>
        <div id="owl-demo" class="owl-carousel carousel" data-car-length="3" data-items="3" data-loop="true"
             data-nav="false" data-autoplay="true" data-autoplay-timeout="3000" data-dots="false"
             data-auto-width="false" data-responsive-small="1" data-responsive-medium="2" data-responsive-xlarge="5">
            @foreach($eventSlides as $event)
                <div class="item">
                    <figure class="premium-img">
                        <img src="{{ $event->attribute('thumbnail')  }}" alt="{{ $event->title }}">
                        <figcaption>
                            <h5>{{ $event->title }}</h5>
                        </figcaption>
                    </figure>
                    <a href="{{ route('events.preview', $event) }} " class="hover-posts">
                        <span>مشاهده رویداد</span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    @foreach($rootVideoCategories as $category)
        <section id="category">
            <div class="row secBg">
                <div class="large-12 columns">
                    <div class="column row">
                        <div class="heading category-heading clearfix">
                            <div class="cat-head pull-right">
                                <h4>{{ $category->title }}</h4>
                            </div>
                            <div class="cat-head pull-left">
                                @if($category->children()->count() != 0)
                                    <a href="{{ route('videos.categories.show', $category->id) }}" class=" radius">مشاهده همه</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="owl-demo-cat" class="row owl-carousel carousel" data-car-length="6" data-items="6"
                         data-loop="true" data-nav="false" data-autoplay="true" data-autoplay-timeout="4000"
                         data-auto-width="true" data-margin="10" data-dots="false">
                        @if($category->children()->count() == 0)
                            <div class="large-12 columns">
                                <div class="alert alert-dark" role="alert">کانالی در این بخش بارگذاری نشده است.</div>
                            </div>
                        @else
                            @foreach($category->children()->orderByDesc('id')->limit(6)->get() as $c)
                                <div class="item-cat item thumb-border">
                                    <figure class="premium-img">
                                        <img src="{{ $c->image  }}" alt="{{ $c->title  }}">
                                        <a href="{{ route('videos.categories.show', $c->id) }}" class="hover-posts">
                                            <span><i class="fa fa-search"></i></span>
                                        </a>
                                    </figure>
                                    <h6><a href="{{ route('videos.categories.show', $c->id) }}">{{ $c->title }}</a></h6>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
