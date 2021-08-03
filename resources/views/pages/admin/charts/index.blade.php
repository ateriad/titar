@extends('pages.admin._layout')

@section('title', 'گزارشات و نمودارها')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <div class="card-body rtl">
            <ul>
                <li><a href="{{ route('admin.charts.videos.visits') }}">نمودار بازدید ویدئو‌ها</a></li>
                <li><a href="{{ route('admin.charts.events.visits') }}">نمودار بازدید رویداد‌ها</a></li>
                <li><a href="{{ route('admin.charts.source') }}">نمودار تنوع استفاده بر اساس دستگاه</a></li>
                <li><a href="{{ route('admin.charts.users.sign-up') }}">نمودار ثبت نام کاربران جدید</a></li>
                <li><a href="{{ route('admin.charts.users.sign-in') }}">نمودار ورود کاربران</a></li>
                <li><a href="{{ route('admin.reports.videos.popular') }}">لیست ویدئو ها به ترتیب محبوبیت</a></li>
            </ul>
        </div>
    </div>
@endsection
