
@if (admin_permission_by_name("admin.languages.store"))
    <div id="language-add" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add Package") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.package.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-10-none mt-2">
                        
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Package Name'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write Here").'...',
                                'name'          => 'name',
                                'value'         => old('name'),
                                'required'      => true,
                            ])
                        </div>
                        
                        {{-- Plan Type --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            <label>{{ __("Field Types") }}*</label>
                            <select class="form--control nice-select field-input-type" name="plan_type">
                                <option value="text" selected>{{ __("Plan Type") }}</option>
                                <option value="Daily">{{ __("Daily") }}</option>
                                <option value="Weekly">{{ __("Weekly") }}</option>
                                <option value="Monthly">{{ __("Monthly") }}</option>
                                <option value="Post-surgery">{{ __("Post-surgery") }}</option>
                                <option value="Senior Care">{{ __("Senior Care") }}</option>
                            </select>
                        </div>
                        
        
                        {{-- Price --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input', [
                                'label'       => __('Price (₹)'),
                                'label_after' => '*',
                                'placeholder' => __('Enter price').'...',
                                'name'        => 'price',
                                'type'        => 'number',
                                'value'       => old('price'),
                                'required'    => true,
                            ])
                        </div>
        
                        {{-- Duration --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input', [
                                'label'       => __('Duration'),
                                'placeholder' => __('e.g. 30 days'),
                                'name'        => 'duration',
                                'value'       => old('duration'),
                            ])
                        </div>
        
                        {{-- Badge --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input', [
                                'label'       => __('Badge'),
                                'placeholder' => __('e.g. Most Popular'),
                                'name'        => 'badge',
                                'value'       => old('badge'),
                            ])
                        </div>
        
                        {{-- Target Audience --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input', [
                                'label'       => __('Target Audience'),
                                'placeholder' => __('e.g. Ideal for post-operative patients'),
                                'name'        => 'target_audience',
                                'value'       => old('target_audience'),
                            ])
                        </div>
        
                        {{-- Short Description --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('Short Description'),
                                'label_after' => '*',
                                'placeholder' => __('Write Here').'...',
                                'name'        => 'short_description',
                                'value'       => old('short_description'),
                                'required'    => true,
                                'rows'        => 2,
                            ])
                        </div>
        
                        {{-- Detailed Description --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('Detailed Description'),
                                'placeholder' => __('Explain the package details').'...',
                                'name'        => 'description',
                                'value'       => old('description'),
                                'rows'        => 4,
                            ])
                        </div>
        
                        {{-- Inclusions --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('Inclusions'),
                                'placeholder' => __('e.g. Daily nurse visit, Doctor checkup'),
                                'name'        => 'inclusions',
                                'value'       => old('inclusions'),
                                'rows'        => 3,
                            ])
                        </div>
        
                        {{-- Exclusions --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('Exclusions'),
                                'placeholder' => __('Items not covered in the plan'),
                                'name'        => 'exclusions',
                                'value'       => old('exclusions'),
                                'rows'        => 3,
                            ])
                        </div>
        
                        {{-- FAQs --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('FAQs'),
                                'placeholder' => __('Add questions and answers'),
                                'name'        => 'faqs',
                                'value'       => old('faqs'),
                                'rows'        => 3,
                            ])
                        </div>
        
                        {{-- Terms --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('Terms & Conditions'),
                                'placeholder' => __('Specify any terms...'),
                                'name'        => 'terms',
                                'value'       => old('terms'),
                                'rows'        => 3,
                            ])
                        </div>
        
                        {{-- Cancellation Policy --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.textarea', [
                                'label'       => __('Cancellation Policy'),
                                'placeholder' => __('Specify cancellation terms...'),
                                'name'        => 'cancellation_policy',
                                'value'       => old('cancellation_policy'),
                                'rows'        => 3,
                            ])
                        </div>
        
                        {{-- Active Status --}}
                        <div class="col-xl-12 form-group">
                            @include('admin.components.form.switcher',[
                                'label'     => __("Active"),
                                'label_after' => "*",
                                'name'      => "is_active",
                                'options'   => [__('Active') => "1",__('In-active') => "0"],
                                'value'     => old("field_necessity[]","1"),
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