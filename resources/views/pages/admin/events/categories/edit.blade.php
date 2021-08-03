@extends('pages.admin._layout')

@section('title', 'ویرایش دسته')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.events.categories.index') }}">دسته‌بندی</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.events.categories.update', $category) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>عنوان:</label>
                        <input type="text" name="title" value="{{ $category->title }}" class="form-control" required
                               title="" placeholder="عنوان">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>دسته والد:</label>
                        <select name="parent_id" class="form-control" title="انتخاب دسته بندی">
                            <option {{$category->parent_id == 0 ? 'selected' : ''}} value="0">بدون دسته</option>
                            @foreach($root_categories as $c)
                                <option {{$c->id == $category->parent_id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>آدرس تصویر دسته بندی:</label>
                        <input type="url" name="image" value="{{ $category->image }}" class="form-control"
                               title="آدرس تصویر دسته بندی" placeholder="آدرس تصویر دسته بندی">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label>جایگاه نمایش در صفحه اصلی:</label>
                        <input type="number" size="2" name="position" title="" value="{{$category->position}}"
                               class="form-control" placeholder="جایگاه نمایش در صفحه اصلی (عدد بزرگتر نمایش بالاتر)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>توضیحات:</label>
                        <textarea name="description" class="form-control" title="" required
                                  placeholder="توضیحات">{{ $category->description }}</textarea>
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
            $('aside .list-group-item-action[href="{{ route('admin.events.categories.index') }}"]').addClass('active');

            $('input[name=title]').on('change keyup', function () {
                $('input[name=slug]').val($(this).val().replace(' ', '-'))
            });
        });
    </script>
@endsection

