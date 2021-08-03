@extends('pages.admin._layout')

@section('title', 'نقش‌ ها')

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
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">افزودن نقش‌</a>
                    <a class="btn btn-outline-info">تعداد نقش‌ ها: {{ $count }}</a>
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
                        <td>عنوان</td>
                        <td>دسترسی‌ها</td>
                        <td>گزینه‌ها</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->title }}</td>
                            <td>
                                @foreach($role->permissions() as $p)
                                    {{ trans('words.permissions.'. $p) }} |
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.roles.edit', $role) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                <form class="form-inline d-inline-block" method="post"
                                      action="{{ route('admin.roles.destroy', $role) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">پاک‌کردن</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rtl">{{ $roles->render() }}</div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.roles.index') }}"]').addClass('active');
        });
    </script>
@endsection

