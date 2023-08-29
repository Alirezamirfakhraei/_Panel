@php use Mlk\Tickets\Models\Ticket; @endphp
@extends('Panel::layouts.master')

@section('title', 'لیست تیکت ها')

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
                    <h4 class="mt-0 header-title">لیست تمامی تیکت ها</h4>
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
                                <th>شماره تیکت</th>
                                <th>شماره همراه</th>
                                <th>نوع تیکت</th>
                                <th>موضوع پیام</th>
                                <th>سرتیتر پیام</th>
                                <th>متن پیام</th>
                                <th>اولویت</th>
                                <th>تصاویر</th>
                                <th>تاریخ ورورد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="text-center">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    @if($ticket->status == Ticket::STATUS_NEW)
                                    <td class="badge badge-success mt-2">{{ $ticket->ticketID }}</td>
                                    @elseif($ticket->status == Ticket::STATUS_EXPECTATION)
                                        <td class="badge badge-secondary mt-2">{{ $ticket->ticketID }}</td>
                                    @else
                                        <td class="badge badge-dark mt-2">{{ $ticket->ticketID }}</td>
                                    @endif
                                        <td>{{ $ticket->userID}}</td>
                                    <td>@lang($ticket->type)</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->message }}</td>
                                    <td>@lang($ticket->priority)</td>
                                    <td>{{ $ticket->file }}</td>
                                    <td class="mt-2">{{explode(' ' , jdate($ticket->created_at))[0]}}</td>
                                    <td>
                                        <div class="row">
                                                <a href="{{ route('repairs.edit', $ticket->id) }}"
                                                   class="btn btn-warning ml-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');"
                                                      action="{{ route('repairs.destroy',$ticket->id) }}" method="POST">
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
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
