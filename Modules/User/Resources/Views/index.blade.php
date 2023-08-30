@extends('Panel::layouts.master')

@section('title', 'لیست کاربران')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="{{route('users.create')}}" class="arrow-none btn btn-primary text-white"
                           aria-expanded="false">
                            افزودن کاربر جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی کاربران</h4>
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
                                <th>اخرین فعالیت</th>
                                <th>مقام ها</th>
                                <th>نام و نام خانوادگی</th>
                                <th>تاریخ عضویت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="text-center">
                                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                    <td class="align-middle">{{ $user->userID }}</td>
                                    <td class="align-middle">{{explode(' ' , $user->sync_at)[0]}}</td>
                                    @if($user->role == 'customer')
                                        <td class="badge badge-blue mt-2"> @lang($user->role) </td>
                                    @elseif($user->role == 'repair')
                                        <td class="badge badge-warning mt-2"> @lang($user->role) </td>
                                    @elseif($user->role == 'worker')
                                        <td class="badge badge-dark mt-2"> @lang($user->role) </td>
                                    @endif
                                    <td class="align-middle">{{ $user->name.' '.$user->lastname}}</td>
                                    <td class="align-middle">{{ explode(' ' , jdate($user->created_at))[0]}}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('users.add.role', $user->id) }}"
                                               class="btn btn-success ml-1">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');" action="{{ route('users.destroy', $user->id) }}" method="POST">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
