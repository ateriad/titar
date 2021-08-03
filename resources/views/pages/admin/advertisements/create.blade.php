@extends('pages.admin._layout')

@section('title', 'افزودن تبلیغ')

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
        <form class="card-body rtl" method="post" action="{{ route('admin.advertisements.store') }}">
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required
                               title="" placeholder="عنوان">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="number" name="length" value="{{ old('length') }}" class="form-control"
                               title="" placeholder="مدت زمان پخش تبلیغ تا نمایش دکمه رد کردن(ثانیه)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <select name="status" class="form-control" title="وضعیت نمایش">
                            <option  disabled selected>وضعیت نمایش</option>
                            <option value="2">فعال</option>
                            <option value="1">غیر فعال</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <select name="skippable" class="form-control" title="قابلیت رد کردن تبلیغ">
                            <option  disabled selected>قابلیت رد کردن تبلیغ</option>
                            <option value="1">تبلیغ با قابلیت رد کردن از ابتدا</option>
                            <option value="2">تبلیغ بدون قابلیت رد کردن از ابتدا</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="url" name="url" value="{{ old('url') }}" class="form-control" required
                               title="" placeholder="لینک تبلیغ">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="ادامه">
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
            $('aside .list-group-item-action[href="{{ route('admin.advertisements.index') }}"]').addClass('active');
        });
    </script>
@endsection

