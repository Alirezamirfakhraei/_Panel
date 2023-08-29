@extends('Panel::layouts.master')

@section('title', 'لیست پیام ها')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="" class="arrow-none btn btn-primary text-white" aria-expanded="false">
                            ثبت تعمیرکار جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی پیام ها</h4>
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
                                    <th>ایمیل</th>
                                    <th>موضوع پیام</th>
                                    <th>متن پیام</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ورورد</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $message->phone }}</td>
                                        <td>{{ $message->name}}</td>
                                        <td>{{ $message->email}}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td class="badge badge-success mt-2">@lang($message->status)</td>
                                        <td>{{explode(' ' , jdate($message->created_at))[0]}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('repairs.edit', $message->id) }}" class="btn btn-warning ml-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');"
                                                      action="{{ route('repairs.destroy',$message->id) }}" method="POST">
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
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
