@extends('home::layouts.errors')

@section('title' , 'صفحه اصلی')

@section('content')
    <body>
    <!-- Error Page -->
    <div class="error">
        <div class="container-floud">
            <div class="col-xs-12 ground-color text-center">
                <div class="container-error-404">
                    <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                    <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                    <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                    <div class="msg">OH<span class="triangle"></span></div>
                </div>
                <h2 class="h1">متاسفیم ! صفحه ی درخواستی شما پیدا نشد</h2>
                <a href="<?= url('admin') ?>" class="h1">داشبود</a>
            </div>
        </div>
    </div>
    <!-- Error Page -->
    </body>
@endsection
