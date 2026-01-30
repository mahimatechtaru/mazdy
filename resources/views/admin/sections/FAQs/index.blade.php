@extends('admin.layouts.master')

@push('css')
    {{-- Add any specific CSS for the FAQ page here --}}
@endpush

@section('page-title')
    {{-- Page title is now "FAQ Items" --}}
    @include('admin.components.page-title',['title' => __("FAQ Items")])
@endsection

@section('breadcrumb')
    {{-- Breadcrumb now reflects the path to FAQ Items --}}
    @include('admin.components.breadcrumb',[
        'breadcrumbs' => [
            [
                'name'  => __("Dashboard"),
                'url'   => setRoute("admin.dashboard"),
            ],
            [
                'name'  => __("FAQ Categories"),
                'url'   => setRoute("admin.faq.category.index"),
            ]
        ], 
        'active' => __("FAQ Items")
    ])
@endsection

@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ __("FAQ Items") }}</h5>
                <div class="table-btn-area">
                    {{-- Add New FAQ Item Button --}}
                    @include('admin.components.link.add-default',[
                        'href'          => "#faq-add",
                        'class'         => "py-2 px-4 modal-btn",
                        'text'          => __("Add New Item"),
                        'permission'    => "admin.faq.item.store", // Updated permission
                    ])
                </div>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>{{ __("Category") }}</th>
                            <th>{{ __("Question") }}</th>
                            <th>{{ __("Answer") }}</th>
                            <th>{{ __("Sort Order") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Assuming $items is passed from FaqController::itemIndex() --}}
                        @forelse ($items as $item)
                            <tr data-item="{{ $item->toJson() }}">
                                {{-- Category --}}
                                <td>{{ $item->category->name ?? 'N/A' }}</td>
                                {{-- Question --}}
                                <td><b>{{ $item->question }}</b></td>
                                {{-- Answer (Truncated for table view) --}}
                                <td>{{ Illuminate\Support\Str::limit($item->answer, 50) }}</td>
                                {{-- Sort Order --}}
                                <td>{{ $item->sort_order }}</td>
                                {{-- Status (is_published) --}}
                                <td>
                                    @include('admin.components.form.switcher',[
                                        'class'     => 'switcher-status',
                                        'value'     => $item->is_published,
                                        'data_target' => $item->id,
                                        'permission'  => "admin.faq.item.status.update", // Updated permission
                                    ])
                                </td>
                                {{-- Action Buttons --}}
                                <td>
                                    {{-- Edit Button --}}
                                    @include('admin.components.link.edit-default',[
                                        'class'         => "edit-modal-button",
                                        'permission'    => "admin.faq.item.update", // Updated permission
                                    ])
                                    
                                    {{-- Delete Button (Using your existing modal structure) --}}
                                    @include('admin.components.link.delete-default',[
                                        'class'         => "delete-modal-button",
                                        'permission'    => "admin.faq.item.delete", // Updated permission
                                    ])
                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alerts.empty',['colspan' => 6])
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- FAQ Add Modal (Blade include) --}}
    {{-- Make sure these paths are correct, or include the HTML directly --}}
    @include('admin.components.modals.FAQs.add')

    {{-- FAQ Edit Modal (Blade include) --}}
    @include('admin.components.modals.FAQs.edit')
    

@endsection

@push('script')
    <script>
        // Delete Modal Logic
        $(".delete-modal-button").click(function() {
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));

            var actionRoute =  "{{ setRoute('admin.faq.item.delete') }}"; // Updated route
            var target      = oldData.id;
            var message     = `{{ __("Are you sure to delete this FAQ item?") }}`; // Updated message

            openDeleteModal(actionRoute,target,message);
        });

        // Status Switcher Logic
        // Uses FaqItem::is_published column
        switcherAjax("{{ setRoute('admin.faq.item.status.update') }}"); // Updated route
    </script>
@endpush