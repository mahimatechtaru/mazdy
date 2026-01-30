@extends('hospital.layouts.master')

@section('breadcrumb')
    @include('hospital.components.breadcrumb', [
        'breadcrumbs' => [
            [
                'name' => __('Dashboard'),
                'url' => setRoute('hospitals.dashboard'),
            ],
        ],
    ])
@endsection
<style>
    #map {
        height: 650px;
        width: 100%;
    }
</style>

@section('content')
    <div class="dashboard-card-area pt-3">
        <div class="row mb-20-none">
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Hospital Wallets') }}</span>
                        <h4 class="sub-title text--base">{{ get_amount($hospital_wallet->balance ?? '0') }}
                            <span>{{ get_default_currency_code() }}</span>
                        </h4>
                    </div>
                    <div class="card-icon">
                        <i class="las la-dollar-sign"></i>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Hospital Offline Wallets') }}</span>
                        <h4 class="sub-title text--base">{{ get_amount($hospital_offline_wallet->balance ?? '0') }}
                            <span>{{ get_default_currency_code() }}</span>
                        </h4>
                    </div>
                    <div class="card-icon">
                        <i class="las la-dollar-sign"></i>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Total Branch') }}</span>
                        <h4 class="sub-title text--base">{{ $total_branch }}</h4>
                    </div>
                    <div class="card-icon">
                        <i class="menu-icon las la-history"></i>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Total Doctors') }}</span>
                        <h4 class="sub-title text--base">{{ $total_doctor }}</h4>
                    </div>
                    <div class="card-icon">
                        <i class="las la-cloud-upload-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Total Departments') }}</span>
                        <h4 class="sub-title text--base">{{ $total_departments }}</h4>
                    </div>
                    <div class="card-icon">
                        <i class="menu-icon las la-history"></i>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Total Service Booking') }}</span>
                        <h4 class="sub-title text--base">{{ $total_service_booking }}</h4>
                    </div>
                    <div class="card-icon">
                        <i class="menu-icon las la-history"></i>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-20">
                <div class="dasboard-card-item bg-overlay  bg_img"
                    data-background="{{ asset('public/frontend/images/element/card-bg.webp') }}"
                    style="background-image: url('{{ asset('public/frontend/images/element/card-bg.webp') }}');">
                    <div class="card-title">
                        <span class="title">{{ __('Total Service') }}</span>
                        <h4 class="sub-title text--base">{{ $total_service }}</h4>
                    </div>
                    <div class="card-icon">
                        <i class="menu-icon las la-history"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="map"></div>

    <input type="hidden" id="lat" name="lat">
    <input type="hidden" id="lng" name="lng">
    <input type="hidden" id="radius" name="radius">

    <div class="chart-container pt-5">
        <div class="chart-main" id="chart" class="chart"
            data-chart_one_data="{{ json_encode($data['chart_one_data']) }}"
            data-month_day="{{ json_encode($data['month_day']) }}">
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Retrieve the chart container and data
        const currentYear = new Date().getFullYear();
        var chart1 = $('#chart');
        var chart_one_data = chart1.data('chart_one_data'); // Get the data passed to the chart
        var month_day = chart1.data('month_day'); // Get the month_day data

        var formattedDates = month_day.map(date => {
            let d = new Date(date);
            return d.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            }).replace(',', '');
        });


        var options = {
            series: [{
                name: 'Completed Transactions',
                color: "#637DFE",
                data: chart_one_data.complete_data // Use the correct key
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10
                },
            },
            xaxis: {

                type: 'categories', // Use categories instead of datetime
                categories: formattedDates,
            },
            legend: {
                position: 'bottom',
                offsetX: 40
            },
            title: {
                text: `Monthly Transactions, ${currentYear}`,
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#FFFFFF'
                }
            },
            fill: {
                opacity: 1
            }
        };

        // Render the chart
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    <script>
        const map = L.map('map').setView([28.6139, 77.2090], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        const drawControl = new L.Control.Draw({
            draw: {
                polygon: false,
                rectangle: false,
                marker: false,
                polyline: false,
                circlemarker: false,
                circle: true
            },
            edit: {
                featureGroup: drawnItems,
                remove: true
            }
        });

        map.addControl(drawControl);
        // 🔵 When circle is first drawn
        map.on(L.Draw.Event.CREATED, function(e) {
            drawnItems.clearLayers();
            drawnItems.addLayer(e.layer);
            updateCircleData(e.layer);
        });

        // 🟢 When circle is edited (MOVE / RESIZE)
        map.on(L.Draw.Event.EDITED, function(e) {
            e.layers.eachLayer(function(layer) {
                updateCircleData(layer);
            });
        });

        function updateCircleData(circle) {
            const center = circle.getLatLng();
            const radiusKm = (circle.getRadius() / 1000).toFixed(2);

            alert("latitude is ==" + center.lat);
            alert("longnitude is ==" + center.lng);
            alert("radius In KM is ==" + radiusKm);

            const maxRadiusKm = 15;

            if (radiusKm > maxRadiusKm) {
                alert('Maximum radius allowed is 15 km');
                drawnItems.clearLayers();
                return;
            }

            document.getElementById('lat').value = center.lat;
            document.getElementById('lng').value = center.lng;
            document.getElementById('radius').value = radiusKm;

            console.log('Updated:', {
                lat: center.lat,
                lng: center.lng,
                radius_km: radiusKm
            });
        }
    </script>
@endpush
