@extends('Panel::layouts.master')

@section('title', 'لیست دسته بندی')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="{{ route('categories.create') }}" class="arrow-none btn btn-primary text-white" aria-expanded="false">
                            ساخت دسته بندی جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی دسته بندی</h4>
                    @if (session()->has('success_message'))
                        <br>
                        <div class="alert alert-success">{{ session()->get('success_message') }}</div>
                    @endif
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>وضعیت</th>
                                    <th>زیر دسته</th>
                                    <th>تاریخ ساخت</th>
                                    <th>تاریخ ساخت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr class="text-center">
                                        <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                        <td class="align-middle">{{ $category->title }}</td>
                                        <td class=" badge badge-primary mt-2">
                                            <span>
                                                @lang($category->status)
                                            </span>
                                        </td>
                                        <td class="align-middle">{{ $category->title }}</td>
                                        <td class="align-middle">{{ $category->title }}</td>
                                        <td class="align-middle">{{ $category->created_at }}</td>
                                        <td class="align-middle">
                                            <div class="row">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form onsubmit="return confirm('آیا مایل ب حذف دسته بندی میباشید؟')" action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
