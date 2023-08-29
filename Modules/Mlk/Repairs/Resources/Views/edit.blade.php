@extends('Panel::layouts.master')

@section('title', 'ویرایش تعمیرکار ')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">ویرایش تعمیرکار </h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ route('repairs.update', $repair->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $repair->id }}">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="userID">شماره همراه</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->userID  }}"
                                                   class="form-control @error('userID') is-invalid @enderror"
                                                   id="userID" name="userID"
                                                   placeholder="شماره همراه کاربر را وارد کنید">
                                            @error('userID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="telephone">شماره تماس همراه</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->telephone  }}"
                                                   class="form-control @error('telephone') is-invalid @enderror"
                                                   id="telephone" name="telephone"
                                                   placeholder="شماره تماس کاربر را وارد کنید">
                                            @error('telephone')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="name">نام</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->name  }}"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name"
                                                   placeholder="نام را وارد کنید">
                                            @error('name')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="lastname">نام خانوادگی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->lastname  }}"
                                                   class="form-control @error('lastname') is-invalid @enderror"
                                                   id="lastname" name="lastname"
                                                   placeholder="نام خانوداگی را وارد کنید">
                                            @error('lastname')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="lastname">کدملی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->national_code  }}"
                                                   class="form-control @error('national_code') is-invalid @enderror"
                                                   id="national_code" name="national_code"
                                                   placeholder="کدملی را وارد کنید">
                                            @error('national_code')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="bcNumber">شماره شناسنامه</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->bcNumber  }}"
                                                   class="form-control @error('bcNumber') is-invalid @enderror"
                                                   id="bcNumber" name="bcNumber"
                                                   placeholder="شماره شناسنامه را وارد کنید">
                                            @error('bcNumber')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="repairID">شماره صنفی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->repairID}}"
                                                   class="form-control @error('repairID') is-invalid @enderror"
                                                   id="repairID" name="repairID"
                                                   placeholder="شماره صنفی را وارد کنید">
                                            @error('repairID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="submit_plate">پلاک ثبتی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->submit_plate}}"
                                                   class="form-control @error('submit_plate') is-invalid @enderror"
                                                   id="submit_plate" name="submit_plate"
                                                   placeholder="پلاک ثبتی را وارد کنید">
                                            @error('repairID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="address">آدرس</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->address}}"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   id="address" name="address"
                                                   placeholder="آدرس را وارد کنید">
                                            @error('address')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="postal_code">کدپستی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->postal_code}}"
                                                   class="form-control @error('postal_code') is-invalid @enderror"
                                                   id="postal_code" name="postal_code"
                                                   placeholder="کد پستی را وارد کنید">
                                            @error('postal_code')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="repairShop">نام تعمیر گاه</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->repairShop}}"
                                                   class="form-control @error('repairShop') is-invalid @enderror"
                                                   id="repairShop" name="repairShop"
                                                   placeholder="نام تعمیرگاه را وارد کنید">
                                            @error('repairShop')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="issue_date">تاریخ صدور</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->issue_date}}"
                                                   class="form-control @error('issue_date') is-invalid @enderror"
                                                   id="issue_date" name="issue_date"
                                                   placeholder="تاریخ صدور را وارد کنید">
                                            @error('issue_date')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="expiration_date">تاریخ
                                            انقضاء</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->expiration_date}}"
                                                   class="form-control @error('expiration_date') is-invalid @enderror"
                                                   id="expiration_date" name="expiration_date"
                                                   placeholder="تاریخ انقضاء را وارد کنید">
                                            @error('expiration_date')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="steward">مباشر</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->steward}}"
                                                   class="form-control @error('steward') is-invalid @enderror"
                                                   id="steward" name="steward"
                                                   placeholder="مباشر را وارد کنید">
                                            @error('steward')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="fatherName">نام پدر</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->fatherName}}"
                                                   class="form-control @error('fatherName') is-invalid @enderror"
                                                   id="fatherName" name="fatherName"
                                                   placeholder="نام پدر را وارد کنید">
                                            @error('fatherName')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="date_of_birth">تاریخ تولد</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->date_of_birth}}"
                                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                                   id="date_of_birth" name="date_of_birth"
                                                   placeholder="تاریخ تولد را وارد کنید">
                                            @error('date_of_birth')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="blue_plate">پلاک آبی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->blue_plate}}"
                                                   class="form-control @error('blue_plate') is-invalid @enderror"
                                                   id="blue_plate" name="blue_plate"
                                                   placeholder=" پلاک آبی را وارد کنید">
                                            @error('blue_plate')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="submit_plate">پلاک ثبتی</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->submit_plate}}"
                                                   class="form-control @error('submit_plate') is-invalid @enderror"
                                                   id="submit_plate" name="submit_plate"
                                                   placeholder=" پلاک ثبتی را وارد کنید">
                                            @error('submit_plate')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="type_of_person">نوع شخص</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->type_of_person}}"
                                                   class="form-control @error('type_of_person') is-invalid @enderror"
                                                   id="type_of_person" name="type_of_person"
                                                   placeholder="نوع شخص را وارد کنید">
                                            @error('submit_plate')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="type_of_activity">نوع فعالیت</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->type_of_activity}}"
                                                   class="form-control @error('type_of_activity') is-invalid @enderror"
                                                   id="type_of_activity" name="type_of_activity"
                                                   placeholder="نوع فعالیت را وارد کنید">
                                            @error('type_of_activity')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="union_degree">درجه اتحادیه</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->union_degree}}"
                                                   class="form-control @error('union_degree') is-invalid @enderror"
                                                   id="union_degree" name="union_degree"
                                                   placeholder="درجه اتحادیه را وارد کنید">
                                            @error('union_degree')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="isIc_code">کد آیسیک</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $repair->isIc_code}}"
                                                   class="form-control @error('isIc_code') is-invalid @enderror"
                                                   id="isIc_code" name="isIc_code"
                                                   placeholder="کد آیسیک را وارد کنید">
                                            @error('isIc_code')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-success">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
