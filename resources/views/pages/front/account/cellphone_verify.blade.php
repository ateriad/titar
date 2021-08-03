@extends('pages.front.account._layout')

@section('title', 'ویرایش شماره همراه')

@section('main')
    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>ویرایش شماره همراه</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content padding-bottom-20">
                            <form method="post" action="{{ route('account.profile.cellphone.verify.submit') }}">
                                @method('patch')
                                @csrf
                                <div class="row">
                                    <div class="large-6 columns">
                                        <span>شماره همراه وارد شده: </span>
                                        {{ $cellphone }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <div class="form-group">
                                            <input type="text" name="token" class="form-control" required placeholder="کد دریافتی">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
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
