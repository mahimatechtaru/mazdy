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
        'active' => __('User Care'),
    ])
@endsection

@section('content')
<div class="custom-card mt-15">
        <div class="card-header">
            <h6 class="title">{{ __("Information of User") }}</h6>
        </div>
        <div class="card-body">
            <form class="card-form" method="POST" action="{{ setRoute('admin.users.assign_provider',$user->username) }}">
                @csrf
                <div class="row mb-10-none">
                  
                    <div class="col-xl-6 col-lg-6 form-group">
                        <label>{{ __("Ambulance") }}<span>*</span></label>
                        <select name="ambulance_id" class="form--control select2-auto-tokenize" data-placeholder="Select Ambulance">
                            @foreach($ambulance as $ambul)
                                <option value="{{$ambul->user_id}}">{{ $ambul->user->firstname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6 col-lg-6 form-group">
                        
                        <label>{{ __("Doctor") }}</label>
                        
                        <select name="doctor_id" class="form--control select2-auto-tokenize" data-placeholder="Select Doctor">
                            @foreach($doc as $dc)
                                <option value="{{$dc->user_id}}">{{ $dc->user->firstname }}</option>
                            @endforeach
                        </select>
                       
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 form-group mt-4">
                        @include('admin.components.button.form-btn',[
                            'text'          => __("save"),
                            'permission'    => "admin.users.details.update",
                            'class'         => "w-100 btn-loading",
                        ])
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-area mt-4">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ $page_title }}</h5>
            </div>
            <div class="table-responsive">
                <div class="table-area">
                    <div class="table-wrapper">
                        <div class="table-header">
                            <h5 class="title">{{ __("Provider List") }}</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __("Doctor") }}</th>
                                        <th>{{ __("Ambulance") }}</th>
                                        <th>{{ __("Status") }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logs as $key => $item)
                                        <tr>
                                            <td></td>
                                            <td>{{ $item->doctor->firstname }}</td>
                                            <td>{{ $item->ambulance->firstname }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td></td>
                                        </tr>
                                    @empty
                                        @include('admin.components.alerts.empty',['colspan' => 5])
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ get_paginate($logs) }}
    </div>
@endsection

@push('script')

@endpush
