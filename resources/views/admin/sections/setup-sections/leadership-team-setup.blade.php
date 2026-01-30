@php
    $default_lang_code = language_const()::NOT_REMOVABLE;
    $system_default_lang = get_default_language_code();
    $languages_for_js_use = $languages->toJson();
@endphp

@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-iconpicker.css') }}">
    <style>
        .fileholder {
            min-height: 374px !important;
        }

        .fileholder-files-view-wrp.accept-single-file .fileholder-single-file-view,.fileholder-files-view-wrp.fileholder-perview-single .fileholder-single-file-view{
            height: 330px !important;
        }
    </style>
@endpush

@section('page-title')
    @include('admin.components.page-title',['title' => __("Leadership Team Section")])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("admin.dashboard"),
        ]
    ], 'active' => __("Leadership Team Section")])
@endsection

@section('content')
    <div class="custom-card">
        <div class="card-header">
            <h6 class="title">{{ __("Update Section Content") }}</h6>
        </div>
        <div class="card-body">
            {{-- Section Title and Heading (Multilingual) --}}
            <form class="card-form" action="{{ setRoute('admin.setup.sections.section.update',$slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center mb-10-none">
                    <div class="col-xl-12 col-lg-12">
                        <div class="product-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach ($languages as $item)
                                        <button class="nav-link @if (get_default_language_code() == $item->code) active @endif" id="{{$item->name}}-tab" data-bs-toggle="tab" data-bs-target="#{{$item->name}}" type="button" role="tab" aria-controls="{{ $item->name }}" aria-selected="true">{{ $item->name }}</button>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">

                                @foreach ($languages as $item)
                                    @php
                                        $lang_code = $item->code;
                                    @endphp

                                    <div class="tab-pane @if (get_default_language_code() == $item->code) fade show active @endif" id="{{ $item->name }}" role="tabpanel" aria-labelledby="english-tab">

                                        <div class="form-group">
                                            @include('admin.components.form.input',[
                                                'label'     => __("Section Title")."*",
                                                'name'      => $lang_code . "_title",
                                                'placeholder'=> __('Section Title').'...',
                                                'value'     => old($lang_code . "_title",$data->value->language->$lang_code->title ?? "")
                                            ])
                                        </div>

                                        <div class="form-group">
                                            @include('admin.components.form.input',[
                                                'label'     => __("Heading")."*",
                                                'name'      => $lang_code . "_heading",
                                                'placeholder'=> __('Heading').'...',
                                                'value'     => old($lang_code . "_heading",$data->value->language->$lang_code->heading ?? "")
                                            ])
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 form-group">
                        @include('admin.components.button.form-btn',[
                            'class'         => "w-100 btn-loading",
                            'text'          => "Update",
                            'permission'    => "admin.setup.sections.section.update"
                        ])
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Leadership Team Member Table --}}
    <div class="table-area mt-15">
        <div class="table-wrapper">
            {{-- FIX: Changed header title and button link to be specific to Leadership Team --}}
            <div class="table-header justify-content-end">
                <div class="table-btn-area">
                    <a href="#leadership-team-member-add" class="btn--base modal-btn"><i class="fas fa-plus me-1"></i> {{ __("Add Team Member") }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            {{-- FIX: Changed table headers to be for Team Members --}}
                            <th>{{ __("Image") }}</th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Designation") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data->value->items ?? [] as $key => $item)
                            <tr data-item="{{ json_encode($item) }}">

                                {{-- Display Image, safely accessing 'image' --}}
                                <td>
                                    @include('admin.components.image.table-image',[
                                        // FIX: Use null coalescing operator (??) to prevent "Undefined property: stdClass::$image"
                                        'source' => asset('images/section/'.($item->image ?? "")),
                                        'size' => '50x50'
                                    ])
                                </td>

                                {{-- Display Name --}}
                                <td>{{ $item->language->$system_default_lang->name ?? "" }}</td>

                                {{-- Display Designation --}}
                                <td>{{ $item->language->$system_default_lang->designation ?? "" }}</td>

                                <td>
                                    @include('admin.components.form.switcher',[
                                        'name'          => 'team_status',
                                        'value'         => $item->status,
                                        'options'       => [__('Enable') => 1, __('Disable') => 0],
                                        'onload'        => true,
                                        'data_target'   =>  $item->id,
                                    ])
                                </td>
                                <td>
                                    <button class="btn btn--base edit-modal-button"><i class="las la-pencil-alt"></i></button>
                                    <button class="btn btn--base btn--danger delete-modal-button" ><i class="las la-trash-alt"></i></button>
                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alerts.empty',['colspan' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modals for Leadership Team (These need to exist in the resources/views/admin/components/modals/site-section/leadership-team/ directory) --}}
    @include('admin.components.modals.site-section.leadership-team.add')
    @include('admin.components.modals.site-section.leadership-team.edit')

@endsection

@push('script')

    <script>
        // Modal error opening logic
        openModalWhenError("leadership-team-member-add","#leadership-team-member-add");
        openModalWhenError("leadership-team-member-edit","#leadership-team-member-edit");

        var default_language = "{{ $default_lang_code }}";
        var system_default_language = "{{ $system_default_lang }}";
        var languages = "{{ $languages_for_js_use }}";
        languages       = JSON.parse(languages.replace(/&quot;/g,'"'));

        // Edit Modal Logic for Leadership Team Member
        $(".edit-modal-button").click(function(){
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
            var editModal = $("#leadership-team-member-edit"); // Target the correct Edit Modal ID

            editModal.find("form").first().find("input[name=target]").val(oldData.id);

            // Set default language fields: Name and Designation
            editModal.find("input[name="+default_language+"_name_edit]").val(oldData.language[default_language].name);
            editModal.find("input[name="+default_language+"_designation_edit]").val(oldData.language[default_language].designation);

            // Set multilingual fields: Name and Designation
            $.each(languages,function(index,item) {
                editModal.find("input[name="+item.code+"_name_edit]").val((oldData.language[item.code] == undefined) ? "" : oldData.language[item.code].name);
                editModal.find("input[name="+item.code+"_designation_edit]").val((oldData.language[item.code] == undefined) ? "" : oldData.language[item.code].designation);
            });

            // Set Image Preview
            // Note: We access image directly here as we are parsing oldData from the table row data-item,
            // which should contain the key even if the value is null/empty.
            var image = oldData.image; 
            var imagePath = "{{ asset('images/section') }}/" + image;

            // Assuming your fileholder component uses a .member-image-preview class for displaying the image
            editModal.find(".member-image-preview").css('background-image', 'url(' + imagePath + ')');


            openModalBySelector("#leadership-team-member-edit");
        });


        // Delete Modal Logic
        $(".delete-modal-button").click(function(){
            var oldData     = JSON.parse($(this).parents("tr").attr("data-item"));
            var actionRoute = "{{ setRoute('admin.setup.sections.section.item.delete',$slug)}}";
            var target      = oldData.id;
            var message     = `Are you sure to <strong>delete</strong> this team member?`;

            openDeleteModal(actionRoute,target,message);
        });


    </script>

@endpush
