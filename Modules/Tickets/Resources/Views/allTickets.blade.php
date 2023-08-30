@php use Modules\Tickets\Models\Ticket; @endphp
@extends('Panel::layouts.master')

@section('title', 'لیست تیکت ها')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="mt-0 header-title">لیست تیکت ها </h4>
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
                                <th>متن پیام</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="text-center">
                                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                    @if($ticket->status == Ticket::STATUS_NEW)
                                        <td class="badge badge-success mt-2">{{ $ticket->ticketID }}</td>
                                    @elseif($ticket->status == Ticket::STATUS_EXPECTATION)
                                        <td class="badge badge-secondary mt-2">{{ $ticket->ticketID }}</td>
                                    @else
                                        <td class="badge badge-dark mt-2">{{ $ticket->ticketID }}</td>
                                    @endif
                                    <td class="align-middle">@lang($ticket->priority)</td>
                                    <td class="align-middle">@lang($ticket->type)</td>
                                    <td class="align-middle">{{ $ticket->userID}}</td>
                                    <td class="align-middle">{{ $ticket->subject }}</td>
                                    <td class="align-middle">{{ $ticket->message }}</td>
                                    <td class="align-middle">{{explode(' ' , jdate($ticket->created_at))[0]}}</td>
                                    <td class="align-middle">
                                        <div class="row">
                                            <a href="{{ route('repairs.edit', $ticket->id) }}"
                                               class="btn btn-warning ml-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form onsubmit="return confirm('آیا مایل به تغییر وضعیت تیکیت میباشید؟');"
                                                  action="{{ route('tickets.change.status',$ticket->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-bordred-dark ml-1">
                                                    <i class="fas fa-spinner"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
