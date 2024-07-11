<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>

        <?php echo $__env->make('Panel::section.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </head>
    <body>
        <div id="wrapper">
            <?php echo $__env->make('Panel::section.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
            <?php echo $__env->make('Panel::section.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
            <div class="content-page">
                <div class="content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <?php echo $__env->make('Panel::section.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
        <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </body>
</html>
<?php /**PATH E:\_project\_Panel\Modules\Panel\Providers/../Resources/Views//layouts/master.blade.php ENDPATH**/ ?>