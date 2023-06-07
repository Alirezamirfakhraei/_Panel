@extends('auth::layouts.master')

@section('title' , 'صفحه اصلی')

@section('content')
    <div class="loginWrapper">
        <div class="logincard bg-white">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="leftbox">
                        <div class="circle"></div>
                        <div class="leftboxContent">
                            <img src="<?=asset('assets/images/pages/bg-05.png') ?>" class="bgimg" alt="flower image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="rightbox text-center">
                        <img src="<?=asset('assets/images/pages/512.png') ?>" class="rounded-circle"
                             alt="profile image">
                        <p>ورود به پنل <span style="color: #f0ca45">اسکارپین</span> (ادمین)</p>

                        <form action="<?= route('admin.login')?>" method="post">
                            @csrf
                            <input autocomplete="current-userID" required type="text" name="userID" id="userID" value="{{ old('userID') }}"
                                   class="form-control text-center @error('userID') is-invalid @enderror" placeholder="نام کاربری"
                                   aria-describedby="prefixId">
                            @error('userID')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                            @enderror

                            <input autocomplete="current-password" required type="password" name="password" id="password" value="{{ old('password') }}"
                                   class="form-control text-center @error('password') is-invalid @enderror" placeholder="رمز عبور" aria-describedby="prefixId">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                            @enderror

                            <p class="text-left"><input type="checkbox" name="" id="abc" class="mr-2"> مرا به خاطر بسپار
                                <label for="abc"></label></p>
                            <input type="submit" class="btn btn-primary" value="ورود">
                            <p>
                                <a href="#">ورود با شماره تلفن همراه و کد تایید</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
