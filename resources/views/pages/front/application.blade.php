@extends('pages.front._layout')

@section('title', 'اپلیکیشن ها')

@section('head-links')
    @parent
@endsection

@section('main')

    <div class="row margin-top-20 margin-bottom-20">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>اپلیکیشن ها</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div>
                                <p class="rtl">
                                    اگر شما هم علاقمند به تجربه واقعیت مجازی در عینک های Vr هستید کافی است که یکی از نرم افزارهای ما را
                                    نصب کنید.
                                </p>
                                <div class="row margin-bottom-20">
                                    <div class="large-2 columns">
                                        <div>
                                            <img class="app-img" src="{{asset('img/android.png')}}" alt="android">
                                        </div>
                                    </div>
                                    <div class="large-2 columns">
                                        <div>
                                            <img class="app-img" src="{{asset('img/windows.png')}}" alt="windows">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
