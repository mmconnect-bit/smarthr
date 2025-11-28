<?php $__env->startSection('page-title'); ?>
    <?php echo e(__("Manage Main Activities")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__("Home")); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__("Main Activity")); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Branch')): ?>
        <a href="#" data-url="<?php echo e(route('mainActivities.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create new Main Activity')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-3">
        <?php echo $__env->make('layouts.hrm_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Activity Name')); ?></th>
                                <th><?php echo e(__('Payment Amount')); ?></th>
                                <th><?php echo e(__('Frequency')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $mainActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainActivity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($mainActivity->name); ?></td>
                                    <td>
                                        <?php echo e(number_format($mainActivity->payment_amount, 2)); ?>

                                        <small class="text-muted">
                                            <?php echo e($mainActivity->is_per_day ? '/ day' : '/ month'); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <?php if($mainActivity->is_per_day): ?>
                                            <span class="badge bg-warning text-dark">Daily</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Monthly</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="Action">
                                        <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Branch')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center"
                                                        data-url="<?php echo e(route('mainActivities.edit', $mainActivity->id)); ?>"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                        data-title="<?php echo e(__('Edit Activities')); ?>"
                                                        data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Branch')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['mainActivities.delete', $mainActivity->id], 'id' => 'delete-form-' . $mainActivity->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Delete')); ?>"
                                                        aria-label="Delete">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center"><?php echo e(__('No branches found')); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mmconnect/Desktop/desktop/my project/SmartHR/irad.smarthr.co.tz/resources/views/mainActivities/index.blade.php ENDPATH**/ ?>