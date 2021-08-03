@extends('pages.admin._layout')

@section('head-meta')
    @parent
    <meta name="upload" content="{{ route('admin.uploads.index') }}">
    <meta name="loading" content="{{ asset('img/loading.gif') }}">
@show

@section('title', 'ویرایش تصویر')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.images.index') }}">تصاویر</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.images.update', $image) }}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>عنوان:</label>
                        <input type="text" name="title" class="form-control" title="عنوان" required
                               placeholder="عنوان" value="{{ $image->title }}">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>دسته:</label>
                        <select name="category" class="form-control" title="دسته">
                            @foreach($categories as $category)
                                <option
                                    @if(count($image->categories) && $image->categories[0]->id == $category->id)
                                    {{ 'selected' }}
                                    @endif
                                    value="{{ $category->id }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach
                            <option value="" {{ count($image->categories) == 0 ? 'selected' : '' }}>بدون دسته</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <label>سال ساخت:</label>
                    <div class="form-group">
                        <input type="text" name="year" maxlength="4" class="form-control" title="سال ساخت" placeholder="سال ساخت" value="{{ $image->year }}">
                    </div>
                </div>
                <div class="col col-md-6">
                    <label>ژانر:</label>
                    <div class="form-group">
                        <input type="text" name="genre" class="form-control" title="ژانر" placeholder="ژانر" value="{{ $image->genre }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <label>ناشر:</label>
                    <div class="form-group">
                        <input type="text" name="publisher" class="form-control" title="ناشر" placeholder="ناشر" value="{{ $image->publisher }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>محتوا:</label>
                        <textarea class="form-control rtl" name="content" placeholder="محتوا" style="height: 150px;"
                                  title="محتوا" required>{{ $image->content }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>آدرس فایل تصویر:</label>
                        <input type="file" name="video_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $image->product->id }}-file">
                        <input type="url" name="url" class="form-control ltr" placeholder="فایل تصویر" required
                               value="{{ $image->attribute('url')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>آدرس فایل بندانگشتی:</label>
                        <input type="file" name="thumbnail_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $image->product->id }}-thumbnail">
                        <input type="url" name="thumbnail" class="form-control ltr" placeholder="فایل بندانگشتی" required
                               value="{{ $image->attribute('thumbnail') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>آدرس فایل بندانگشتی موبایل:</label>
                        <input type="file" name="thumbnail_mobile_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $image->product->id }}-thumbnail_mobile">
                        <input type="url" name="thumbnail_mobile" class="form-control ltr" placeholder="فایل بندانگشتی موبایل" required
                               value="{{ $image->attribute('thumbnail_mobile') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>آدرس فایل بنر:</label>
                        <input type="file" name="banner_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $image->product->id }}-banner">
                        <input type="url" name="banner" class="form-control ltr" placeholder="فایل بنر"
                               value="{{ $image->attribute('banner') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>آدرس فایل بنر موبایل:</label>
                        <input type="file" name="banner_mobile_file" class="upload"
                               accept="image/jpeg,image/x-png" id="products-{{ $image->product->id }}-banner_mobile">
                        <input type="url" name="banner_mobile" class="form-control ltr" placeholder="فایل بنر موبایل"
                               value="{{ $image->attribute('banner_mobile') }}">
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
            $('aside .list-group-item-action[href="{{ route('admin.images.index') }}"]').addClass('active');
        });
    </script>
@endsection

