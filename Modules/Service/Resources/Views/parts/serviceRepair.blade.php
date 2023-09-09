@extends('Panel::layouts.master')

@section('title', 'تاریخچه سرویس تعمیرکاران')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">تاریخچه سرویس تعمیرکاران</h4>
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
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('service.repairs.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="repairID">شناسه صنفی</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('repairID') is-invalid @enderror" id="repairID" name="repairID" placeholder="شناسه صنفی تعمیرگاه وارد کنید">
                                            @error('repairID')
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
