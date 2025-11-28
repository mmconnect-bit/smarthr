@extends('layouts.admin')

@section('page-title')
    {{ __("Manage Main Activities") }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __("Home") }}</a></li>
    <li class="breadcrumb-item">{{ __("Main Activity") }}</li>
@endsection

@section('action-button')
    @can('Create Branch')
        <a href="#" data-url="{{ route('mainActivities.create') }}" data-ajax-popup="true"
            data-title="{{ __('Create new Main Activity') }}" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="{{ __('Create') }}">
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
                                <th>{{__('Activity Name')}}</th>
                                <th>{{__('Payment Amount')}}</th>
                                <th>{{__('Frequency')}}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mainActivities as $mainActivity)
                                <tr>
                                    <td>{{ $mainActivity->name }}</td>
                                    <td>
                                        {{ number_format($mainActivity->payment_amount, 2) }}
                                        <small class="text-muted">
                                            {{ $mainActivity->is_per_day ? '/ day' : '/ month' }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($mainActivity->is_per_day)
                                            <span class="badge bg-warning text-dark">Daily</span>
                                        @else
                                            <span class="badge bg-success">Monthly</span>
                                        @endif
                                    </td>
                                    <td class="Action">
                                        <span>
                                            @can('Edit Branch')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center"
                                                        data-url="{{ route('mainActivities.edit', $mainActivity->id) }}"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                        data-title="{{ __('Edit Activities') }}"
                                                        data-bs-original-title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can('Delete Branch')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['mainActivities.delete', $mainActivity->id], 'id' => 'delete-form-' . $mainActivity->id]) !!}
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="{{ __('Delete') }}"
                                                        aria-label="Delete">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('No branches found') }}</td>
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
