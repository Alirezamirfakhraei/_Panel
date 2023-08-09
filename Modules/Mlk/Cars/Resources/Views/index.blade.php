@extends('Panel::layouts.master')
<?php
$help = new helper();
?>
@section('title', 'لیست کاربران')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="" class="arrow-none btn btn-primary text-white" aria-expanded="false">
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
                                    <td>{{ $car->carID }}</td>
                                    <td>
                                            <?php
                                            $split = preg_split('//u', $car->plate, -1, PREG_SPLIT_NO_EMPTY);
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
                                            <span class="alphabet-column">{{$split[7]}}</span>
                                            <span>{{$split[2].$split[3].$split[4]}}</span>
                                            <div class="iran-column">
                                                <span>ایــران</span>
                                                <strong>{{$split[5].$split[6]}}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    {{--                                    <td>{{ $car->plate }}</td>--}}
                                    <td>{{ $car->third_insurance}}</td>
                                    <td>{{ explode(' ' , jdate($car->created_at))[0] }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('users.edit', $car->id) }}" class="btn btn-warning">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('users.add.role', $car->id) }}"
                                               class="btn btn-success ml-1">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $car->id) }}" method="POST">
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
