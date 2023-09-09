@extends('Panel::layouts.master')

@section('title', 'افزودن دسته بندی جدید')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">افزودن دسته بندی جدید</h4>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('categories.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="title">عنوان</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" id="title" name="title" placeholder="عنوان دسته بندی را وارد کنید">
                                            @error('title')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="keywords">کلمات کلیدی (اجباری نیست)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('keywords') is-invalid @enderror"
                                            value="{{ old('keywords') }}" id="keywords" name="keywords"
                                            placeholder="کلمات کلیدی دسته بندی را وارد کنید">
                                            @error('keywords')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="status">وضعیت دسته بندی</label>
                                        <div class="col-sm-10">
                                            <x-panel-select name="status">
                                                @foreach (Modules\Category\Models\Category::$statuses as $status)
                                                    <option value="{{ $status }}">@lang($status)</option>
                                                @endforeach
                                            </x-panel-select>
                                            @error('status')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="parentID">زیر دسته (اجباری نیست)</label>
                                        <div class="col-sm-10">
                                            <select class="form-control @error('parentID') is-invalid @enderror" name="parentID">
                                                <option value="" selected>زیر دسته دسته بندی را وارد کنید</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('parentID')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="description">توضیحات (اجباری نیست)</label>
                                        <div class="col-sm-10">
                                            <textarea rows="3" class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description"
                                            placeholder="توضیحات دسته بندی را وارد کنید">{{ old('description') }}</textarea>
                                            @error('description')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="float-right w-25 btn btn-outline-success">ذخیره</button>
{{--                                    <x-panel-button />--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
