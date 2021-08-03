@extends('pages.admin._layout')

@section('title', 'ویرایش کاربر')

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
        <form class="card-body rtl" method="post" action="{{ route('admin.users.update', $user) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>نام:</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control"
                               title="" placeholder="نام">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>نام خانوادگی:</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" title=""
                               placeholder="نام خانوادگی">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>شماره همراه:</label>
                        <input type="text" name="cellphone" value="{{ $user->cellphone }}" class="form-control ltr"
                               title="" placeholder="شماره همراه">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>ایمیل:</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control ltr" title=""
                               placeholder="ایمیل">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>چنانچه می‌خواهید گذرواژه را تغییر دهید.</label>
                        <input type="password" name="password" class="form-control" title="" placeholder="گذرواژه">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input type="password" name="password_confirmation" class="form-control" title=""
                               placeholder="بازنویسی گذرواژه">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>نقش:</label>
                        <select name="role" class="form-control" title="" required>
                            <option value="" selected>کاربر عادی</option>
                            @foreach($roles as $role)
                                <option {{ count($user->roles) && $role->id == $user->roles[0]->id ? 'selected' : '' }}
                                        value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="بروزرسانی">
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

