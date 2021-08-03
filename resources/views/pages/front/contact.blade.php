@extends('pages.front._layout')

@section('title', 'تماس با ما')

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
                                <h4>تماس با ما</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row secBg">
                    <div class="large-12 columns">
                        <article class="page-content">
                            <div class="row rtl">
                                <div class="col-md-6">
                                    <div>
                                        <span>نشانی : میدان ونک، خیابان ونک، پلاک 24</span><br/><br/>
                                        <span>شماره تماس : 02188653250</span><br/><br/>
                                        <span>پست الکترونیک : info[at]titar[dot]ir</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <form class="rtl" method="post" action="{{ route('contact.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" title="نام" required
                                                           placeholder="نام" value="{{ auth()->check() ? auth()->user()->fullname() : ''}}">
                                                </div>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control" title="Email" required
                                                           placeholder="Email" value="{{auth()->check() ? auth()->user()->email : ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                        <textarea class="form-control rtl" name="content" placeholder="پیام شما" style="height: 150px;"
                                  title="پیام شما" required>{{ old('content') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="submit" class="button" value="ارسال پیام">
                                                </div>
                                            </div>
                                        </div>
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
