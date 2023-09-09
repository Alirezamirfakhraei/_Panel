@php use Modules\Tickets\Models\Ticket; @endphp
@extends('Panel::layouts.master')

@section('title', 'لیست تیکت ها')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right ml-2">
                        <a href="" class="arrow-none btn btn-primary text-white" aria-expanded="false">
                            ثبت تیکت جدید
                        </a>
                    </div>
                    <div class="float-right">
                        <a href="{{route('all.tickets')}}" class="arrow-none btn btn-secondary text-white" aria-expanded="false">
                            لیست کل تیکت ها
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تیکت های جاری </h4>
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
                                <th>اولویت</th>
                                <th>نوع تیکت</th>
                                <th>شماره همراه</th>
                                <th>موضوع پیام</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="text-center">
                                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                    @if($ticket->status == Ticket::STATUS_NEW)
                                    <td class="badge align-middle badge-success mt-2">{{ $ticket->ticketID }}</td>
                                    @elseif($ticket->status == Ticket::STATUS_EXPECTATION)
                                        <td class="badge badge-secondary mt-2">{{ $ticket->ticketID }}</td>
                                    @else
                                        <td class="badge badge-dark mt-2">{{ $ticket->ticketID }}</td>
                                    @endif
                                    <td class="align-middle">@lang($ticket->priority)</td>
                                    <td class="align-middle">@lang($ticket->type)</td>
                                    <td class="align-middle">{{ $ticket->userID}}</td>
                                    <td class="align-middle">{{ $ticket->subject }}</td>
                                    <td class="align-middle">{{explode(' ' , jdate($ticket->created_at))[0]}}</td>
                                    <td class="align-middle">
                                        <div class="row">
                                            <!-- Button trigger modal -->
                                            <div class="d-flex align-items-center justify-content-center" >
                                                <button type="button"  class="btn btn-primary" id="myModal" data-toggle="modal"
                                                        data-target="#myModal{{$ticket->id}}">
                                                    جزئیات تیکت
                                                </button>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade modal-center" id="myModal{{$ticket->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">توضیحات بیشتر</h5>
                                                            <a href="" type="button" class="close" data-dismiss="modal"
                                                               aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group text-left">
                                                                <li class="list-group-item">وضعیت تیکت
                                                                    <span class="float-right badge badge-pink mt-1">@lang($ticket->status)</span>
                                                                </li>
                                                                <li class="list-group-item">اولویت تیکت
                                                                    <span class="float-right badge badge-purple mt-1">@lang($ticket->priority)</span>
                                                                </li>
                                                                <li class="list-group-item " style="color: #d04949">متن پیام
                                                                    <span class="float-right  mt-1"><?= $ticket->message ?></span>
                                                                </li>
                                                             </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-secondary"
                                                               style="color: white" data-dismiss="modal">
                                                                بازگشت
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form onsubmit="return confirm('آیا مایل به تغییر وضعیت تیکیت میباشید؟');"
                                                  action="{{ route('tickets.change.status',$ticket->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-dark ml-1">
                                                    <i class="fas fa-spinner"></i>
                                                </button>
                                            </form>
                                            <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');"
                                                  action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">
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
{{--                        {{ $tickets->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
