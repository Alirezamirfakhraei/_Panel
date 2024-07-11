<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title"></li>
        <div class="separator">
            <div class="line"></div>
            <h6> پنل مدیریت </h6>
            <div class="line"></div>
        </div>
        <?php if(auth()->check()): ?>
            <?php $__currentLoopData = config('panelConfig.menus'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $submenu = $menu['submenu'] ?? []; // Default to an empty array if 'submenu' is not set
                ?>
                <li class="<?php echo e(is_array($submenu) && count($submenu) ? 'has-submenu' : ''); ?>">
                    <a href="<?php echo e(is_array($submenu) && count($submenu) ? '#' : $menu['url']); ?>" class="<?php echo e(is_array($submenu) && count($submenu) ? 'dropdown-toggle' : ''); ?>" <?php echo e(is_array($submenu) && count($submenu) ? 'data-toggle=dropdown' : ''); ?>>
                        <i class="mdi mdi-<?php echo e($menu['icon']); ?>"></i>
                        <span> <?php echo e($menu['title']); ?> </span>
                        <?php if(is_array($submenu) && count($submenu)): ?>
                            <span class="menu-arrow"></span>
                        <?php endif; ?>
                    </a>
                    <?php if(is_array($submenu) && count($submenu)): ?>
                        <ul class="nav-second-level" aria-expanded="false">
                            <?php $__currentLoopData = $submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li style="display: flex;justify-content: start;align-items: center">
                                    <i class="mdi mdi-<?php echo e($sub['icon']); ?>"></i>
                                    <a href="<?php echo e($sub['url']); ?>"><?php echo e($sub['title']); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
    <div class="separator">
        <div class="version-custom">
            <div class="line"></div>
            <h6>version:1 </h6>
            <div class="line"></div>
        </div>
    </div>
</div>
<?php /**PATH E:\_project\_Panel\Modules\Panel\Providers/../Resources/Views//section/side-menu.blade.php ENDPATH**/ ?>