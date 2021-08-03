@extends('pages.admin._layout')

@section('title', 'تصاویر')

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
                <div class="col col-md-2">
                    <div class="form-group">
                        <a href="{{ route('admin.images.create') }}" class="btn btn-primary">افزودن تصویر</a>
                    </div>
                </div>
                <div class="col col-md-10">
                    <form class="form-group">
                        <input class="form-control" name="q" title="Search" value="{{ request('q') }}"
                               placeholder="جستجو">
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>عنوان</td>
                        <td>دسته</td>
                        <td>سال ساخت</td>
                        <td>ژانر</td>
                        <td>ناشر</td>
                        <td>زمان نشر</td>
                        <td>گزینه‌ها</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images as $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td>
                                <a href="{{ route('images.preview' , $image) }}" target="_blank">
                                    {{ $image->title }}
                                </a>
                            </td>
                            <td>
                                <ul class="mb-0 p-0">
                                    @foreach($image->categories as $category)
                                        <li>
                                            <a href="{{ route('images.categories.show' , $category->id) }}"
                                               target="_blank">
                                                {{ $category->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $image->year}}</td>
                            <td>{{ $image->genre }}</td>
                            <td>{{ $image->publisher }}</td>
                            <td>{{ jDate($image->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin.images.edit', $image) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                <form class="form-inline d-inline-block" method="post"
                                      action="{{ route('admin.images.destroy', $image) }}">
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
            <div class="rtl">{{ $images->render() }}</div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.images.index') }}"]').addClass('active');
        });
    </script>
@endsection

