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
                                <h4>فاکتور افزایش اعتبار</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content padding-bottom-20">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>اعتبار درخواستی به ریال</th>
                                        <td>{{ number_format(request('amount') . '0') }}</td>
                                    </tr>
                                    <tr>
                                        <th>اعتبار درخواستی به تومان</th>
                                        <td>{{ number_format(request('amount')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>درگاه پرداخت</th>
                                        <td>فن‌آوا کارت</td>
                                    </tr>
                                </table>
                            </div>
                            <form method="post" action="{{ $gatewayUrl }}">
                                <input type="hidden" name="Amount" value="{{ $amount }}">
                                <input type="hidden" name="ResNum" value="{{ $resNum }}">
                                <input type="hidden" name="MID" value="{{ $mid }}">
                                <input type="hidden" name="redirectURL" value="{{ route('account.wallet.callback.fcp') }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <input type="hidden" name="mobileNo" value="{{ auth()->user()->cellphone }}">
                                <input type="hidden" name="userId" value="{{ auth()->user()->cellphone }}">
                                <input type="submit" class="button" value="پرداخت">
                                <a href="{{ route('account.wallet') }}" class="button">برگشت</a>
                            </form>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
