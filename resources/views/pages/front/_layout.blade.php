@extends('pages._html')

@section('head-links')
    @parent

    <link rel="stylesheet" href="{{ m(asset('css/front/app.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/theme.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/font-awesome.min.css')) }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ m(asset('layerslider/css/layerslider.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/owl.carousel.min.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/owl.theme.default.min.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/jquery.kyco.easyshare.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/responsive.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/custom.css')) }}">
@endsection
@section('content')
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            @include('pages.front.__top_bar')
            <div class="off-canvas-content" data-off-canvas-content>
                @include('pages.front._alerts')
                @include('pages.front.__header')
                @include('pages.front.__slider')
                @yield('main')
                @include('pages.front.__footer')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('vendor/slick-1.8.1/slick.min.js?v1') }}"></script>
    <script src="{{ m(asset('js/slider.js')) }}"></script>
    <script src="{{ m(asset('js/menu.js')) }}"></script>

    <!-- script files -->
    <script src="{{ m(asset('vendor/jquery.js')) }}"></script>
    <script src="{{ m(asset('vendor/what-input.js')) }}"></script>
    <script src="{{ m(asset('vendor/foundation.js')) }}"></script>
    <script src="{{ m(asset('vendor/jquery.showmore.src.js')) }}"></script>
    <script src="{{ m(asset('js/app.js')) }}"></script>
    <script src="{{ m(asset('layerslider/js/greensock.js')) }}"></script>
    <!-- LayerSlider script files -->
    <script src="{{ m(asset('layerslider/js/layerslider.transitions.js')) }}" type="text/javascript"></script>
    <script src="{{ m(asset('layerslider/js/layerslider.kreaturamedia.jquery.js')) }}" type="text/javascript"></script>
    <script src="{{ m(asset('js/owl.carousel.min.js')) }}"></script>
    <script src="{{ m(asset('js/inewsticker.js')) }}" type="text/javascript"></script>
    <script src="{{ m(asset('js/jquery.kyco.easyshare.js')) }}" type="text/javascript"></script>
@endsection
