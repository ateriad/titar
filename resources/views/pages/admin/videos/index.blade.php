@extends('pages.admin._layout')

@section('title', 'ویدئو‌ها')

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
                        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">افزودن ویدئو</a>
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
                    @foreach($videos as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>
                                <a href="{{ route('videos.preview' , $video) }}" target="_blank">
                                    {{ $video->title }}
                                </a>
                            </td>
                            <td>
                                <ul class="mb-0 p-0">
                                    @foreach($video->categories as $category)
                                        <li>
                                            <a href="{{ route('videos.categories.show' , $category->id) }}"
                                               target="_blank">
                                                {{ $category->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $video->year}}</td>
                            <td>{{ $video->genre }}</td>
                            <td>{{ $video->publisher }}</td>
                            <td>{{ jDate($video->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin.videos.edit', $video) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                <form class="form-inline d-inline-block" method="post"
                                      action="{{ route('admin.videos.destroy', $video) }}">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('پاک شود؟')" type="submit"
                                            class="btn btn-sm btn-danger">پاک‌کردن
                                    </button>
                                </form>
                                <form class="form-inline d-inline-block" method="get"
                                      action="{{ route('admin.charts.videos.visits') }}">
                                    <input name="video_id" hidden value="{{ $video->id }}"/>
                                    <button type="submit" class="btn btn-sm btn-success">بازدید</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rtl">{{ $videos->render() }}</div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.videos.index') }}"]').addClass('active');
        });
    </script>
@endsection

