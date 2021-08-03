@extends('pages._html')

@section('head-links')
    @parent
    <link rel="stylesheet" href="{{ m(asset('css/front/app.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/theme.css')) }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ m(asset('css/front/responsive.css')) }}">
    <link rel="stylesheet" href="{{ m(asset('css/front/custom.css')) }}">
@endsection
@section('content')
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            @include('pages.front.__top_bar')
            <div class="off-canvas-content" data-off-canvas-content>
                @include('pages.front.__header')
                <div class="row margin-top-20 margin-bottom-20">
                    <div class="large-3 columns">
                        <section class="content content-with-sidebar">
                            <div class="main-heading removeMargin">
                                <div class="row secBg padding-14 removeBorderBottom">
                                    <div class="medium-8 small-8 columns">
                                        <div class="head-title">
                                            <h4>پروفایل</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row secBg">
                                <div class="profile-sidebar">
                                    <a class="{{ $tab == 'home' ? 'active btn-green' : 'text-green' }}"
                                       href="{{ route('account.home') }}">حساب کاربری</a>
                                    <a class="{{ $tab == 'wallet' ? 'active btn-green' : 'text-green'  }}"
                                       href="{{ route('account.wallet') }}">افزایش اعتبار</a>
                                    <a class="{{ $tab == 'subscription' ? 'active btn-green' : 'text-green'  }}"
                                       href="{{ route('account.subscriptions') }}">خرید اشتراک</a>
                                    <a class="{{ $tab == 'profile' ? 'active btn-green' : 'text-green'  }}"
                                       href="{{ route('account.profile') }}">ویرایش پروفایل</a>
                                    <a href="{{ route('auth.sign-out') }}">بیرون رفتن</a>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="large-9 columns">
                        @include('pages.front._alerts')
                        @yield('main')
                    </div>
                </div>
                @include('pages.front.__footer')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('vendor/slick-1.8.1/slick.min.js?v1') }}"></script>
    <script src="{{ m(asset('js/menu.js')) }}"></script>

    <!-- script files -->
    <script src="{{ m(asset('vendor/jquery.js')) }}"></script>
    <script src="{{ m(asset('vendor/what-input.js')) }}"></script>
    <script src="{{ m(asset('vendor/foundation.js')) }}"></script>
    <script src="{{ m(asset('vendor/jquery.showmore.src.js')) }}"></script>
    <script src="{{ m(asset('js/app.js')) }}"></script>
    <!-- LayerSlider script files -->
    <script src="{{ m(asset('js/inewsticker.js')) }}" type="text/javascript"></script>
    <script src="{{ m(asset('js/jquery.kyco.easyshare.js')) }}" type="text/javascript"></script>
@endsection
