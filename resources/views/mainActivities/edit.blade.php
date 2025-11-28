{{ Form::model($mainActivity, ['route' => ['mainActivities.update', $mainActivity->id], 'method' => 'PUT']) }}

<div class="modal-body">
    <div class="row">

        <!-- Name -->
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Activity Name')]) }}
                </div>
                @error('name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Payment Amount -->
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('payment_amount', __('Payment Amount'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::number('payment_amount', null, [
                        'class' => 'form-control',
                        'placeholder' => __('Enter Payment Amount'),
                        'step' => '0.01',
                        'min' => '0'
                    ]) }}
                </div>
                @error('payment_amount')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Per Day/Month -->
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('is_per_day', __('Payment Frequency'), ['class' => 'form-label']) }}

                <div class="form-check form-switch">
                    {{ Form::checkbox('is_per_day', 1, null, [
                        'class' => 'form-check-input',
                        'id' => 'is_per_day'
                    ]) }}

                    {{ Form::label('is_per_day', 'Per Day', ['class' => 'form-check-label']) }}

                    <small class="text-muted ms-2">
                        <span id="frequency-text">
                            {{ $mainActivity->is_per_day ? 'Daily' : 'Monthly' }}
                        </span>
                    </small>
                </div>

                @error('is_per_day')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
</div>

{{ Form::close() }}

<script>
document.getElementById('is_per_day').addEventListener('change', function() {
    document.getElementById('frequency-text').textContent = this.checked ? 'Daily' : 'Monthly';
});
</script>
