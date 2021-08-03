@extends('pages.front.account._layout')

@section('title', 'خرید اشتراک')

@section('main')
    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>اشتراک</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            @if(count(auth()->user()->subscriptions) > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>آغاز</th>
                                            <th>پایان</th>
                                            <th>مبلغ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(auth()->user()->subscriptions as $s)
                                            <tr>
                                                <td>{{ $s->start_j }}</td>
                                                <td>{{ $s->end_j }}</td>
                                                <td>{{ $s->price }} <span>تومان</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    شما هیچ اشتراک فعالی ندارید.
                                </div>
                            @endif
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
                                <h4>خرید اشتراک</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div class="row">
                                <div class="large-4 columns">
                                    <div class="d-block alert alert-info text-center pt-4">
                                        <h4 class="text-center">
                                            <span>{{ config('subscriptions.plans.0.month') }}</span>
                                            <span>ماهه</span>
                                        </h4>
                                        <p>
                                            <span>{{ number_format(config('subscriptions.plans.0.price')) }}</span>
                                            <span>تومان</span>
                                        </p>
                                        <form class="form-group" method="post" action="{{ route('account.subscriptions.purchase') }}">
                                            @csrf
                                            <input type="hidden" name="plan" value="0">
                                            <button type="submit" class="btn btn-info">خرید</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="large-4 columns">
                                    <div class="d-block alert alert-success text-center pt-4">
                                        <h4 class="text-center">
                                            <span>{{ config('subscriptions.plans.1.month') }}</span>
                                            <span>ماهه</span>
                                        </h4>
                                        <p>
                                            <span>{{ number_format(config('subscriptions.plans.1.price')) }}</span>
                                            <span>تومان</span>
                                        </p>
                                        <form class="form-group" method="post" action="{{ route('account.subscriptions.purchase') }}">
                                            @csrf
                                            <input type="hidden" name="plan" value="1">
                                            <button type="submit" class="btn btn-success">خرید</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="large-4 columns">
                                    <div class="d-block alert alert-primary text-center pt-4">
                                        <h4 class="text-center">
                                            <span>{{ config('subscriptions.plans.2.month') }}</span>
                                            <span>ماهه</span>
                                        </h4>
                                        <p>
                                            <span>{{ number_format(config('subscriptions.plans.2.price')) }}</span>
                                            <span>تومان</span>
                                        </p>
                                        <form class="form-group" method="post" action="{{ route('account.subscriptions.purchase') }}">
                                            @csrf
                                            <input type="hidden" name="plan" value="2">
                                            <button type="submit" class="btn btn-primary">خرید</button>
                                        </form>
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
                                <h4>اعتبار</h4>
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
                            <div class="row profile-card-content">
                                <div class="large-12 columns">
                                    <a href="{{ route('account.wallet') }}" class="button">افزایش</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
