@if (admin_permission_by_name('admin.languages.update'))
    <div id="language-edit" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __('Edit Services') }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.services.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="target">
                    <div class="row mb-10-none mt-2">

                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input', [
                                'label' => __('Service Name'),
                                'label_after' => '*',
                                'placeholder' => __('Write Here') . '...',
                                'name' => 'name',
                                'value' => old('name'),
                                'required' => true,
                            ])
                        </div>

                        <div class="col-xl-6 col-lg-6 form-group">
                            <label class="form-label">{{ __('Service Category') }} <span
                                    class="text-danger">*</span></label>
                            <select name="category" class="form--control nice-select field-input-type" disabled>
                                <option value="">{{ __('Select category') }}...</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input-file', [
                                'label' => __('Service Icon (optional)'),
                                'name' => 'icon',
                                'accept' => 'image/*',
                                'required' => false,
                            ])
                            <div class="mt-2">
                                <img src="" class="old-icon-preview" alt="Service Icon"
                                    style="width: 60px; height: 60px; display:none; border-radius: 6px;">
                            </div>
                        </div>

                        {{-- <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __('Price'),
                                'label_after'   => '*',
                                'placeholder'   => __("Write Here").'...',
                                'name'          => 'base_price',
                                'value'         => old('base_price'),
                                'required'      => true,
                            ])
                        </div> --}}

                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input', [
                                'label' => __('Description'),
                                'label_after' => '*',
                                'placeholder' => __('Write Here') . '...',
                                'name' => 'description',
                                'value' => old('description'),
                                'required' => true,
                            ])
                        </div>

                        <div
                            class="col-xl-12 col-lg-12 form-group d-flex align-items-center justify-content-between mt-4">
                            <button type="button" class="btn btn--danger modal-close">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn--base">{{ __('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            openModalWhenError("language-edit", "#language-edit");
            $(".edit-modal-button").click(function() {
                var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
                console.log(oldData);
                alert(oldData.category);
                var editModal = $("#language-edit");

                editModal.find("form").first().find("input[name=target]").val(oldData.id);
                editModal.find("input[name=name]").val(oldData.name);
                editModal.find("input[name=base_price]").val(oldData.base_price);
                editModal.find("input[name=description]").val(oldData.description);
                editModal.find("select[name=category]").val(oldData.category);

                var url = oldData.icon;
                var oldData_icon = url.replace(/\/public\//, "/");


                if (oldData.icon) {
                    // Show the old icon preview with full URL
                    editModal.find(".old-icon-preview")
                        .attr("src", "{{ url('/') }}/" + oldData_icon)
                        .show();
                } else {
                    editModal.find(".old-icon-preview").hide();
                }

                refreshSwitchers("#language-edit");
                openModalBySelector("#language-edit");
            });
        </script>
    @endpush
@endif
