<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-4">تعداد کاربران</h4>
            <div class="widget-chart-1">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050"
                           data-bgColor="#F9B9B9" value="{{$panelRepo->user_count()}}"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1 text-right">
                    <h2 class="font-weight-normal pt-2 mb-1"> {{ $panelRepo->user_count() }} </h2>
                    <p class="text-muted mb-1">کاربر</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-4">تعداد خودورها</h4>
            <div class="widget-chart-1">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050"
                           data-bgColor="#F9B9B9" value="{{ $panelRepo->car_count() }}"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1 text-right">
                    <h2 class="font-weight-normal pt-2 mb-1"> {{ $panelRepo->car_count() }} </h2>
                    <p class="text-muted mb-1">خودرو</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-4">تعداد تعمیرکاران</h4>
            <div class="widget-chart-1">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050"
                           data-bgColor="#F9B9B9" value="{{ $panelRepo->user_count() }}"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1 text-right">
                    <h2 class="font-weight-normal pt-2 mb-1"> {{ $panelRepo->repair_count() }} </h2>
                    <p class="text-muted mb-1">تعمیرگاه</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-4">تعداد دسته بندی ها</h4>
            <div class="widget-chart-1">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050"
                           data-bgColor="#F9B9B9" value="{{ $panelRepo->cat_count() }}"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1 text-right">
                    <h2 class="font-weight-normal pt-2 mb-1"> {{ $panelRepo->cat_count() }} </h2>
                    <p class="text-muted mb-1">دسته بندی</p>
                </div>
            </div>
        </div>
    </div>
</div>
