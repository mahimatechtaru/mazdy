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
            <form method="POST" action="{{ setRoute('admin.knowledge_center.messages.delete.all') }}">
                @csrf
                <div class="table-header">
                    <h5 class="title">{{ __($page_title) }} <span
                            class="badge badge--success">{{ $knowledge_center->total() }}</span> </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ setRoute('admin.knowledge_center.messages.add') }}"
                            class="btn--base bg--success">{{ __('Add New') }}</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form--control mark-all-checkbox"
                                        data-parent=".mark-all-parent" data-child=".mark-all-child">
                                </th>
                                <th></th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Document') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="mark-all-parent">
                            @forelse ($knowledge_center ?? [] as $key => $item)
                                <tr data-item="{{ json_encode($item->only(['id', 'title', 'doc', 'created_at'])) }}">
                                    <td>
                                        <input type="checkbox" value="{{ $item->id }}" name="mark[]"
                                            class="form--control mark-all-child">
                                    </td>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->title ?? '' }}</td>
                                    <td>{{ $item->doc ?? '' }}</td>

                                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>

                                        @include('admin.components.link.custom', [
                                            'href' => 'javascript:void(0)',
                                            'class' => 'btn btn--base bg--danger delete-button',
                                            'icon' => 'las la-trash',
                                            'permission' => 'admin.knowledge_center.messages.delete',
                                        ])
                                    </td>
                                </tr>
                            @empty
                                @include('admin.components.alerts.empty', ['colspan' => 7])
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </form>
        </div>
        {{ get_paginate($knowledge_center) }}
    </div>
@endsection

@push('script')
    <script>
        $(".delete-button").click(function() {
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));

            var actionRoute = "{{ setRoute('admin.knowledge_center.messages.delete') }}";
            var target = oldData.id;
            var message = `{{ __('Are you sure to delete this message?') }}`;

            openDeleteModal(actionRoute, target, message);
        });

        function openDeleteModal(URL, target, message, actionBtnText = "{{ __('Remove') }}", method = "DELETE") {
            if (URL == "" || target == "") {
                return false;
            }

            if (message == "") {
                message = "{{ __('Are you sure to delete ?') }}";
            }
            var method = `<input type="hidden" name="_method" value="${method}">`;
            openModalByContent({
                    content: `<div class="card modal-alert border-0">
                                <div class="card-body">
                                    <form method="POST" action="${URL}">
                                        <input type="hidden" name="_token" value="${laravelCsrf()}">
                                        ${method}
                                        <div class="head mb-3">
                                            ${message}
                                            <input type="hidden" name="target" value="${target}">
                                        </div>
                                        <div class="foot d-flex align-items-center justify-content-between">
                                            <button type="button" class="modal-close btn btn--info">{{ __('Close') }}</button>
                                            <button type="submit" class="alert-submit-btn btn btn--danger btn-loading">${actionBtnText}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>`,
                },

            );
        }
        $(".mark-all-checkbox").change(function() {

            let parentEl = $($(this).attr("data-parent"));
            let childEl = $(parentEl).find($(this).attr("data-child"));

            if ($(this).is(":checked")) {
                $.each(childEl, function(index, item) {
                    $(item).prop("checked", true);
                });
            } else {
                $.each(childEl, function(index, item) {
                    $(item).prop("checked", false);
                });
            }
        });
    </script>
@endpush
