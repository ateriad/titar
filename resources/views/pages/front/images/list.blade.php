@extends('pages.front._layout')

@section('title', $title)

@section('head-links')
    @parent
@endsection

@section('content')
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            @include('pages.front.__top_bar')
            <div class="off-canvas-content" data-off-canvas-content>
                @include('pages.front._alerts')
                @include('pages.front.__header')
                <section id="slider">
                    <div id="full-slider-wrapper">
                        <div id="layerslider" style="width:100%;height:500px;">
                            @foreach($categorySlides as $slide)
                                <div class="ls-slide">
                                    <img src="{{ asset($slide->image) }}" class="ls-bg" alt="titar"/>
                                    <h3 class="ls-l">{{ $slide->title }}</h3>
                                    <p class="ls-l">{{ $slide->description }}</p>
                                    <a href="{{ $slide->link }}" class="ls-l button">{{ $slide->button }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="category-content margin-top-20 margin-bottom-20">
                    <div class="row">
                        <div class="large-12 columns">
                            <section class="content">
                                <div class="main-heading">
                                    <div class="row secBg padding-14 removeBorderBottom">
                                        <div class="medium-8 small-8 columns">
                                            <div class="head-title">
                                                <h4>{{ $title }}</h4>
                                            </div>
                                        </div>
                                        <div class="medium-4 small-4 columns">
                                        </div>
                                    </div>
                                </div>
                                <div class="row secBg padding-bottom-20">
                                    <div class="large-12 columns">
                                        <div class="row column head-text clearfix">
                                            <div class="pull-right large-6">
                                                <p>تعداد تصاویر : <span>{{ count($images) }}</span></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if(count($images) == 0)
                                                <div class="large-12 columns">
                                                    <div class="alert alert-dark" role="alert">تصویری بارگذاری
                                                        نشده است.
                                                    </div>
                                                </div>
                                            @else
                                                @foreach($images->chunk(4) as $chunk)
                                                    <div class="large-12 columns">
                                                        <div class="row margin-bottom-20">
                                                            @foreach($chunk as $image)
                                                                <div class="item large-3  columns">
                                                                    <div class="post thumb-border">
                                                                        <div class="post-thumb">
                                                                            <img
                                                                                src="{{ $image->attribute('thumbnail')  }}"
                                                                                alt="{{ $image->title }}">
                                                                            <a href="{{ route('images.preview', $image) }} "
                                                                               class="hover-posts">
                                                                                <span>مشاهده تصویر</span>
                                                                            </a>
                                                                            <div class="video-stats clearfix">
                                                                                <div class="thumb-stats pull-left">
                                                                                    <span>{{ $image->product->likes() }}</span>
                                                                                    <i class="fa fa-thumbs-up"></i>
                                                                                </div>
                                                                                <div class="thumb-stats pull-left">
                                                                                    <span>{{ $image->product->dislikes() }}</span>
                                                                                    <i class="fa fa-thumbs-down"></i>
                                                                                </div>
                                                                                <div class="thumb-stats pull-right">
                                                                                    <span>{{ count($image->product->comment) }}</span>
                                                                                    <i class="fa fa-comment"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="post-des">
                                                                            <h6>
                                                                                <a href="{{ route('images.preview', $image) }} ">{{ $image->title }}</a>
                                                                            </h6>
                                                                            <div class="post-stats clearfix">
                                                                                <p class="pull-right">
                                                                                    <i class="fa fa-clock"></i>
                                                                                    <span>{{ jDate($image->created_at) }}</span>
                                                                                </p>
                                                                                <p class="pull-right">
                                                                                    <i class="fa fa-eye"></i>
                                                                                    <span>{{ count($image->product->visits) }}</span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="row">
                                            <nav class="col text-center pt-2">{{ $images->render() }}</nav>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
                @include('pages.front.__footer')
            </div>
        </div>
    </div>
@endsection

