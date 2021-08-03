@extends('pages.admin._layout')

@section('title', 'داشبورد')

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('panel')
    <div class="row rtl mar-top-20">
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">تعداد بازدید ویدئو‌ها</h5>
                    <p class="card-text">{{ $videoVisitsCount }}</p>
                </div>
                <div class="card-footer border-white">
                    <a class="text-white" href="{{ route('admin.charts.videos.visits') }}">مشاهده‌نمودار</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">تعداد بازدید تبلیغ‌ها</h5>
                    <p class="card-text">{{ $adVisitsCount }}</p>
                </div>
                <div class="card-footer border-white">
                    <a class="text-white" href="{{ route('admin.charts.advertisements.visits') }}">مشاهده‌نمودار</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">تعداد مشاهده ویدئو‌ها در وب</h5>
                    <p class="card-text">{{ $webVisitsCount }}</p>
                </div>
                <div class="card-footer border-white">
                    <a class="text-white" href="{{ route('admin.charts.source') }}">مشاهده‌نمودار</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">تعداد مشاهده ویدئو‌ها در اندروید</h5>
                    <p class="card-text">{{ $androidVisitsCount }}</p>
                </div>
                <div class="card-footer border-white">
                    <a class="text-white" href="{{ route('admin.charts.source') }}">مشاهده‌نمودار</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">تعداد مشاهده ویدئو‌ها در ویندوز</h5>
                    <p class="card-text">{{ $windowsVisitsCount }}</p>
                </div>
                <div class="card-footer border-white">
                    <a class="text-white" href="{{ route('admin.charts.source') }}">مشاهده‌نمودار</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">لاگ ورود</div>
        <div class="card-body rtl table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>زمان</th>
                    <th>نوع</th>
                    <th>IP</th>
                    <th>Agent</th>
                </tr>
                </thead>
                <tbody>
                @foreach($signInLogs as $signInLog)
                    <tr>
                        <td>{{ jDate($signInLog->created_at) }}</td>
                        <td>
                            @if($signInLog->type == 1)
                                <span class="text-success">موفق</span>
                            @elseif($signInLog->type == 2)
                                <span class="text-danger">ناموفق</span>
                            @else
                                <span class="text-muted">نامشخص</span>
                            @endif
                        </td>
                        <td><pre>{{ $signInLog->ip }}</pre></td>
                        <td><span class="small">{{ $signInLog->agent }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center ltr">{!! $signInLogs->render() !!}</div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('aside .list-group-item-action[href="{{ route('admin.dashboard') }}"]').addClass('active');
        });
    </script>
@endsection

