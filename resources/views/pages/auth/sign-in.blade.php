@extends('pages.auth._layout')

@section('title', 'ورود کاربران')

@section('main')
    <form class="form-group" method="post">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control ltr text-left" title="ایمیل" placeholder="Email"
                   required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control ltr text-left" title="گذرواژه"
                   placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-purple btn-block" title="" placeholder="Password" value="ورود">
        </div>
    </form>
@endsection
