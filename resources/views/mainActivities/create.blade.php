{{ Form::open(['url' => route('mainActivities.store'), 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => __('Enter Activity Name')]) }}
                </div>
                @error('name')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Payment Amount Field -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('payment_amount', __('Payment Amount'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::number('payment_amount', old('payment_amount'), ['class' => 'form-control', 'placeholder' => __('Enter Payment Amount'), 'step' => '0.01', 'min' => '0']) }}
                </div>
                @error('payment_amount')
                    <span class="invalid-payment" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Per Day/Month Field -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('is_per_day', __('Payment Frequency'), ['class' => 'form-label']) }}
                <div class="form-check form-switch">
                    {{ Form::checkbox('is_per_day', 1, old('is_per_day', false), ['class' => 'form-check-input', 'id' => 'is_per_day']) }}
                    {{ Form::label('is_per_day', 'Per Day', ['class' => 'form-check-label', 'for' => 'is_per_day']) }}
                    <small class="text-muted ms-2">
                        <span id="frequency-text">Monthly</span>
                    </small>
                </div>
                @error('is_per_day')
                    <span class="invalid-frequency" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>
{{ Form::close() }}

<script>
document.getElementById('is_per_day').addEventListener('change', function() {
    const frequencyText = document.getElementById('frequency-text');
    frequencyText.textContent = this.checked ? 'Daily' : 'Monthly';
});
</script>
