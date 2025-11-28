<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Activities')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Activities')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Branch')): ?>
        <a href="#"
           data-url="<?php echo e(route('activities.create')); ?>"
           data-ajax-popup="true"
           data-title="<?php echo e(__('Create New Activity')); ?>"
           class="btn btn-sm btn-primary">
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
                                 <th><?php echo e(__('Main Activity')); ?></th>
                                <th><?php echo e(__('Activity Name')); ?></th>

                                <th width="150px"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                     <td>
                                        <?php echo e($activity->activities?->name ?? '-'); ?>

                                    </td>
                                    <td><?php echo e($activity->name); ?></td>

                                    <td class="Action">
                                        <span class="d-flex gap-2">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Branch')): ?>
                                                <a href="#"
                                                   class="btn btn-sm btn-info"
                                                   data-url="<?php echo e(route('activities.edit', $activity->id)); ?>"
                                                   data-ajax-popup="true"
                                                   data-title="<?php echo e(__('Edit Activity')); ?>">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Branch')): ?>
                                                <?php echo Form::open(['route' => ['activities.destroy', $activity->id], 'method' => 'DELETE', 'class' => 'd-inline']); ?>

                                                    <button type="button"
                                                            class="btn btn-sm btn-danger bs-pass-para"
                                                            data-confirm="Are you sure?|This action cannot be undone."
                                                            data-text="Delete Activity">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <?php echo e(__('No activities found.')); ?>

                                    </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mmconnect/Desktop/desktop/my project/SmartHR/irad.smarthr.co.tz/resources/views/activities/index.blade.php ENDPATH**/ ?>