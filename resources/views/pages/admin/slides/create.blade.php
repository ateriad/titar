@extends('pages.admin._layout')

@section('title', 'افزودن اسلاید')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.slides.index') }}">اسلاید‌ها</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.slides.store') }}">
            @csrf
            <div class="row">
                <div class="col col-md-4">
                    <div class="form-group">
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required
                               title="" placeholder="عنوان">
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <input type="text" name="button" value="{{ old('button') }}" class="form-control" required
                               title="" placeholder="دکمه">
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <select name="category_id" class="form-control" title="انتخاب دسته بندی">
                            <option value="0" selected>بدون دسته</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="url" name="image" value="{{ old('image') }}" class="form-control" required
                               title="" placeholder="تصویر">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="url" name="image_mobile" value="{{ old('image_mobile') }}" class="form-control"
                               title="" placeholder="تصویر موبایل">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="url" name="link" value="{{ old('link') }}" class="form-control" required
                               title="" placeholder="آدرس">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <textarea name="description" class="form-control" title="" required
                                  placeholder="توضیحات">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="افزودن">
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
            $('aside .list-group-item-action[href="{{ route('admin.slides.index') }}"]').addClass('active');
        });
    </script>
@endsection

