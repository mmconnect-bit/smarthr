{{ Form::open(['route' => 'activities.store', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Activity Name'), ['class' => 'form-label']) }}
                {{ Form::text('name', old('name'), [
                    'class' => 'form-control',
                    'placeholder' => __('Enter Activity Name'),
                    'required',
                    'autofocus'
                ]) }}
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                {{ Form::label('main_activity_id', __('Main Activity'), ['class' => 'form-label']) }}
                {{ Form::select('main_activity_id', $mainActivities, old('main_activity_id'), [
                    'class' => 'form-control',
                    'placeholder' => __('Select Main Activity'),
                    'required'
                ]) }}
                @error('main_activity_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary">{{ __('Create Activity') }}</button>
</div>
{{ Form::close() }}
