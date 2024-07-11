@extends('Panel::layouts.master')

@section('title', 'ویرایش کاربر ' . $user->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title ">ویرایش کاربر {{$user->id}}</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('users.update', $user->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="userID">شماره موبایل</label>
                                        <div class="col-sm-10">
                                            <input type="text" disabled
                                                   class="form-control @error('userID') is-invalid @enderror"
                                                   value="{{ $user->userID }}" id="userID" name="userID"
                                                   placeholder="شماره همراه جدید را وارد کنید">
                                            @error('userID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="name">نام کاربر</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" value="{{$user->name}}" name="name"
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
                                                   id="lastname" value="{{$user->lastname}}" name="lastname"
                                                   placeholder="نام خانوداگی کاربر را وارد کنید">
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
                                                   value="{{ $user->national_code }}" id="national_code" name="national_code"
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
                                                   value="{{ $user->address }}" id="address" name="address" placeholder="آدرس کاربر را وارد کنید">
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
                                                   value="{{ $user->telephone }}" id="telephone" name="telephone"
                                                   placeholder="تلفن کاربر را وارد کنید">
                                            @error('telephone')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="telephone">شغل</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('job') is-invalid @enderror"
                                                   value="{{ $user->job }}" id="job" name="job"
                                                   placeholder="شغل کاربر را وارد کنید">
                                            @error('job')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-success">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
