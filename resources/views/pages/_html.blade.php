<!doctype html>
<html lang="en">
<head>
    @section('head-meta')
        <meta charset="utf-8">
        <meta name="enamad" content="857593"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @show
    @section('head-links')
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4.4.1/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-5.12.0/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ m(asset('css/general.css')) }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    @show
    <title>@yield('title') - {{ trans(config('app.name')) }}</title>
    @yield('head-rest')
</head>
<body>

@yield('content')

<!-- Scripts -->
@section('scripts')
    <script src="{{ asset('vendor/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/fontawesome-5.12.0/js/all.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@show

</body>
</html>
