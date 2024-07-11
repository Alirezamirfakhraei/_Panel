

<?php $__env->startSection('title', 'پنل کاربری'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('Panel::parts.counter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Panel::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\_project\_Panel\Modules\Panel\Providers/../Resources/Views//index.blade.php ENDPATH**/ ?>