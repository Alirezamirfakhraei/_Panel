@extends('Panel::layouts.master')

@section('title', 'لیست کاربران')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="{{route('repairs.create')}}" class="arrow-none btn btn-primary text-white" aria-expanded="false">
                            ثبت تعمیرکار جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی تعمیرکاران</h4>
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
                                    <th>شماره همراه</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>کدملی</th>
                                    <th>نام مالک</th>
                                    <th>شناسه صنفی</th>
                                    <th>نام تعمیرگاه</th>
                                    <th>آدرس</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ورورد</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repairs as $repair)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $repair->userID }}</td>
                                        <td>{{ $repair->name.''.$repair->lastname }}</td>
                                        <td>{{ $repair->national_code }}</td>
                                        <td>{{ $repair->repairOwner }}</td>
                                        <td>{{ $repair->repairID }}</td>
                                        <td>{{ $repair->repairShop}}</td>
                                        <td>{{ $repair->address}}</td>
                                        <td class="badge badge-success mt-2">@lang($repair->status)</td>
                                        <td>{{explode(' ' , jdate($repair->created_at))[0]}}</td>
                                        <td>
                                            <div class="row">
                                                <!-- Button trigger modal -->
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$repair->id}}">
                                                        جزئیات تعمیرگاه
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade modal-center" id="myModal{{$repair->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">توضیحات بیشتر</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group text-left mb-2">
                                                                    <li class="list-group-item">اسم تعمیرگاه
                                                                        <span class="float-right"><?= $repair->repairShop?></span>
                                                                    </li>
                                                                    <li class="list-group-item">تاریخ صدور
                                                                        <span class="float-right"><?= $repair->issue_date ?></span>
                                                                    </li>
                                                                    <li class="list-group-item">تاریخ انقضاء
                                                                        <span class="float-right"><?= $repair->expiration_date ?></span>
                                                                    </li>
                                                                    <li class="list-group-item">مباشر
                                                                        <span class="float-right"><?= $repair->steward ?></span>
                                                                    </li>
                                                                    <li class="list-group-item">نام پدر
                                                                        <span class="float-right"><?= $repair->fatherName ?></span>
                                                                    </li>
                                                                    <li class="list-group-item">تاریخ تولد
                                                                        <span class="float-right"><?= $repair->date_of_birth?></span>
                                                                    </li>
                                                                    <li class="list-group-item">پلاک ثبتی
                                                                        <span class="float-right"><?= $repair->submit_plate?></span>
                                                                    </li>
                                                                    <li class="list-group-item">پلاک آبی
                                                                        <span class="float-right"><?= $repair->blue_plate?></span>
                                                                    </li>
                                                                    <li class="list-group-item">نوع شخص
                                                                        <span class="float-right"><?= $repair->type_of_person?></span>
                                                                    </li>
                                                                    <li class="list-group-item">نوع فعالیت
                                                                        <span class="float-right"><?= $repair->type_of_activity?></span>
                                                                    </li>
                                                                    <li class="list-group-item">درجه
                                                                        <span class="float-right"><?= $repair->union_degree?></span>
                                                                    </li>
                                                                    <li class="list-group-item">    کیلومتر آیسیک
                                                                        <span class="float-right"><?= $repair->isIc_code?></span>
                                                                    </li>
                                                                    <li class="list-group-item">شهر
                                                                        <span class="float-right"><?= $repair->city?></span>
                                                                    </li>
                                                                    <li class="list-group-item">    کد استان
                                                                        <span class="float-right"><?= $repair->province_code?></span>
                                                                    </li>
                                                                    <li class="list-group-item">   کد پستی
                                                                        <span class="float-right"><?= $repair->postal_code?></span>
                                                                    </li>
                                                                    <li class="list-group-item">   محله
                                                                        <span class="float-right"><?= $repair->area?></span>
                                                                    </li>
                                                                    <li class="list-group-item">طول
                                                                        <span class="float-right"><?= $repair->length?></span>
                                                                    </li>
                                                                    <li class="list-group-item">عرض
                                                                        <span class="float-right"><?= $repair->width?></span>
                                                                    </li>
                                                                    <li class="list-group-item">ارتفاع
                                                                        <span class="float-right"><?= $repair->height?></span>
                                                                    </li>
                                                                    <li class="list-group-item">عرض خیابان اصلی
                                                                        <span class="float-right"><?= $repair->street_width?></span>
                                                                    </li>
                                                                    <li class="list-group-item">اعداد اعضاء
                                                                        <span class="float-right"><?= $repair->members?></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">بازگشت</a>
                                                                <a href="{{ route('repairs.edit', $repair->id) }}" type="button" class="btn btn-primary" style="color: white">تغییر اطلاعات تعمیرگاه</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-warning ml-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');"
                                                      action="{{ route('repairs.destroy',$repair->id) }}" method="POST">
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
                        {{ $repairs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
