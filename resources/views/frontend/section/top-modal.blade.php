@php
    $app_local = get_default_language_code() ?? 'en';
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FEATURES_SECTION);
    $features = App\Models\Admin\SiteSections::getData($slug)->first();
    $featureItems = $features->value->items ?? [];

    // Convert to plain array (if it's stdClass)
    $featureArray = is_array($featureItems) ? $featureItems : (array) $featureItems;

@endphp

<!-- 🌍 Vendor Selection Popup -->
<div id="vendorModal" class="vendor-modal" style="display: none;">
    <div class="vendor-box">
        <button class="close-btn" id="closevendorModal">✕</button>
        <h2>Join Us as </h2>
        <div class="vendor-grid">
            @foreach ($featureArray as $k => $val)
                @php
                    if (
                        $val->language->$app_local->title == 'Customer' ||
                        $val->language->$app_local->title == 'Hospital'
                    ) {
                        continue;
                    }

                    $link = route('frontend.feature.details', [
                        'id' => $val->id ?? $loop->iteration,
                    ]);

                    if (trim($val->language->$app_local->title) == 'Doctor') {
                        $logo = 'fa-user-md';
                    } elseif (trim($val->language->$app_local->title) == 'Nursing') {
                        $logo = 'fa-user-circle';
                    } elseif (trim($val->language->$app_local->title) == 'Ambulance') {
                        $logo = 'fa-ambulance';
                    } elseif (trim($val->language->$app_local->title) == 'Food Delivery') {
                        $logo = 'fa-bolt';
                    } elseif (trim($val->language->$app_local->title) == 'Lab Tests') {
                        $logo = 'fa-flask';
                    } elseif (trim($val->language->$app_local->title) == 'Pharmacy') {
                        $logo = 'fa-medkit';
                    } elseif (trim($val->language->$app_local->title) == 'Medical Equipment') {
                        $logo = 'fa-stethoscope';
                    } elseif (trim($val->language->$app_local->title) == 'Food Services') {
                        $logo = 'fa-cutlery';
                    } elseif (trim($val->language->$app_local->title) == 'Medical Tourism') {
                        $logo = 'fa-heartbeat';
                    } elseif (trim($val->language->$app_local->title) == 'Last Rites') {
                        $logo = 'fa-solid fa-hands-praying';
                    } else {
                        $logo = 'fa-user-md';
                    }
                    $val->icon = 'fas ' . $logo;

                @endphp
                <div class="vendor-item" data-cat="doctor">
                    <a href="{{ url($link) }}">
                        <i class="{{ $val->icon ?? 'fas fa-user-md' }} fa-3x"></i>
                        <p> {{ ucfirst($val->language->$app_local->title ?? ($val->language->$default->title ?? '')) }}
                        </p>
                    </a>
                </div>
            @endforeach
            {{-- <div class="vendor-item" data-cat="doctor">
                    <a href=""><i class="fas fa-user-md fa-3x"></i>
                        <p>Doctor</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="nurse">
                    <a href=""><i class="fas fa-user-circle fa-3x"></i>
                        <p>Nurse</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="ambulance">
                    <a href=""><i class="fas fa-ambulance fa-3x"></i>
                        <p>Ambulance</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="physiotherapist">
                    <a href=""><i class="fas fa-bolt fa-3x"></i>
                        <p>Physiotherapist</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="lab_diagnostics">
                    <a href=""><i class="fas fa-flask fa-3x"></i>
                        <p>Lab / Diagnostics</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="pharmacy">
                    <a href=""><i class="fas fa-medkit fa-3x"></i>
                        <p>Pharmacy</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="medical_equipment">
                    <a href=""><i class="fas fa-stethoscope fa-3x"></i>
                        <p>Medical Equipment</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="food_services">
                    <a href=""><i class="fas fa-cutlery fa-3x"></i>
                        <p>Food Services</p>
                    </a>
                </div>
                <div class="vendor-item" data-cat="medical_tourism">
                    <a href=""><i class="fas fa-heartbeat fa-3x"></i>
                        <p>Medical Tourism</p>
                    </a>
                </div> --}}
        </div>
    </div>
</div>
<script>
    // JavaScript to handle modal open/close
    // document.getElementById('openVendorModal').addEventListener('click', function() {
    //     document.getElementById('vendorModal').style.display = 'block';
    // });

    document.getElementById('closevendorModal').addEventListener('click', function() {
        document.getElementById('vendorModal').style.display = 'none';
    });

    function open_popup() {
        document.getElementById("vendorModal").style.display = "flex";
    }


    const elements = document.getElementsByClassName('vendor-item');

    for (let i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', function() {
            var category = $(this).data('cat');
            var baseUrl = "{{ url('/') }}";
            var targetUrl = baseUrl + '/join-provider?category=' + category;
            window.location.href = targetUrl;
        });
    }

    // $('.vendor-item').on('click', function() {
    //     var category = $(this).data('cat');
    //     var baseUrl = "{{ url('/') }}";
    //     var targetUrl = baseUrl + '/join-provider?category=' + category;
    //     window.location.href = targetUrl;
    // });
</script>
