@extends('pages.admin._layout')

@section('title', 'افزودن دسته')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.videos.categories.index') }}">دسته‌بندی</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.videos.categories.store') }}">
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required
                               title="" placeholder="عنوان">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="parent_id" class="form-control" title="انتخاب دسته بندی">
                            <option value="0" selected>بدون دسته</option>
                            @foreach($root_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="url" name="image" value="{{ old('image') }}" class="form-control"
                               title="آدرس تصویر دسته بندی" placeholder="آدرس تصویر دسته بندی">
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <input type="number" size="2" title="" name="position" value="{{ old('position') }}"
                               class="form-control" placeholder="جایگاه نمایش در صفحه اصلی (عدد بزرگتر نمایش بالاتر)">
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
            $('aside .list-group-item-action[href="{{ route('admin.videos.categories.index') }}"]').addClass('active');
        });
    </script>
@endsection

