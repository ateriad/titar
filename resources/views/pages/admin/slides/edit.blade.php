@extends('pages.admin._layout')

@section('title', 'ویرایش اسلاید')

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
        <form class="card-body rtl" method="post" action="{{ route('admin.slides.update', $slide) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col col-md-4">
                    <div class="form-group">
                        <label>عنوان:</label>
                        <input type="text" name="title" value="{{ $slide->title }}" class="form-control" required
                               title="" placeholder="عنوان">
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label>دکمه:</label>
                        <input type="text" name="button" value="{{ $slide->button }}" class="form-control" required
                               title="" placeholder="دکمه">
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label>دسته بندی:</label>
                        <select name="category_id" class="form-control" title="انتخاب دسته بندی">
                            <option value="" selected>بدون دسته</option>
                            @foreach($categories as $category)
                                <option {{$slide->category_id == $category->id ? 'selected' : ''}}
                                        value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>تصویر:</label>
                        <input type="url" name="image" value="{{ $slide->image }}" class="form-control" required
                               title="" placeholder="تصویر">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>تصویر موبایل:</label>
                        <input type="url" name="image_mobile" value="{{ $slide->image_mobile }}" class="form-control"
                               title="" placeholder="تصویر موبایل">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>لینک:</label>
                        <input type="url" name="link" value="{{ $slide->link }}" class="form-control" required
                               title="" placeholder="آدرس">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>توضیحات:</label>
                        <textarea name="description" class="form-control" title="" required
                                  placeholder="توضیحات">{{ $slide->description }}</textarea>
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
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.slides.index') }}"]').addClass('active');
        });
    </script>
@endsection

