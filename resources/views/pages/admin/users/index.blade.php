@extends('pages.admin._layout')

@section('title', 'کاربران')

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
            <div class="row">
                <div class="form-group">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">افزودن کاربر</a>
                    <a class="btn btn-outline-info">تعداد کاربران: {{ $count }}</a>
                </div>
            </div>
            <div class="row">
                <span></span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>نام</td>
                        <td>نام خانوادگی</td>
                        <td>ایمیل</td>
                        <td>شماره</td>
                        <td>نقش</td>
                        <td>زمان نام‌نویسی</td>
                        <td>گزینه‌ها</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->cellphone }}</td>
                            <td>
                                <ul class="mb-0 p-0">
                                    @foreach($user->roles as $role)
                                        <li>{{ $role->title }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ jDate($user->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                @if($user->id != auth()->id())
                                    <form class="form-inline d-inline-block" method="post"
                                          action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('پاک شود؟')"
                                                type="submit" class="btn btn-sm btn-danger">پاک‌کردن
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rtl">{{ $users->render() }}</div>
        </div>
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

