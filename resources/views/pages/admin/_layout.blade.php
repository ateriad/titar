@extends('pages._html')

@section('head-links')
    @parent
    <link rel="stylesheet" href="{{ asset('css/admin/general.css') }}">
@show

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <main class="col col-md-9">
                @yield('breadcrumb')

                @include('pages._alerts')

                <div class="row rtl mar-top-20">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">تعداد کل کاربران</h5>
                                <p class="card-text">{{ $usersCount }}</p>
                            </div>
                            <div class="card-footer border-white">
                                <a class="text-white" href="{{ route('admin.users.index') }}">اطلاعات بیشتر</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">تعداد ویدئوها</h5>
                                <p class="card-text">{{ $videosCount }}</p>
                            </div>
                            <div class="card-footer border-white">
                                <a class="text-white" href="{{ route('admin.videos.index') }}">اطلاعات بیشتر</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">تعداد رویداد‌ها</h5>
                                <p class="card-text">{{ $eventCount }}</p>
                            </div>
                            <div class="card-footer border-white">
                                <a class="text-white" href="{{ route('admin.events.index') }}">اطلاعات بیشتر</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">تعداد تبلیغ‌ها</h5>
                                <p class="card-text">{{ $adCount }}</p>
                            </div>
                            <div class="card-footer border-white">
                                <a class="text-white" href="{{ route('admin.advertisements.index') }}">اطلاعات بیشتر</a>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('panel')
            </main>

            <aside class="col col-md-3">
                <div class="text-center mb-3">
                    <a href="/">
                        <img src="{{ asset('img/logo-big.png?md5=cd3d1ba45aa4724f1ed3dd2035237289') }}"
                             class="img-fluid" alt="Logo">
                    </a>
                </div>
                <div class="list-group">
                    <a class="list-group-item list-group-item-action" href="{{ route('admin.dashboard') }}">
                        <span>داشبورد</span>
                        <i class="fas fa-tachometer-alt"></i>
                    </a>
                    @can('index', \App\Models\Video::class)
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.videos.index') }}">
                            <span>ویدئو‌ها</span>
                            <i class="fas fa-photo-video"></i>
                        </a>
                    @endcan
                    @can('super-admin')
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('admin.videos.categories.index') }}">
                            <span>دسته‌بندی ویدئوها</span>
                            <i class="fas fa-sitemap"></i>
                        </a>
                    @endcan
                    @can('index', \App\Models\Advertisement::class)
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('admin.advertisements.index') }}">
                            <span>تبلیغات</span>
                            <i class="fas fa-video"></i>
                        </a>
                    @endcan
                    @can('index', \App\Models\Event::class)
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.events.index') }}">
                            <span>رویداد‌ها</span>
                            <i class="fas fa-photo-video"></i>
                        </a>
                    @endcan
                    @can('super-admin')
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('admin.events.categories.index') }}">
                            <span>دسته‌بندی رویدادها</span>
                            <i class="fas fa-sitemap"></i>
                        </a>
                    @endcan
                    @can('index', \App\Models\Image::class)
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.images.index') }}">
                            <span>تصاویر</span>
                            <i class="fas fa-images"></i>
                        </a>
                    @endcan
                    @can('super-admin')
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('admin.images.categories.index') }}">
                            <span>دسته‌بندی تصاویر</span>
                            <i class="fas fa-sitemap"></i>
                        </a>
                    @endcan
                    @can('super-admin')
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.comments.index') }}">
                            <span>دیدگاه‌ها</span>
                            <i class="fas fa-comment"></i>
                        </a>
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.slides.index') }}">
                            <span>اسلاید‌ها</span>
                            <i class="fas fa-pager"></i>
                        </a>
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.roles.index') }}">
                            <span>نقش ها</span>
                            <i class="fas fa-cog"></i>
                        </a>
                    @endcan
                    @can('index', \App\Models\User::class)
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.users.index') }}">
                            <span>کاربران</span>
                            <i class="fas fa-users"></i>
                        </a>
                    @endcan
                    @can('indexPayment')
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.payments.index') }}">
                            <span>فاکتور‌ها</span>
                            <i class="fas fa-file-invoice-dollar"></i>
                        </a>
                    @endcan
                    @can('indexReport')
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.charts.index') }}">
                            <span>گزارشات و نمودارها</span>
                            <i class="fas fa-chart-pie"></i>
                        </a>
                    @endcan
                    @can('indexLogs')
                        <a class="list-group-item list-group-item-action" href="{{ route('admin.logs.index') }}">
                            <span>مدیریت خطا و استثنا</span>
                            <i class="fas fa-file-invoice"></i>
                        </a>
                    @endcan
                    <a class="list-group-item list-group-item-action" href="{{ route('auth.sign-out') }}">
                        <span>برون‌رفت</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </aside>
        </div>
    </div>
@endsection
