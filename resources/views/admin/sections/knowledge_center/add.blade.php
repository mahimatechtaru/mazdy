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
        'active' => __('Knowledge Center'),
    ])
@endsection
@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <form method="POST" action="{{ route('admin.knowledge_center.messages.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="table-header">
                    <h5 class="title">Add New</h5>
                </div>
                <div class="table-responsive">

                    <input type="hidden" name="target" value="{{ old('target') }}">
                    <div class="row mb-10-none">
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input', [
                                'label' => __('Title'),
                                'label_after' => '*',
                                'name' => 'title',
                                'data_limit' => 150,
                                'placeholder' => __('Write Here') . '...',
                                'value' => old('title'),
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input-file', [
                                'label' => __('Document'),
                                'label_after' => '*',
                                'name' => 'doc',
                                'value' => old('doc'),
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.button.form-btn', [
                                'class' => 'w-100 btn-loading',
                                'type' => 'submit',
                                'text' => __('Save'),
                            ])
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
