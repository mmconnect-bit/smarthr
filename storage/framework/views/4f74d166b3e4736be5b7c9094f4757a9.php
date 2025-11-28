<?php echo e(Form::model($mainActivity, ['route' => ['mainActivities.update', $mainActivity->id], 'method' => 'PUT'])); ?>


<div class="modal-body">
    <div class="row">

        <!-- Name -->
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Activity Name')])); ?>

                </div>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Payment Amount -->
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('payment_amount', __('Payment Amount'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::number('payment_amount', null, [
                        'class' => 'form-control',
                        'placeholder' => __('Enter Payment Amount'),
                        'step' => '0.01',
                        'min' => '0'
                    ])); ?>

                </div>
                <?php $__errorArgs = ['payment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Per Day/Month -->
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('is_per_day', __('Payment Frequency'), ['class' => 'form-label'])); ?>


                <div class="form-check form-switch">
                    <?php echo e(Form::checkbox('is_per_day', 1, null, [
                        'class' => 'form-check-input',
                        'id' => 'is_per_day'
                    ])); ?>


                    <?php echo e(Form::label('is_per_day', 'Per Day', ['class' => 'form-check-label'])); ?>


                    <small class="text-muted ms-2">
                        <span id="frequency-text">
                            <?php echo e($mainActivity->is_per_day ? 'Daily' : 'Monthly'); ?>

                        </span>
                    </small>
                </div>

                <?php $__errorArgs = ['is_per_day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
</div>

<?php echo e(Form::close()); ?>


<script>
document.getElementById('is_per_day').addEventListener('change', function() {
    document.getElementById('frequency-text').textContent = this.checked ? 'Daily' : 'Monthly';
});
</script>
<?php /**PATH /home/mmconnect/Desktop/desktop/my project/SmartHR/irad.smarthr.co.tz/resources/views/mainActivities/edit.blade.php ENDPATH**/ ?>