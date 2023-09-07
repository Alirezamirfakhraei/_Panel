@extends('Panel::layouts.master')

@section('title', 'تاریخچه سرویس کاربران')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">تاریخچه سرویس کاربران</h4>
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
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('service.users.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="userID">شماره تلفن همراه</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('userID') is-invalid @enderror" id="userID" name="userID" placeholder="شماره موبایل عضوشده در سامانه را وارد کنید">
                                            @error('userID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="carID">شناسه خودرو</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('carID') is-invalid @enderror" id="carID" name="carID" placeholder="شناسه خودرو را وارد کنید">
                                            @error('carID')
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
