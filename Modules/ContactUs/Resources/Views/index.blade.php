@php use Modules\ContactUs\Models\ContactUs; @endphp
@extends('Panel::layouts.master')

@section('title', 'لیست انتقادات و پیشنهادات ')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="mt-0 header-title">لیست تمامی انتقادات و پیشنهادات </h4>
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
                                <th>نام و نام خانوادگی</th>
                                <th>موضوع پیام</th>
                                <th>متن پیام</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr class="text-center">
                                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                    @if($message->status == ContactUs::STATUS_NEW)
                                        <td class="badge badge-success mt-2">{{ $message->name }}</td>
                                    @elseif($message->status == ContactUs::STATUS_READ)
                                        <td class="badge badge-secondary mt-2">{{ $message->name }}</td>
                                    @endif
                                    <td class="align-middle">{{ $message->subject }}</td>
                                    <td class="align-middle">{{ $message->message }}</td>
                                    <td class="align-middle">{{explode(' ' , jdate($message->created_at))[0]}}</td>
                                    <td class="align-middle">
                                        <div class="row">
                                            <form onsubmit="return confirm('آیا مایل به حذف پیام میباشید؟');"
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
                        <br>
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
