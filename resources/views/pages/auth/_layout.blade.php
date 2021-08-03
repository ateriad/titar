@extends('pages._html')

@section('head-links')
    @parent
    <link rel="stylesheet" href="{{ asset('css/auth/general.css') }}">
@show

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col offset-md-4 col-md-4 text-center">
                <a href="/" class="d-block my-3">
                    <img src="{{ asset('img/logo-big.png?md5=logo-big.png') }}" class="img-fluid" alt="Logo">
                </a>

                @if(session('error'))
                    <div class="alert alert-danger rtl">{{ session('error') }}</div>
                @endif

                @yield('main')
            </div>
        </div>
    </div>
@endsection
