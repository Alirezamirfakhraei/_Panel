@extends('Panel::layouts.master')

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
                                    <th>نام و نام خانوادگی</th>
                                    <th>کدملی</th>
                                    <th>نام مالک</th>
                                    <th>اسم تعمیرگاه</th>
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
                                        <td>{{ $repair->repairOwner}}</td>
                                        <td>{{ $repair->repairShop}}</td>
                                        <td>{{ $repair->address}}</td>
                                        <td>{{ $repair->status}}</td>
                                        <td>{{ jdate($repair->created_at)}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('users.edit', $repair->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $repair->id) }}" method="POST">
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
