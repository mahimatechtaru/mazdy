@if (admin_permission_by_name("admin.languages.store"))
    <div id="language-add" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add Services") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.services.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-10-none mt-2">
                        
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Service Name'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write Here").'...',
                                'name'          => 'name',
                                'value'         => old('name'),
                                'required'      => true,
                            ])
                        </div>

                        <div class="col-xl-6 col-lg-6 form-group">
                            <label class="form-label">{{ __('Service Category') }} <span class="text-danger">*</span></label>
                            <select name="category" class="form--control nice-select field-input-type" required>
                                <option value="">{{ __('Select category') }}...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ✅ New Icon Field --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input-file',[
                                'label'         => __('Service Icon'),
                                'label_after'   => '*',
                                'name'          => 'icon',
                                'accept'        => 'image/*',
                                'required'      => true,
                            ])
                        </div>

                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Price'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write Here").'...',
                                'name'          => 'base_price',
                                'value'         => old('base_price'),
                                'required'      => true,
                            ])
                        </div>

                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Description'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write Here").'...',
                                'name'          => 'description',
                                'value'         => old('description'),
                                'required'      => true,
                            ])
                        </div>

                        <div class="col-xl-12 col-lg-12 form-group d-flex align-items-center justify-content-between mt-4">
                            <button type="button" class="btn btn--danger modal-close">{{ __("Cancel") }}</button>
                            <button type="submit" class="btn btn--base">{{ __("Add") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("script")
        <script>
            openModalWhenError("language-add","#language-add");
        </script>
    @endpush
@endif