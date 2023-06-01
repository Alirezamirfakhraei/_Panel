@extends('home::layouts.master')

@section('title' , 'صفحه اصلی')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li class="breadcrumb-item 	bcrumb-1">
                                <a href="index.html">
                                    <i class="material-icons">home</i>
                                    خانه</a>
                            </li>
                            <li class="breadcrumb-item active">داشبورد</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Widgets -->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="info-box7 l-bg-green order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">سفارشات دریافت شده</h4>
                            <h2 class="text-right"><i class="fas fa-cart-plus pull-left"></i><span>358</span></h2>
                            <p class="m-b-0">18٪ بالاتر از ماه گذشته</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="info-box7 l-bg-purple order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">سفارشات تکمیل شده</h4>
                            <h2 class="text-right"><i class="fas fa-business-time pull-left"></i><span>865</span></h2>
                            <p class="m-b-0">21٪ بالاتر از ماه گذشته</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="info-box7 l-bg-orange order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">سفارشات جدید</h4>
                            <h2 class="text-right"><i class="fas fa-chart-line pull-left"></i><span>128</span></h2>
                            <p class="m-b-0">37٪ بالاتر از ماه گذشته</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="info-box7 l-bg-cyan order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">مجموع درآمد</h4>
                            <h2 class="text-right"><i class="fas fa-dollar-sign pull-left"></i><span>25698 تومان</span></h2>
                            <p class="m-b-0">20٪ بالاتر از ماه گذشته</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>نمونه</strong> نمودار</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#" onClick="return false;">اقدام</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="return false;">اقدامی دیگر</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="return false;">چیز دیگری اینجا</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="chart1"></div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted font-15 text-truncate">هدف</p>
                                    <h5>
                                        <i class="fas fa-arrow-circle-up col-green m-r-5"></i>15هزار
                                    </h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 text-truncate">هفته گذشته</p>
                                    <h5>
                                        <i class="fas fa-arrow-circle-down col-red m-r-5"></i>2.8هزار
                                    </h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted text-truncate">ماه گذشته</p>
                                    <h5>
                                        <i class="fas fa-arrow-circle-up col-green m-r-5"></i>12.5هزار
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>نمونه</strong> نمودار</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#" onClick="return false;">اقدام</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="return false;">اقدامی دیگر</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="return false;">چیز دیگری اینجا</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="line-chart"></canvas>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted font-15 text-truncate">هدف</p>
                                    <h5>
                                        <i class="fas fa-arrow-circle-down col-red m-r-5"></i>15هزار
                                    </h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 text-truncate">هفته گذشته</p>
                                    <h5>
                                        <i class="fas fa-arrow-circle-up col-green m-r-5"></i>2.8هزار
                                    </h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted text-truncate">ماه گذشته</p>
                                    <h5>
                                        <i class="fas fa-arrow-circle-down col-red m-r-5"></i>12.5هزار
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
