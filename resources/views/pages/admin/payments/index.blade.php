@extends('pages.admin._layout')

@section('title', 'فاکتور‌ها')

@section('head-links')
    @parent
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/persian-datepicker/persian-datepicker.min.css') }}">
@endsection

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
            <form class="rtl" method="get" action="{{ route('admin.payments.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label for="ref_num">کد‌پیگیری:</label>
                        <input type="text" name="ref_id" id="ref_id" class="form-control" value="{{ $refId }}"
                               placeholder="همه">
                    </div>
                    <div class="col-md-3">
                        <label for="from">تاریخ شروع:</label>
                        <input type="text" id="from" name="from" class="form-control"
                               value="{{ jDate($from, 'yyyy-MM-dd', false) }}">
                        <input type="hidden" name="from" class="form-control" value="{{ $from->getTimestamp() }}000">
                    </div>
                    <div class="col-md-3">
                        <label for="to">تاریخ پایان:</label>
                        <input type="text" id="to" name="to" class="form-control"
                               value="{{ jDate($to, 'yyyy-MM-dd', false) }}">
                        <input type="hidden" name="to" class="form-control" value="{{ $to->getTimestamp() }}000">
                    </div>
                    <div class="col-md-3">
                        <label for="user_id">کاربر:</label>
                        <input type="number" name="user_id" id="user_id" class="form-control" value="{{ $userId }}"
                               placeholder="همه">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="gateway">درگاه:</label>
                        <div class="form-group">
                            <select name="gateway" id="gateway" class="form-control" title="درگاه">
                                <option disabled selected>همه درگاه‌ها</option>
                                <option
                                    {{ $gateway == 'fcp' ? 'selected' : '' }} value="fcp">{{ trans('words.fcp') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="status">وضعیت:</label>
                        <div class="form-group">
                            <select name="status" id="status" class="form-control" title="وضعیت">
                                <option {{ $status == null ? 'selected' : '' }} value="" selected>همه</option>
                                <option {{ $status == 1 ? 'selected' : '' }} value="1">پرداخت نشده</option>
                                <option {{ $status == 2 ? 'selected' : '' }} value="2">پرداخت شده</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>گزینه‌ها:</label><br>
                        <input type="submit" class="btn btn-primary" value="اعمال">
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>کد‌پیگیری</td>
                        <td>تاریخ</td>
                        <td>مبلغ(﷼)</td>
                        <td>کاربر</td>
                        <td>درگاه</td>
                        <td>شماره کارت</td>
                        <td>وضعیت</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->transaction != null ? $invoice->transaction->reference_id : '' }}</td>
                            <td>{{ $invoice->transaction != null ? $invoice->transaction->created_at_j : $invoice->created_at_j  }}</td>
                            <td>{{ $invoice->amount }}</td>
                            <td>{{ $invoice->user->fullName() }}</td>
                            <td>{{ trans('words.' . $invoice->gateway) }}</td>
                            <td>{{ $invoice->transaction != null ? $invoice->transaction->card_number : ''  }}</td>
                            <td>
                                @if($invoice->transaction != null)
                                    <a class="btn btn-success">پرداخت شده</a>
                                @else
                                    <a class="btn btn-warning">پرداخت نشده</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rtl">{{ $invoices->render() }}</div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('vendor/persian-datepicker/persian-date.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/persian-datepicker/persian-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datepicker.js') }}"></script>
@endsection
