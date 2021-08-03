@extends('pages.admin._layout')

@section('head-links')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/chosen/chosen.min.css') }}"/>
@show

@section('title', 'افزودن نقش')

@section('breadcrumb')
    <nav id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">نقش‌ ها</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="card">
        <form class="card-body rtl" method="post" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="row">
                <div class="col col-md-12">
                    <div class="form-group">
                        <label>عنوان:</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                               required placeholder="عنوان">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <div class="form-group">
                        <label>انتخاب دسترسی ها:</label>
                        <select name="permissions[]" multiple class="form-control">
                            @foreach(\App\Enums\Permissions::all() as $p)
                                <option value="{{ $p }}">{{ trans('words.permissions.'. $p) }}</option>
                            @endforeach
                        </select>
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
            $('aside .list-group-item-action[href="{{ route('admin.roles.index') }}"]').addClass('active');
        });
    </script>
    <script type="text/javascript" src="{{ asset('vendor/chosen/chosen.jquery.min.js') }}"></script>
    <script>
        $('select[name="permissions[]"]').chosen({rtl: true});
    </script>
@endsection

