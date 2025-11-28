{{ Form::model($activity, ['route' => ['activities.update', $activity->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Activity Name'), ['class' => 'form-label']) }}
                {{ Form::text('name', null, [
                 'class' => 'form-control',
                'placeholder' => __('Enter Activity Name'),
                'required'
                ]) }}
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
                {{ Form::label('main_activity_id', __('Main Activity'), ['class' => 'form-label']) }}
                {{ Form::select('main_activity_id', $mainActivities, null, [
                    'class' => 'form-control',
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
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <button type="submit" class="btn btn-primary">{{ __('Update Activity') }}</button>
</div>
{{ Form::close() }}
