@extends('pages.front.account._layout')

@section('title', 'ویرایش پروفایل')

@section('main')
    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>ویرایش پروفایل</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content padding-bottom-20">
                            <form method="post" action="{{ route('account.profile.basics.update') }}">
                                @method('patch')
                                @csrf
                                <div class="row">
                                    <div class="large-6 columns">
                                        <div class="form-group">
                                            <label>نام:</label>
                                            <input type="text" name="first_name" value="{{ auth()->user()->first_name }}"
                                                   class="form-control" required placeholder="نام">
                                        </div>
                                    </div>
                                    <div class="large-6 columns">
                                        <div class="form-group">
                                            <label>نام خانوادگی:</label>
                                            <input type="text" name="last_name" value="{{ auth()->user()->last_name }}"
                                                   class="form-control" required placeholder="نام خانوادگی">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-12 columns">
                                        <button type="submit" class="button">ویرایش</button>
                                    </div>
                                </div>
                            </form>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>تغییر آدرس ایمیل</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content padding-bottom-20">
                            <form method="post" action="{{ route('account.profile.email.update') }}">
                                @method('patch')
                                @csrf
                                <div class="row">
                                    <div class="large-12 columns">
                                        <div class="form-group">
                                            <label>ایمیل:</label>
                                            <input type="text" name="email" value="{{ auth()->user()->email }}"
                                                   class="form-control" required placeholder="ایمیل">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-12 columns">
                                        <button type="submit" class="button">ویرایش</button>
                                    </div>
                                </div>
                            </form>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>تغییر شماره همراه</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content padding-bottom-20">
                            <form method="post" action="{{ route('account.profile.cellphone.update') }}">
                                @method('patch')
                                @csrf
                                <div class="row">
                                    <div class="large-12 columns">
                                        <div class="form-group">
                                            <label>شماره همراه:</label>
                                            <input type="text" name="cellphone" value="{{ auth()->user()->cellphone }}"
                                                   class="form-control" required placeholder="شماره همراه">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-12 columns">
                                        <button type="submit" class="button">ویرایش</button>
                                    </div>
                                </div>
                            </form>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
