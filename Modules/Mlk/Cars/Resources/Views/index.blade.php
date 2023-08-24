@extends('Panel::layouts.master')
<?php
$help = new helper();
$function = new Functions();
?>
@section('title', 'لیست وسایل نقلیه')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="{{ route('cars.create') }}" class="arrow-none btn btn-primary text-white"
                           aria-expanded="false">
                            ساخت خودرو جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی خودرو کاربران</h4>
                    @if (session()->has('success_delete'))
                        <br>
                        <div class="alert alert-success">{{ session()->get('success_delete') }}</div>
                    @endif
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>شماره همراه</th>
                                <th>مدل خودرو</th>
                                <th>شناسه خودرو</th>
                                <th>پلاک</th>
                                <th>بیمه شخص ثالث</th>
                                <th>تاریخ ورود</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                <tr class="text-center">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $car->userID }}</td>
                                    <td>{{ $car->company.' '.$car->model }}</td>
                                    <td class="badge badge-success mt-2">{{ $car->carID }}</td>
                                    <td>
                                            <?php
                                            $character = $function->truePlateView($car->plate);
                                            $split = str_split($car->plate, 1);
                                            ?>

                                        <div class="license-plate mt-1">
                                            <div class="blue-column">
                                                <div class="flag">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                                <div class="text">
                                                    <div>I.R.</div>
                                                    <div>IRAN</div>
                                                </div>
                                            </div>
                                            <span>{{$split[0].$split[1]}}</span>
                                            <span class="alphabet-column mt-2">{{$character}}</span>
                                            <span>{{$split[4].$split[5].$split[6]}}</span>
                                            <div class="iran-column">
                                                <span>ایــران</span>
                                                <strong>{{$split[7].$split[8]}}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    {{--                                    <td>{{ $car->plate }}</td>--}}
                                    <td>{{ $car->third_insurance}}</td>
                                    <td>{{ explode(' ' , jdate($car->created_at))[0] }}</td>
                                    <td>
                                        <div class="row ">
                                            <!-- Button trigger modal -->
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                    جزئیات خودرو
                                                </button>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade modal-center" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group text-left mb-2">
                                                                <li class="list-group-item">سال خودرو
                                                                    <span class="float-right"><?= $car->year ?></span>
                                                                </li>
                                                                <li class="list-group-item">    کیلومتر فعلی
                                                                    <span class="float-right"><?= $car->km_current ?></span>
                                                                </li>
                                                                <li class="list-group-item">   میانگین کیلومتر خوردو
                                                                    <span class="float-right"><?= $car->km_average ?></span>
                                                                </li>
                                                                <li class="list-group-item">    شماره شاسی
                                                                    <span class="float-right"><?= $car->chassis_number ?></span>
                                                                </li>
                                                                <li class="list-group-item">    شماره موتور
                                                                    <span class="float-right"><?= $car->engine_number ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">بازگشت</a>
                                                            <a href="{{ route('cars.edit', $car->id) }}" type="button" class="btn btn-primary" style="color: white">تغییر اطلاعات خودرو</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning ml-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');"
                                                  action="{{ route('cars.destroy',$car->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-1">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
