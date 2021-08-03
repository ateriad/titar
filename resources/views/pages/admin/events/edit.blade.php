@extends('pages.admin._layout')

@section('head-meta')
    @parent
    <meta name="upload" content="{{ route('admin.uploads.index') }}">
    <meta name="loading" content="{{ asset('img/loading.gif') }}">
@show

@section('title', 'ویرایش رویداد')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">رویداد‌ها</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.events.update', $event) }}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>عنوان:</label>
                        <input type="text" name="title" class="form-control" title="عنوان" required
                               placeholder="عنوان" value="{{ $event->title }}">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>دسته:</label>
                        <select name="category" class="form-control" title="دسته">
                            @foreach($categories as $category)
                                <option
                                    @if(count($event->categories) && $event->categories[0]->id == $category->id)
                                    {{ 'selected' }}
                                    @endif
                                    value="{{ $category->id }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach
                            <option value="" {{ count($event->categories) == 0 ? 'selected' : '' }}>بدون دسته</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <label>ناشر:</label>
                    <div class="form-group">
                        <input type="text" name="publisher" class="form-control" title="ناشر" placeholder="ناشر" value="{{ $event->publisher }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>محتوا:</label>
                        <textarea class="form-control rtl" name="content" placeholder="محتوا" style="height: 150px;"
                                  title="محتوا" required>{{ $event->content }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>آدرس فایل رویداد:</label>
                        <input type="url" name="url" class="form-control ltr" title="آدرس فایل رویداد"
                               placeholder="آدرس فایل رویداد" required value="{{ $event->attribute('url') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>فایل بندانگشتی:</label>
                        <input type="file" name="thumbnail_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $event->product->id }}-thumbnail">
                        <input type="url" name="thumbnail" class="form-control ltr" placeholder="فایل بندانگشتی" required
                               value="{{ $event->attribute('thumbnail') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>فایل بندانگشتی موبایل:</label>
                        <input type="file" name="thumbnail_mobile_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $event->product->id }}-thumbnail_mobile">
                        <input type="url" name="thumbnail_mobile" class="form-control ltr" placeholder="فایل بندانگشتی موبایل" required
                               value="{{ $event->attribute('thumbnail_mobile') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>فایل بنر:</label>
                        <input type="file" name="banner_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $event->product->id }}-banner">
                        <input type="url" name="banner" class="form-control ltr" placeholder="فایل بنر"
                               value="{{ $event->attribute('banner') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>فایل بنر موبایل:</label>
                        <input type="file" name="banner_mobile_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $event->product->id }}-banner_mobile">
                        <input type="url" name="banner_mobile" class="form-control ltr" placeholder="فایل بنر موبایل"
                               value="{{ $event->attribute('banner_mobile') }}">
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
    <script type="text/javascript" src="{{ m(asset('js/upload.js')) }}"></script>
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.events.index') }}"]').addClass('active');
        });
    </script>
@endsection

