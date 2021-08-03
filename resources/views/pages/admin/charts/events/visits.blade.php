@extends('pages.admin._layout')

@section('title', 'نمودار بازدید رویداد')

@section('head-links')
    @parent
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/persian-datepicker/persian-datepicker.min.css') }}">
@endsection

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.charts.index') }}">نمودار‌ها</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <div class="card-body">
            <form class="row rtl" method="get">
                <div class="col-md-3">
                    <label for="video_id">رویداد:</label>
                    <input type="number" name="event_id" id="event_id" class="form-control" value="{{ $eventId }}"
                           placeholder="همه">
                </div>
                <div class="col-md-3">
                    <label for="from">تاریخ شروع:</label>
                    <input type="text" id="from" class="form-control" value="{{ jDate($from, 'yyyy-MM-dd', false) }}">
                    <input type="hidden" name="from" class="form-control" value="{{ $from->getTimestamp() }}000">
                </div>
                <div class="col-md-3">
                    <label for="to">تاریخ پایان:</label>
                    <input type="text" id="to" class="form-control" value="{{ jDate($to, 'yyyy-MM-dd', false) }}">
                    <input type="hidden" name="to" class="form-control" value="{{ $to->getTimestamp() }}000">
                </div>
                <div class="col-md-3">
                    <label>گزینه‌ها:</label><br>
                    <input type="submit" class="btn btn-primary" value="اعمال">
                </div>
            </form>
            @include('pages.admin.charts._linier_chart' , ['title' =>  'نمودار بازدید رویداد'])
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('vendor/persian-datepicker/persian-date.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/persian-datepicker/persian-datepicker.min.js') }}"></script>
@endsection
