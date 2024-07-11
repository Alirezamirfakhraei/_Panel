<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>

                    <span class="badge badge-danger rounded-circle noti-icon-badge"></span>

            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-right">
                            <a href="<?php echo e(route('mark.notifications')); ?>" class="text-dark">
                                <small>پاک کردن همه</small>
                            </a>
                        </span>اطلاعیه ها
                    </h5>
                </div>
                <div class="slimscroll noti-scroll">



                            <a href="" target="_blank" class="dropdown-item notify-item active">
                                <div class="notify-icon">
                                    <img src="<?php echo e(asset('admin/images/scarpinSupp.png')); ?>" class="img-fluid rounded-circle" alt="تصویر" />
                                </div>
                                <p class="notify-details"></p>
                                <p class="text-muted mb-0 user-msg">
                                    <small></small>
                                </p>
                            </a>


                        <p>هیچ اعلانی وجود ندارد</p>

                </div>
            </div>
        </li>
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <img src="<?php echo e(asset('admin/images/scarpinSupp.png')); ?>" alt="تصویر کاربر" class="rounded-circle">
                <span class="pro-user-name ml-1">
                     <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">خوش اومدی!</h6>
                </div>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>حساب کاربری</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>قفل کردن صفحه</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('auth.logout')); ?>" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>خروج</span>
                </a>
            </div>
        </li>
    </ul>
    <div class="logo-box">
        <a href="<?php echo e(route('panel.index')); ?>" class="logo text-center">
            <span class="logo-sm">
                <img src="<?php echo e(asset('admin/images/logo-sm.png')); ?>" alt="تصویر" height="24">
            </span>
        </a>
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>
</div>
<?php /**PATH E:\_project\_Panel\Modules\Panel\Providers/../Resources/Views//section/navbar.blade.php ENDPATH**/ ?>