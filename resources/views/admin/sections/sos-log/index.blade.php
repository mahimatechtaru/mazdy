@extends('admin.layouts.master')

@push('css')
@endpush

@section('page-title')
    @include('admin.components.page-title', ['title' => __($page_title)])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb', [
        'breadcrumbs' => [
            [
                'name' => __('Dashboard'),
                'url' => setRoute('admin.dashboard'),
            ],
        ],
        'active' => __('Add Money Logs'),
    ])
@endsection

@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ $page_title }}</h5>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Full Name') }}</th>
                            <th>{{ __('Contact') }}</th>
                            <!--<th>{{ __('Phone') }}</th>-->
                            <th>{{ __('Assigned Provider') }}</th>
                            <!--<th>{{ __('Assigned Ambulance') }}</th>-->
                            <th>{{ __('Emergency Details') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Time') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions  as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->fullname }}</td>
                                <td>{{ $item->user->mobile ?? '' }} <br> {{ $item->user->email ?? '' }}</td>
                                <td>Doctor:-<span class="text--info">{{ $item->doctor->fullname ?? 'Not Assigned' }}</span><br>
                                    Ambulance:-<span class="text--info">{{ $item->ambulance->fullname ?? 'Not Assigned' }}</span>
                                    </td>
                                <!--<td><span class="text--info">{{ $item->ambulance->fullname ?? 'Not Assigned' }}</span></td>-->
                                <td>{{ $item->emergency_details }}</td>
                                <td>{{ $item->location_address }}</td>
                                <td>
                                    <span>{{ __($item->status) }}</span>
                                </td>
                                <td>{{ $item->created_at->format('d-m-y h:i:s A') }}</td>
                                <td>
                                        
                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alerts.empty', ['colspan' => 11])
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ get_paginate($transactions) }}
        </div>
    </div>
@endsection

@push('script')
@endpush
