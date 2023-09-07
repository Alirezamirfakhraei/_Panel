@extends('Panel::layouts.master')

@section('title', 'گزارش گیری')

@section('content')
    <div class="container mt-2">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 item">
                <div class="card item-card card-block">
                    <a href="{{route('services.repair')}}">
                        <img src="<?= asset('admin/images/icon/repairMan.png') ?>" alt="Photo of sunset">
                    </a>                    <h5 class="item-card-title text-center mt-3 mb-3">تعمیرکاران</h5>
                    <p class="card-text pb-2">تاریخچه سرویس های انجام شده تعمیرکاران</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 item">
                <div class="card item-card card-block">
                    <a href="{{route('services.user')}}">
                        <img src="<?= asset('admin/images/icon/manCar.png') ?>" alt="Photo of sunset">
                    </a>
                    <h5 class="card-title text-center  mt-3 mb-3">کاربران</h5>
                    <p class="card-text pb-2 ">تاریخچه سرویس های انجام شده کاربران</p>
                </div>
            </div>
        </div>
    </div>
@endsection
