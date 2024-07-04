    <div class="left-side-menu">
    <div class="slimscroll-menu">
        <div class="user-box text-center">
            <img src="{{ asset('admin/images/scarpinSupp.png') }}" alt="تصویر کاربر" title=""
            class="rounded-circle img-thumbnail avatar-lg">
            <div class="dropdown">
                <a href="#" class="text-dark h5 mt-2 mb-1 d-block"></a>
            </div>
            <h1 style="font-size: 13px">{{auth()->user()->fullName}}</h1>
        </div>
        @include('Panel::section.side-menu')
        <div class="clearfix"></div>
    </div>
</div>
