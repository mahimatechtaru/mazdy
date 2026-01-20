@php
    $default_lang_code = language_const()::NOT_REMOVABLE;
@endphp

<div id="leadership-team-member-add" class="mfp-hide large">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("Add Team Member") }}</h5>
                <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="modal-form" action="{{ setRoute('admin.setup.sections.section.item.store',$slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-10-none">
                        <div class="col-xl-12 col-lg-12 form-group">
                            {{-- FIX: Using the correct component name 'input-file' based on the file list provided. --}}
                            @include('admin.components.form.input-file',[
                                'label' => __("Image"),
                                'name'  => 'image',
                                'class' => 'file-holder',
                                'data_limit' => "1",
                                'data_extension' => "png,jpg,jpeg,webp,svg",
                                'required' => true,
                            ])
                        </div>

                        <div class="col-xl-12 col-lg-12">
                            <div class="product-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @foreach ($languages as $item)
                                            <button class="nav-link @if (get_default_language_code() == $item->code) active @endif" id="modal-{{$item->name}}-tab" data-bs-toggle="tab" data-bs-target="#modal-{{$item->name}}" type="button" role="tab" aria-controls="modal-{{$item->name}}" aria-selected="true">{{ $item->name }}</button>
                                        @endforeach
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    @foreach ($languages as $item)
                                        @php
                                            $lang_code = $item->code;
                                        @endphp

                                        <div class="tab-pane @if (get_default_language_code() == $item->code) fade show active @endif" id="modal-{{ $item->name }}" role="tabpanel" aria-labelledby="modal-{{ $item->name }}-tab">
                                            <div class="form-group">
                                                @include('admin.components.form.input',[
                                                    'label'     => __("Name")."*",
                                                    'name'      => $lang_code . "_name",
                                                    'placeholder'=> __('Name').'...',
                                                    'value'     => old($lang_code . "_name"),
                                                ])
                                            </div>
                                            <div class="form-group">
                                                @include('admin.components.form.input',[
                                                    'label'     => __("Designation/Role")."*",
                                                    'name'      => $lang_code . "_designation",
                                                    'placeholder'=> __('e.g., CEO & Founder, Head of Operations').'...',
                                                    'value'     => old($lang_code . "_designation"),
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
                                'text'          => "Add Member",
                                'permission'    => "admin.setup.sections.section.item.store",
                            ])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
