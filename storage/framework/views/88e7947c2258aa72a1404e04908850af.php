<div class="left-side-menu">
    <div class="slimscroll-menu">
        <div class="user-box text-center">
            <img src="<?php echo e(asset('admin/images/scarpinSupp.png')); ?>" alt="تصویر کاربر" title=""
            class="rounded-circle img-thumbnail avatar-lg">
            <div class="dropdown">
                <a href="#" class="text-dark h5 mt-2 mb-1 d-block"></a>
            </div>
            <h1 style="font-size: 13px"><?php echo e(auth()->user()->fullname ?? "admin"); ?></h1>
        </div>
        <?php echo $__env->make('Panel::section.side-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php /**PATH E:\_project\_Panel\Modules\Panel\Providers/../Resources/Views//section/sidebar.blade.php ENDPATH**/ ?>