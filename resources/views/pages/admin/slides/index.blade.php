@extends('pages.admin._layout')

@section('title', 'اسلاید‌ها')

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
                <a href="{{ route('admin.slides.create') }}" class="btn btn-primary">افزودن اسلاید</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>عنوان</td>
                        <td>دسته بندی</td>
                        <td>آخرین بروزرسانی</td>
                        <td>گزینه‌ها</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $slide)
                        <tr>
                            <td>{{ $slide->id }}</td>
                            <td>{{ $slide->title }}</td>
                            <td>{{ $slide->category_id != 0 ? $slide->category->title : 'بدون دسته' }}</td>
                            <td>{{ jDate($slide->updated_at) }}</td>
                            <td>
                                <a href="{{ route('admin.slides.edit', $slide) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                <form class="form-inline d-inline-block" method="post"
                                      action="{{ route('admin.slides.destroy', $slide) }}">
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
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.slides.index') }}"]').addClass('active');
        });
    </script>
@endsection

