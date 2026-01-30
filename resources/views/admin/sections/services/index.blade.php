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
        'active' => __('Languages'),
    ])
@endsection

@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ __($page_title) }}</h5>
                <div class="table-btn-area">
                    @include('admin.components.link.add-default', [
                        'href' => '#language-add',
                        'class' => 'py-2 px-4 modal-btn',
                        'text' => __('Add New'),
                        'permission' => 'admin.services.store',
                    ])

                </div>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($service as $item)
                            <tr data-item="{{ $item }}">
                                <td><b>{{ $item->name }}</b><br>
                                    <!--{{ $item->description }}-->
                                </td>
                                <td>{{ $item->ServicesCategory->name }}</td>
                                <td><img src="{{ asset($item->icon ?? '') }}" width="100" height="100" /></td>
                                <td>

                                    @include('admin.components.link.edit-default', [
                                        'class' => 'edit-modal-button',
                                        'permission' => 'admin.services.update',
                                    ])

                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alerts.empty', ['colspan' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Language Add --}}
    @include('admin.components.modals.services.add')

    {{-- Language Edit --}}
    @include('admin.components.modals.services.edit')
@endsection

@push('script')
    <script>
        $(".delete-modal-button").click(function() {
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));

            var actionRoute = "{{ setRoute('admin.services.delete') }}";
            var target = oldData.id;
            var message = `{{ __('Are you sure to delete this service type?') }}`;

            openDeleteModal(actionRoute, target, message);
        });
        // Switcher
        switcherAjax("{{ setRoute('admin.services.status.update') }}");
    </script>
@endpush
