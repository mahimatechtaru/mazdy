@if (admin_permission_by_name("admin.languages.update"))
    <div id="language-edit" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Edit Package") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.package.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="target">
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
                            <button type="submit" class="btn btn--base">{{ __("Update") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("script")
        <script>
            openModalWhenError("language-edit","#language-edit");
            $(".edit-modal-button").click(function(){
                var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
                var editModal = $("#language-edit");

                editModal.find("form").first().find("input[name=target]").val(oldData.id);
                // editModal.find("input[name=name]").val(oldData.name);
                // Basic inputs
                editModal.find("input[name=name]").val(oldData.name);
                editModal.find("input[name=price]").val(oldData.price);
                editModal.find("input[name=duration]").val(oldData.duration);
                editModal.find("input[name=badge]").val(oldData.badge);
                editModal.find("input[name=target_audience]").val(oldData.target_audience);
        
                // Select field
                editModal.find("select[name=plan_type]").val(oldData.plan_type).niceSelect('update');
        
                // Textareas
                editModal.find("textarea[name=short_description]").val(oldData.short_description);
                editModal.find("textarea[name=description]").val(oldData.description);
                editModal.find("textarea[name=inclusions]").val(oldData.inclusions);
                editModal.find("textarea[name=exclusions]").val(oldData.exclusions);
                editModal.find("textarea[name=faqs]").val(oldData.faqs);
                editModal.find("textarea[name=terms]").val(oldData.terms);
                editModal.find("textarea[name=cancellation_policy]").val(oldData.cancellation_policy);
        
                // Switcher
                if (oldData.is_active == 1) {
                    editModal.find("input[name=is_active][value='1']").prop("checked", true);
                } else {
                    editModal.find("input[name=is_active][value='0']").prop("checked", true);
                }
                 
                
                refreshSwitchers("#language-edit");
                openModalBySelector("#language-edit");
            });
        </script>
    @endpush
@endif