

<?php $__env->startSection('title', 'لیست کاربران'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="float-right">
                        <a href="<?php echo e(route('users.create')); ?>" class="arrow-none btn btn-primary text-white"
                           aria-expanded="false">
                            افزودن کاربر جدید
                        </a>
                    </div>
                    <h4 class="mt-0 header-title">لیست تمامی کاربران</h4>
                    <?php if(session()->has('success_delete')): ?>
                        <br>
                        <div class="alert alert-success"><?php echo e(session()->get('success_delete')); ?></div>
                    <?php endif; ?>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr class="text-center">
                                <th>ردیف</th>
                                <th>شماره همراه</th>
                                <th>اخرین فعالیت</th>
                                <th>مقام ها</th>
                                <th>نام و نام خانوادگی</th>
                                <th>تاریخ عضویت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-center">
                                    <th class="align-middle" scope="row"><?php echo e($loop->iteration); ?></th>
                                    <td class="align-middle"><?php echo e($user->userID); ?></td>
                                    <td class="align-middle"><?php echo e(explode(' ' , $user->sync_at)[0]); ?></td>
                                    <?php if($user->role == 'customer'): ?>
                                        <td class="badge badge-blue mt-2"> <?php echo app('translator')->get($user->role); ?> </td>
                                    <?php elseif($user->role == 'repair'): ?>
                                        <td class="badge badge-warning mt-2"> <?php echo app('translator')->get($user->role); ?> </td>
                                    <?php elseif($user->role == 'worker'): ?>
                                        <td class="badge badge-dark mt-2"> <?php echo app('translator')->get($user->role); ?> </td>
                                    <?php endif; ?>
                                    <td class="align-middle"><?php echo e($user->name.' '.$user->lastname); ?></td>
                                    <td class="align-middle"><?php echo e(explode(' ' , jdate($user->created_at))[0]); ?></td>
                                    <td>
                                        <div class="row">
                                            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-warning">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form onsubmit="return confirm('آیا مایل به حذف کاربر میباشید؟');" action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger ml-1">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php echo e($users->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Panel::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\_project\_Panel\Modules\User\Providers/../Resources/Views//index.blade.php ENDPATH**/ ?>