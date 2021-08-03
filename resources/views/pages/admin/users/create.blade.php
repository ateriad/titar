@extends('pages.admin._layout')

@section('title', 'افزودن کاربر')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control"
                               title="" placeholder="نام">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" title=""
                               placeholder="نام خانوادگی">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="text" name="cellphone" value="{{ old('cellphone') }}" class="form-control ltr"
                               title="" placeholder="شماره همراه" required>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control ltr" title=""
                               placeholder="ایمیل">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" title="" placeholder="گذرواژه">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" title=""
                               placeholder="بازنویسی گذرواژه">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <select name="role" class="form-control" title="">
                            <option value="" selected>کاربر عادی</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="افزودن">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.users.index') }}"]').addClass('active');
        });
    </script>
@endsection

