<?php echo e(Form::open(['route' => 'activities.store', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Activity Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('name', old('name'), [
                    'class' => 'form-control',
                    'placeholder' => __('Enter Activity Name'),
                    'required',
                    'autofocus'
                ])); ?>

                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('main_activity_id', __('Main Activity'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::select('main_activity_id', $mainActivities, old('main_activity_id'), [
                    'class' => 'form-control',
                    'placeholder' => __('Select Main Activity'),
                    'required'
                ])); ?>

                <?php $__errorArgs = ['main_activity_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary"><?php echo e(__('Create Activity')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/mmconnect/Desktop/desktop/my project/SmartHR/irad.smarthr.co.tz/resources/views/activities/create.blade.php ENDPATH**/ ?>