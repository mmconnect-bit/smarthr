<?php echo e(Form::open(['url' => route('mainActivities.store'), 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => __('Enter Activity Name')])); ?>

                </div>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Payment Amount Field -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('payment_amount', __('Payment Amount'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::number('payment_amount', old('payment_amount'), ['class' => 'form-control', 'placeholder' => __('Enter Payment Amount'), 'step' => '0.01', 'min' => '0'])); ?>

                </div>
                <?php $__errorArgs = ['payment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-payment" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Per Day/Month Field -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('is_per_day', __('Payment Frequency'), ['class' => 'form-label'])); ?>

                <div class="form-check form-switch">
                    <?php echo e(Form::checkbox('is_per_day', 1, old('is_per_day', false), ['class' => 'form-check-input', 'id' => 'is_per_day'])); ?>

                    <?php echo e(Form::label('is_per_day', 'Per Day', ['class' => 'form-check-label', 'for' => 'is_per_day'])); ?>

                    <small class="text-muted ms-2">
                        <span id="frequency-text">Monthly</span>
                    </small>
                </div>
                <?php $__errorArgs = ['is_per_day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-frequency" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>


<script>
document.getElementById('is_per_day').addEventListener('change', function() {
    const frequencyText = document.getElementById('frequency-text');
    frequencyText.textContent = this.checked ? 'Daily' : 'Monthly';
});
</script>
<?php /**PATH /home/mmconnect/Desktop/desktop/my project/SmartHR/irad.smarthr.co.tz/resources/views/mainActivities/create.blade.php ENDPATH**/ ?>