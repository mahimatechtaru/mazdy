@if (admin_permission_by_name("admin.faq.item.store"))
    <div id="faq-add" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add FAQ Item") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.faq.store') }}">
                    @csrf
                    <div class="row mb-10-none mt-2">
                        
                        {{-- 1. FAQ Category Selector --}}
                        <div class="col-xl-6 col-lg-6 form-group">
                            <label class="form-label">{{ __('FAQ Category') }} <span class="text-danger">*</span></label>
                            <select name="category_id"class="form--control nice-select field-input-type" required>
                                <option value="">{{ __('Select Category') }}...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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

                        {{-- 5. Is Published Switch (Optional: Use your custom component) --}}
                      <div class="col-xl-6 col-lg-6 form-group">
                        <label class="form-label">{{ __('Publish') }}</label>
                        @include('admin.components.form.switcher', [
                            'name'          => 'is_published',
                            'value'         => old('is_published', 1), // Default to 1 (checked)
                            'options'       => ['ON' => 1, 'OFF' => 0], // ON=1, OFF=0 के लिए विकल्प
                            'permission'    => 'admin.faq.item.status.update',
                        ])
                    
                    </div>

                        {{-- Submit and Cancel Buttons --}}
                        <div class="col-xl-12 col-lg-12 form-group d-flex align-items-center justify-content-between mt-4">
                            <button type="button" class="btn btn--danger modal-close">{{ __("Cancel") }}</button>
                            <button type="submit" class="btn btn--base">{{ __("Add Item") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("script")
        <script>
            openModalWhenError("faq-add","#faq-add");
        </script>
    @endpush
@endif