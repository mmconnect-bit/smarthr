@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Activities') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Activities') }}</li>
@endsection

@section('action-button')
    @can('Create Branch')
        <a href="#"
           data-url="{{ route('activities.create') }}"
           data-ajax-popup="true"
           data-title="{{ __('Create New Activity') }}"
           class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
<div class="row">
    <div class="col-3">
        @include('layouts.hrm_setup')
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                 <th>{{ __('Main Activity') }}</th>
                                <th>{{ __('Activity Name') }}</th>

                                <th width="150px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                                <tr>
                                     <td>
                                        {{ $activity->activities?->name ?? '-' }}
                                    </td>
                                    <td>{{ $activity->name }}</td>

                                    <td class="Action">
                                        <span class="d-flex gap-2">
                                            @can('Create Branch')
                                                <a href="#"
                                                   class="btn btn-sm btn-info"
                                                   data-url="{{ route('activities.edit', $activity->id) }}"
                                                   data-ajax-popup="true"
                                                   data-title="{{ __('Edit Activity') }}">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                            @endcan

                                            @can('Create Branch')
                                                {!! Form::open(['route' => ['activities.destroy', $activity->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger bs-pass-para"
                                                            data-confirm="Are you sure?|This action cannot be undone."
                                                            data-text="Delete Activity">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                {!! Form::close() !!}
                                            @endcan
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        {{ __('No activities found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
