@extends('Panel::layouts.master')

@section('title', 'ساخت کاربر جدید')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">افزودن کاربر جدید</h4>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                @if (count($errors) > 0)
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                {{--                           <form class="form-horizontal" role="form" method="POST" action="/admin/users"> DONT WRITE THIS FOR ACTION--}}
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="userID">شماره موبایل</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('userID') is-invalid @enderror"
                                                   id="userID" name="userID"
                                                   placeholder="شماره همراه جدید را وارد کنید">
                                            @error('userID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="email">ایمیل کاربری</label>
                                        <div class="col-sm-10">
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email"
                                                   placeholder="ایمیل کاربری را وارد کنید">
                                            @error('email')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="name">نام کاربر</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name"
                                                   placeholder="نام کاربر را وارد کنید">
                                            @error('name')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="lastname">نام خانوداگی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('lastname') is-invalid @enderror"
                                                   id="lastname" name="lastname"
                                                   placeholder="رمز عبور کاربر را وارد کنید">
                                            @error('lastname')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="national_code"> کدملی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('national_code') is-invalid @enderror"
                                                   id="national_code" name="national_code"
                                                   placeholder="کدملی کاربر را وارد کنید">
                                            @error('national_code')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="address">آدرس</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   id="address" name="address" placeholder="آدرس کاربر را وارد کنید">
                                            @error('address')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="telephone">تلفن</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('telephone') is-invalid @enderror"
                                                   id="telephone" name="telephone"
                                                   placeholder="تلفن کاربر را وارد کنید">
                                            @error('telephone')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="float-right w-25 btn btn-outline-success">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
