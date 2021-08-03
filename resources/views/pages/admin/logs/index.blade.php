@extends('pages.admin._layout')

@section('title', 'مدیریت خطا و استثنا')

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
            <div class="logs-box">
                @foreach($logs as $log)
                    <div class="line-text">
                        {{$log}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

