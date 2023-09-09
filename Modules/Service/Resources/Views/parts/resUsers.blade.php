@extends('Panel::layouts.master')
<?php
$help = new helper();
$function = new Functions();
?>
@section('title', 'تاریخچه سرویس')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="mt-0 header-title">تاریخچه سرویس کاربر</h4>
                    <br>
                    @if (session()->has('success_delete'))
                        <br>
                        <div class="alert alert-success">{{ session()->get('success_delete') }}</div>
                    @endif
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr class="text-center">
                                <th>ردیف</th>
                                <th>قطعه/سرویس</th>
                                <th>نوع ثبت سرویس</th>
                                <th>تعمیرکار</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr class="text-center">
                                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                    <td class="align-middle"> @lang($service->pieceName)</td>
                                    <td class="align-middle"> @lang($service->referenceID)</td>
                                    <td class="align-middle">@lang($service->repairMan)</td>
                                    <td class="align-middle">{{ explode(' ' , jdate($service->created_at))[0] }}</td>
                                    <td class="align-middle">
                                        <div class="row">
                                            <!-- Button trigger modal -->
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="button" class="btn btn-primary" id="myModal"
                                                        data-toggle="modal"
                                                        data-target="#myModal{{$service->id}}">
                                                    جزئیات سرویس
                                                </button>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade modal-center" id="myModal{{$service->id}}"
                                                 tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">توضیحات
                                                                بیشتر</h5>
                                                            <a href="" type="button" class="close" data-dismiss="modal"
                                                               aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group text-left mb-2">
                                                                <li class="list-group-item"> قطعه/سرویس
                                                                    <span class="float-right">@lang($service->pieceName)</span>
                                                                </li>
                                                                <li class="list-group-item">نوع
                                                                    <span class="float-right">@lang($service->type)</span>
                                                                </li>
                                                                <li class="list-group-item">کیلومتر تعویض
                                                                    <span class="float-right"><?= $service->kmReplace ?></span>
                                                                </li>
                                                                <li class="list-group-item">عمر قطعه/سرویس
                                                                    <span class="float-right"><?= $service->kmRequest ?></span>
                                                                </li>
                                                                <li class="list-group-item">توضیحات
                                                                    <span class="float-right"><?= $service->description ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-secondary"
                                                               style="color: white" data-dismiss="modal">بازگشت</a>
                                                            <a href="{{ route('cars.edit', $service->id) }}"
                                                               type="button"
                                                               class="btn btn-primary" style="color: white">تغییر
                                                                اطلاعات سرویس</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form onsubmit="return confirm('آیا مایل به حذف  سرویس قطعه میباشید؟');"
                                                  action="{{ route('cars.destroy',$service->id) }}" method="POST">
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
                        <br>
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
