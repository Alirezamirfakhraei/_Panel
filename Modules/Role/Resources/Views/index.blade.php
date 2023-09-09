@extends('Panel::layouts.master')

@section('title', 'لیست مقام ها')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="{{ route('roles.create') }}" class="arrow-none btn btn-primary text-white" aria-expanded="false">
                            افزودن مقام جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی مقام ها</h4>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>دسترسی های مقام</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr class="text-center">
                                        <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                        <td class="align-middle">{{ $role->name }}</td>
                                        @foreach ($role->permissions as $permission)
                                        <td  class="align-middle badge badge-primary mt-2 ml-1 mr-1 ">
                                                <span>
                                                    @lang($permission->name)
                                                </span>
                                        </td>
                                        @endforeach
                                        <td class="align-middle">{{ jdate($role->created_at)->format('Y-m-d') }}</td>
                                        <td class="align-middle">
                                            <div class="row">
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
