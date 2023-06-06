@extends('auth::layouts.master')

@section('title' , 'صفحه اصلی')

@section('content')
    <div class="container" id="registration-form">
        <div class="image"></div>
        <div class="frm">
            <h1>اسکارپین</h1>
            <form class="form-control-light">
                <div class="form-group">
                    <label for="username">نام کاربری:</label>
                    <input type="text" class="form-control" id="username" placeholder="نام کاربری را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="pwd">کلمه عبور:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="کلمه عبور را وارد کنید">
                </div>
                <div class="button_submit">
                    <button type="submit" class="btn-lg btn btn-color float-left w-25">ورود</button>
                </div>
            </form>
        </div>
    </div>
@endsection
