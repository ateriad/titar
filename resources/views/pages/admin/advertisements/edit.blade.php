@extends('pages.admin._layout')

@section('head-meta')
    @parent
    <meta name="upload" content="{{ route('admin.uploads.index') }}">
    <meta name="loading" content="{{ asset('img/loading.gif') }}">
@show

@section('title', 'ویرایش‌تبلیغ')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.advertisements.index') }}">تبلیغات</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.advertisements.update', $advertisement) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>عنوان:</label>
                        <input type="text" name="title" value="{{ $advertisement->title }}" class="form-control"
                               required
                               title="" placeholder="عنوان">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>مدت زمان پخش تبلیغ تا نمایش دکمه رد کردن(ثانیه):</label>
                        <input type="number" name="length" value="{{ $advertisement->length }}" class="form-control"
                               title="" placeholder="مدت زمان پخش تبلیغ تا نمایش دکمه رد کردن(ثانیه)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>وضعیت نمایش:</label>
                        <select name="status" class="form-control" title="وضعیت نمایش">
                            <option disabled selected>وضعیت نمایش</option>
                            <option {{ $advertisement->status == 2 ? 'selected' : ''}} value="2">فعال</option>
                            <option {{ $advertisement->status == 1 ? 'selected' : ''}} value="1">غیر فعال</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>قابلیت رد کردن تبلیغ:</label>
                        <select name="skippable" class="form-control" title="قابلیت رد کردن تبلیغ">
                            <option  disabled selected>قابلیت رد کردن تبلیغ</option>
                            <option {{ $advertisement->skippable == 1 ? 'selected' : ''}} value="1">تبلیغ با قابلیت رد کردن از ابتدا</option>
                            <option {{ $advertisement->skippable == 2 ? 'selected' : ''}} value="2">تبلیغ بدون قابلیت رد کردن از ابتدا</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>ویدئو تبلیغ:</label>
                        <input type="file" name="video_file" class="upload"
                               accept="video/mp4" id="advertisements-{{ $advertisement->id }}-file">
                        <input type="url" name="video" class="form-control ltr" placeholder="آدرس‌ ویدئو" required
                               value="{{ $advertisement->video}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>لینک تبلیغ:</label>
                        <input type="url" name="url" value="{{ $advertisement->url }}" class="form-control" required
                               title="" placeholder="لینک تبلیغ">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="ویرایش">
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
            $('aside .list-group-item-action[href="{{ route('admin.advertisements.index') }}"]').addClass('active');
        });
    </script>
@endsection

