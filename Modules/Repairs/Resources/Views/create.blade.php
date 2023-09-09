@extends('Panel::layouts.master')

@section('title', 'ساخت تعمیرکار جدید')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">افزودن تعمیرکار جدید</h4>
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
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('repairs.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="userID">شماره همراه</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('userID') is-invalid @enderror"
                                                   id="userID" name="userID"
                                                   placeholder="شماره همراه کاربر را وارد کنید">
                                            @error('userID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="telephone">شماره تماس همراه</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('telephone') is-invalid @enderror"
                                                   id="telephone" name="telephone"
                                                   placeholder="شماره تماس کاربر را وارد کنید">
                                            @error('telephone')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="name">نام</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name"
                                                   placeholder="نام را وارد کنید">
                                            @error('name')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="lastname">نام خانوادگی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('lastname') is-invalid @enderror"
                                                   id="lastname" name="lastname"
                                                   placeholder="نام خانوداگی را وارد کنید">
                                            @error('lastname')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="lastname">کدملی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('national_code') is-invalid @enderror"
                                                   id="national_code" name="national_code"
                                                   placeholder="کدملی را وارد کنید">
                                            @error('national_code')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="bcNumber">شماره شناسنامه</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('bcNumber') is-invalid @enderror"
                                                   id="bcNumber" name="bcNumber"
                                                   placeholder="شماره شناسنامه را وارد کنید">
                                            @error('bcNumber')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="repairID">شماره صنفی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('repairID') is-invalid @enderror"
                                                   id="repairID" name="repairID"
                                                   placeholder="شماره صنفی را وارد کنید">
                                            @error('repairID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="submit_plate">پلاک ثبتی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('submit_plate') is-invalid @enderror"
                                                   id="submit_plate" name="submit_plate"
                                                   placeholder="پلاک ثبتی را وارد کنید">
                                            @error('repairID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="submit_plate">آدرس</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   id="address" name="address"
                                                   placeholder="آدرس را وارد کنید">
                                            @error('address')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="submit_plate">کدپستی</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('postal_code') is-invalid @enderror"
                                                   id="postal_code" name="postal_code"
                                                   placeholder="کد پستی را وارد کنید">
                                            @error('postal_code')
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
