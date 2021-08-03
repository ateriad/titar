@extends('pages.auth._layout')

@section('title', 'ورود / نام‌نویسی')

@section('main')
    <div class="form-group" dir="rtl">
        @csrf
        <div class="form-group">
            <input id="cellphone" type="text" class="form-control ltr text-left" title=""
                   placeholder="09120001234 (شماره)" required>
        </div>
        <div class="form-group">
            <button id="request" class="btn btn-purple btn-block">فرستادن کد ورود</button>
        </div>
        <div class="form-group d-none">
            <input id="otp" type="number" class="form-control ltr text-left" title=""
                   placeholder="کد ورود" required>
        </div>
        <div class="form-group d-none">
            <button id="submit" class="btn btn-purple btn-block">ورود / نام نویسی</button>
            <p class="text-center text-muted mt-3">
                <span>زمان باقی‌مانده:</span>
                <span id="time">60</span>
            </p>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('vendor/notify/notify.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#request').click(function () {
                let button = $(this);
                button.attr('disabled', true).html('در حال پردازش...');

                $.ajax({
                    url: '{{ url('/api/v1/auth/otp/request') }}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        cellphone: $('#cellphone').val(),
                    }
                }).done((response) => {
                    $('#cellphone').attr('readonly', true)
                        .notify('کد ورود برای شما پیامک شد.', 'success');

                    $('#request').parent().hide();
                    $('#otp').parent().removeClass('d-none');
                    $('#submit').parent().removeClass('d-none');
                    $('#time').html(response['expires_after']);

                    setInterval(() => {
                        let t = $('#time');
                        if (parseInt(t.html()) > 0) {
                            t.html(parseInt(t.html()) - 1);
                        } else if (t.html() === '0') {
                            t.html('');
                            window.location.reload();
                        }
                    }, 1000);
                }).fail(e => {
                    console.log(e);
                    if (e.status === 400) {
                        button.notify(e['responseJSON']['error'], 'error');
                    } else {
                        console.log(e);
                        button.notify('مشکلی پیش آمده لطفا دوباره تلاش کنید...', 'error');
                    }

                    button.html('فرستادن کد ورود').attr('disabled', false);
                });
            });

            $('#submit').click(function () {
                let button = $(this);
                button.attr('disabled', true).html('در حال پردازش...');

                $.ajax({
                    url: '{{ route('auth.otp.submit') }}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        cellphone: $('#cellphone').val(),
                        otp: $('#otp').val(),
                        session: true,
                    }
                }).done(response => {
                    window.location = response['redirect'];
                }).fail(e => {
                    if (e.status === 400) {
                        button.notify(e['responseJSON']['error'], 'error');
                    } else {
                        console.log(e);
                        button.notify('مشکلی پیش آمده لطفا دوباره تلاش کنید...', 'error');
                    }

                    button.html('ورود / نام نویسی').attr('disabled', false);
                });
            });
        });
    </script>
@endsection
