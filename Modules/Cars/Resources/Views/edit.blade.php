    @extends('Panel::layouts.master')
<?php
$function = new Functions();
?>
@section('title', 'ویرایش وسیله نقلیه')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">ویرایش وسیله نقلیه</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                @if (count($errors) > 0)
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('cars.update' , $car->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="lastname">شماره همراه </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('userID') is-invalid @enderror"
                                                   value="{{ $car->userID }}" id="userID" name="userID" placeholder="شماره همراه کاربر را وارد کنید">
                                            @error('userID')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="company">کمپانی خودرو</label>
                                        <div class="col-sm-10">
                                            <select class="form-control @error('company') is-invalid @enderror" name="company">
                                                <option value="company" selected>زیردسته بندی را وارد کنید</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('company')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="model">مدل خودرو</label>
                                        <div class="col-sm-10">
                                            <select class="form-control @error('model') is-invalid @enderror" name="model">
                                                <option value="model" selected>مدل را وارد کنید</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('model')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 datepicker col-form-label" for="year">سال ساخت خودرو</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('year') is-invalid @enderror"
                                                   value="{{ $car->year  }}" id="year" name="year" placeholder="سال ساخت خودرو را وارد کنید">
                                            @error('year')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label class="col-sm-2 datepicker col-form-label" for="plate">پلاک خودرو</label>
                                            <div class="col-sm-10">
                                                <?php
                                                    $split = str_split($car->plate);
                                                    $character = $function->truePlateView($car->plate);
                                                    ?>
                                                <label>
                                                    <input type="text" value="{{$car->plate[6].$car->plate[7]}}" name="plate[4]" class="licenseplate" maxlength="2" placeholder="22"/>
                                                    <input type="text" value="{{$car->plate[4].$car->plate[5].$car->plate[6]}}" name="plate[3]" class="licenseplate" maxlength="3" placeholder="222"/>
                                                    <input type="text" value="{{$character}}"                    name="plate[2]" class="licenseplate" maxlength="1" placeholder="ی"/>
                                                    <input type="text" value="{{$car->plate[0].$car->plate[1]}}" name="plate[1]" class="licenseplate" maxlength="2" placeholder="22"/>
                                                </label>
                                                @error('plate')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="third_insurance">بیمه شخص ثالث خودرو</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('third_insurance') is-invalid @enderror"
                                                   value="{{ $car->third_insurance }}" id="third_insurance" name="third_insurance" placeholder="تاریخ بیمه شخص ثالث را وارد کنید">
                                            @error('year')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="chassis_number">شماره شاسی خودرو</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="17" class="form-control @error('chassis_number') is-invalid @enderror"
                                                   value="{{ $car->chassis_number }}" id="chassis_number" name="chassis_number" placeholder="شماره شاسی خودرو را وارد کنید">
                                            @error('chassis_number')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="chassis_number">شماره موتور خودرو</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="17" class="form-control @error('engine_number') is-invalid @enderror"
                                                   value="{{ $car->engine_number }}" id="chassis_number" name="engine_number" placeholder="شماره موتور خودرو را وارد کنید">
                                            @error('engine_number')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="km_current">کیلومتر فعلی خودرو</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('km_current') is-invalid @enderror"
                                                   value="{{ $car->km_current }}" id="km_current" name="km_current" placeholder="کیلومتر فعلی خودرو را وارد کنید">
                                            @error('km_current')
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
