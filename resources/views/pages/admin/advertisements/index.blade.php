@extends('pages.admin._layout')

@section('title', 'تبلیغات')

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
            <div class="form-group">
                <a href="{{ route('admin.advertisements.create') }}" class="btn btn-primary">افزودن تبلیغ</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>عنوان</td>
                        <td>وضعیت</td>
                        <td>قابلیت رد کردن</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advertisements as $advertisement)
                        <tr>
                            <td>{{ $advertisement->id }}</td>
                            <td>{{ $advertisement->title }}</td>
                            <td>
                                {{ $advertisement->status == 2 ? 'فعال' : 'غیر‌فعال' }}
                            </td>
                            <td>
                                {{ $advertisement->skippable == 1 ? 'دارد' : 'ندارد' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.advertisements.edit', $advertisement) }}"
                                   class="btn btn-sm btn-info">ویرایش</a>
                                <form class="form-inline d-inline-block" method="post"
                                      action="{{ route('admin.advertisements.destroy', $advertisement) }}">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('پاک شود؟')"
                                            type="submit" class="btn btn-sm btn-danger">پاک‌کردن</button>
                                </form>
                                <form class="form-inline d-inline-block" method="get"
                                      action="{{ route('admin.charts.advertisements.visits') }}">
                                    <input name="advertisement_id" hidden value="{{ $advertisement->id }}"/>
                                    <button type="submit" class="btn btn-sm btn-success">بازدید</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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

