@extends('pages.front._layout')

@section('title', 'درباره ما')

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
                                <h4>درباره ما</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div>
                                <p class="rtl">
                                    تیتار یک پلتفرم واقعیت مجازی است که به کاربران این امکان را می دهد تا از محتوای جذاب واقعیت مجازی و 360 درجه لذت ببرند و مراسم ها، کنفرانس ها و ... خود را به صورت زنده پوشش دهند و از سوی دیگر از راه دور در مسابقات ورزشی، مراسمات و کلاس های مورد علاقه خود حضور داشته باشند.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row margin-top-20 margin-bottom-20">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>تیم ما</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div class="row rtl">
                                <div class="large-3 columns">
                                    <div class="team-member">
                                        <img src="{{ asset('img/rahimi.jpg') }}" class="rounded" alt="میلاد رحیمی">
                                        <div class="member-detail">
                                            <h4>میلاد رحیمی</h4>
                                            <span>مدیر پروژه</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="large-3 columns">
                                    <div class="team-member">
                                        <img src="{{ asset('img/nouri.jpg') }}" class="rounded" alt="مهدی نوری">
                                        <div class="member-detail">
                                            <h4>مهدی نوری</h4>
                                            <span>توسعه دهنده Back End</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="large-3 columns">
                                    <div class="team-member">
                                        <img src="{{ asset('img/azizi.jpeg') }}" class="rounded" alt="محمدرضا عزیزی">
                                        <div class="member-detail">
                                            <h4>محمدرضا عزیزی</h4>
                                            <span>توسعه دهنده اندروید</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="large-3 columns">
                                    <div class="team-member">
                                        <img src="{{ asset('img/samiei.jpeg') }}" class="rounded" alt="مسعود سمیعی">
                                        <div class="member-detail">
                                            <h4>مسعود سمیعی</h4>
                                            <span>توسعه دهنده ویندوز</span>
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
