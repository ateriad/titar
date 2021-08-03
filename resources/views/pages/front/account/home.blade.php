@extends('pages.front.account._layout')

@section('title', 'حساب کاربری')

@section('main')
    <div class="row profile-card">
        <div class="large-12 columns">
            <section class="content content-with-sidebar">
                <div class="main-heading removeMargin">
                    <div class="row secBg padding-14 removeBorderBottom">
                        <div class="medium-8 small-8 columns">
                            <div class="head-title">
                                <h4>اطلاعات کاربری</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div class="row profile-card-content">
                                <div class="large-6 columns">
                                    <span>نام:</span>
                                    <span>{{ auth()->user()->first_name }}</span>
                                </div>
                                <div class="large-6 columns">
                                    <span>نام خانوادگی:</span>
                                    <span>{{ auth()->user()->last_name }}</span>
                                </div>
                            </div>
                            <div class="row profile-card-content">
                                <div class="large-6 columns">
                                    <span>ایمیل:</span>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <div class="large-6 columns">
                                    <span>شماره همراه:</span>
                                    <span>{{ auth()->user()->cellphone }}</span>
                                </div>
                            </div>
                            <div class="row profile-card-content">
                                <div class="large-12 columns">
                                    <a href="{{ route('account.profile') }}" class="button">ویرایش</a>
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
                            <div class="row profile-card-content">
                                <div class="large-12 columns">
                                    <a href="{{ route('account.subscriptions') }}" class="button">خرید</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
