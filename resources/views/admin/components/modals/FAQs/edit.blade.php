@if (admin_permission_by_name("admin.faq.item.update"))
    <div id="faq-edit" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Edit FAQ Item") }}</h5>
            </div>
            <div class="modal-form-data">
                {{-- Note: Update route should accept item ID --}}
                <form class="modal-form" method="POST" action="{{ setRoute('admin.faq.item.update') }}">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="target"> {{-- Hidden field to hold the FAQ item ID --}}
                    
                    <div class="row mb-10-none mt-2">

                        {{-- 1. FAQ Category Selector --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            <label class="form-label">{{ __('FAQ Category') }} <span class="text-danger">*</span></label>
                            <select name="category_id" class="form--control nice-select field-input-type"  required>
                                <option value="">{{ __('Select Category') }}...</option>
                                @foreach($categories as $category)
                                    {{-- Selected state will be set via JavaScript --}}
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 2. Question Field --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Question'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write the question").'...',
                                'name'          => 'question',
                                'value'         => old('question'),
                                'required'      => true,
                            ])
                        </div>

                        {{-- 3. Answer Field (Textarea) --}}
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.textarea',[
                                'label'         => __('Answer'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write the detailed answer").'...',
                                'name'          => 'answer',
                                'value'         => old('answer'),
                                'required'      => true,
                            ])
                        </div>

                        {{-- 4. Sort Order Field --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Sort Order'),
                                'placeholder'   => __("1, 2, 3... (optional)"),
                                'name'          => 'sort_order',
                                'type'          => 'number',
                                'value'         => old('sort_order'),
                            ])
                        </div>

                        {{-- 5. Is Published Switch --}}
                        
                         <div class="col-xl-6 col-lg-6 form-group">
                            <label class="form-label">{{ __('Publish') }}</label>
                            @include('admin.components.form.switcher', [
                                'name'          => 'is_published',
                                'value'         => old('is_published', 1), // Default to 1 (checked)
                                'options'       => ['ON' => 1, 'OFF' => 0],
                                'permission'    => 'admin.faq.item.status.update',
                            ])
                        
                        </div>

                        {{-- Submit and Cancel Buttons --}}
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
            openModalWhenError("faq-edit","#faq-edit");
            
            // Edit Modal Logic (Updated to handle FAQ Item fields)
            $(".edit-modal-button").click(function(){
                var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
                var editModal = $("#faq-edit");

                editModal.find("form").first().attr("action", "{{ setRoute('admin.faq.item.update') }}" + "/" + oldData.id); // Dynamic route update if needed, but 'target' is safer
                editModal.find("form").first().find("input[name=target]").val(oldData.id); // Hidden ID

                editModal.find("input[name=question]").val(oldData.question);
                editModal.find("textarea[name=answer]").val(oldData.answer); // Changed from input to textarea
                editModal.find("select[name=category_id]").val(oldData.category_id); // Selected category
                editModal.find("input[name=sort_order]").val(oldData.sort_order); // Sort order

                // Set Publish Switch status
                if(oldData.is_published == 1) {
                    editModal.find("input[name=is_published]").prop('checked', true);
                } else {
                    editModal.find("input[name=is_published]").prop('checked', false);
                }

                // If using a custom switch component, you might need:
                // refreshSwitchers("#faq-edit"); 

                openModalBySelector("#faq-edit");
            });
        </script>
    @endpush
@endif