{{$user->first_name}} عزیز <br>
لینک بازنشانی ایمیل در تیتار: <br>
<a href="{{ route('account.profile.email.verify' , ['token' => $token]) }}">بازنشانی</a> <br>
<hr>
<a href="https://titar.ir">تیتار</a>
