@extends('pages.front.account._layout')

@section('title', 'افزایش اعتبار')

@section('main')
    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>وضعیت اعتبار</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div class="row profile-card-content">
                                <div class="large-12 columns">
                                    <div class="balance">
                                        <span>{{ auth()->user()->balance }}</span>
                                        <span>تومان</span>
                                    </div>
                                </div>
                            </div>
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
                                <h4>افزایش اعتبار</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div class="row profile-card-content">
                                <div class="large-12 columns">
                                    <form class="ltr text-center" action="{{ route('account.wallet.invoice.fcp') }}">
                                        <div class="input-group mb-3">
                                            <div class="row">
                                                <div class="large-3 columns"></div>
                                                <div class="large-4 columns">
                                                    <input name="amount" type="number" class="form-control" placeholder="مقدار" dir="rtl"
                                                           title="" value="{{ old('amount', 20000) }}" step="100" min="100" max="1000000">
                                                </div>
                                                <div class="large-2 columns">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="button">افزایش</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
