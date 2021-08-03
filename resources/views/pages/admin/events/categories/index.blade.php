@extends('pages.admin._layout')

@section('title', 'دسته‌بندی‌ رویدادها')

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
            <div class="form-group">
                <a href="{{ route('admin.events.categories.create') }}" class="btn btn-primary">افزودن دسته</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>عنوان</td>
                        <td>دسته والد</td>
                        <td>جایگاه نمایش در صفحه اصلی</td>
                        <td>گزینه‌ها</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->parent_id != 0 ? $category->parent != null ? $category->parent->title : '' : 'بدون والد' }}</td>
                            <td>{{$category->position != null ? $category->position : 'مشخص نشده'}}</td>
                            <td>
                                <a href="{{ route('admin.events.categories.edit', $category) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                <form class="form-inline d-inline-block" method="post"
                                      action="{{ route('admin.events.categories.destroy', $category) }}">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('پاک شود؟')"
                                            type="submit" class="btn btn-sm btn-danger">پاک‌کردن
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rtl">{{ $categories->render() }}</div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.events.categories.index') }}"]').addClass('active');
        });
    </script>
@endsection

