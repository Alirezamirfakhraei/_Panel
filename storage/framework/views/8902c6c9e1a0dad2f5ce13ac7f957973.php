<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $__env->make('Auth::section.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

        <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>

        <?php echo $__env->make('Auth::section.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </head>
    <body class="authentication-bg">

        <div class="home-btn d-none d-sm-block">
            <a href="<?php echo e(route('panel.index')); ?>"><i class="fas fa-home h2 text-dark"></i></a>
        </div>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>

        <?php echo $__env->make('Auth::section.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </body>
</html>
<?php /**PATH E:\_project\_Panel\Modules\Auth\Providers/../Resources/Views//layouts/master.blade.php ENDPATH**/ ?>