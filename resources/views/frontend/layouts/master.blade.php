<!DOCTYPE html>
<html lang="{{ get_default_language_code() }}">


@php
    $cookie = App\Models\Admin\SiteSections::where('key', 'site_cookie')->first();
    //cookies results
    $approval_status = request()->cookie('approval_status');
    $c_user_agent = request()->cookie('user_agent');
    $c_ip_address = request()->cookie('ip_address');
    $c_browser = request()->cookie('browser');
    $c_platform = request()->cookie('platform');
    //system informations
    $s_ipAddress = request()->ip();
    $s_location = geoip()->getLocation($s_ipAddress);
    $s_browser = Agent::browser();
    $s_platform = Agent::platform();
    $s_agent = request()->header('User-Agent');
    $city = App\Models\City::where('status',1)->get();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ get_fav($basic_settings) }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @php
        $current_url = URL::current();
        // New variable to check if it's the home page
$is_home_page = $current_url == setRoute('frontend.index');
    @endphp

    @if ($is_home_page)
        <title>{{ __($basic_settings->site_name) ?? '' }} - {{ __($basic_settings->site_title) ?? '' }}</title>
    @else
        <title>{{ __($basic_settings->site_name) ?? '' }} - {{ __($page_title) ?? '' }}</title>
    @endif

    @include('partials.header-asset')

    @stack('css')
    @php
        $primaryColor = @$basic_settings->base_color ?? '#7A3DDD';
        $secondaryColor = @$basic_settings->secondary_color ?? '#D860EC';
    @endphp

    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
        }
    </style>

    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
        }
    </style>
    <style>
        .vendor-modal,
        .city-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            /* Kept as flex for easy override in JS */
            align-items: center;
            justify-content: center;
            z-index: 9999;
            font-family: 'Poppins', sans-serif;
        }

        .vendor-box,
        .city-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 650px;
            text-align: center;
            position: relative;
        }

        .vendor-box h2,
        .city-box h2 {
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .vendor-grid,
        .city-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .vendor-item,
        .city-item {
            cursor: pointer;
            transition: transform 0.2s, background 0.2s;
            padding: 10px;
            border-radius: 10px;
        }

        .vendor-item:hover,
        .city-item:hover {
            background: #f2f2f2;
            transform: scale(1.05);
        }

        .vendor-item img,
        .city-item img {
            width: 60px;
            height: 60px;
        }

        .vendor-item p,
        .city-item p {
            margin-top: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #222;
        }
    </style>
</head>

<body class="{{ get_default_language_dir() }}">


    @include('frontend.partials.scroll-to-top')
    @include('frontend.partials.header')
    @include('frontend.partials.preloader')

    @yield('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start cookie
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="cookie-main-wrapper">
        <div class="cookie-content">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                    d="M21.598 11.064a1.006 1.006 0 0 0-.854-.172A2.938 2.938 0 0 1 20 11c-1.654 0-3-1.346-3.003-2.937c.005-.034.016-.136.017-.17a.998.998 0 0 0-1.254-1.006A2.963 2.963 0 0 1 15 7c-1.654 0-3-1.346-3-3c0-.217.031-.444.099-.716a1 1 0 0 0-1.067-1.236A9.956 9.956 0 0 0 2 12c0 5.514 4.486 10 10 10s10-4.486 10-10c0-.049-.003-.097-.007-.16a1.004 1.004 0 0 0-.395-.776zM12 20c-4.411 0-8-3.589-8-8a7.962 7.962 0 0 1 6.006-7.75A5.006 5.006 0 0 0 15 9l.101-.001a5.007 5.007 0 0 0 4.837 4C19.444 16.941 16.073 20 12 20z" />
                <circle cx="12.5" cy="11.5" r="1.5" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <circle cx="7.5" cy="12.5" r="1.5" />
                <circle cx="15.5" cy="15.5" r="1.5" />
                <circle cx="10.5" cy="16.5" r="1.5" />
            </svg>

            <p class="text-white">{{ __(strip_tags($cookie->value->desc ?? '')) }} <a
                    href="{{ url('link/') . '/' . $cookie->value->link ?? '' }}">{{ __('Privacy Policy') }}</a></p>
        </div>
        <div class="cookie-btn-area">
            <button class="cookie-btn">{{ __('Allow') }}</button>
            <button class="cookie-btn-cross">{{ __('Decline') }}</button>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End cookie
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!-- 🌍 City Selection Popup -->
    <div id="cityModal" class="city-modal" style="display: none;">
        <div class="city-box">
            <button class="close-btn" id="closeModal">✕</button>
            <h2>Cities</h2>
            <div class="city-grid">
                @foreach($city as $row)
                    <div class="city-item" data-city="{{$row->name}}">
                        <img src="{{ asset('public/' .$row->icon) }}" alt="Hyderabad">
                        <p>{{$row->name}}</p>
                    </div>
                @endforeach
                <!--<div class="city-item" data-city="Hyderabad">-->
                <!--    <img src="{{ asset('public/frontend/images/element/hyderabad.76de1cc1.svg') }}" alt="Hyderabad">-->
                <!--    <p>Hyderabad</p>-->
                <!--</div>-->
                <!--<div class="city-item" data-city="Kolkata">-->
                <!--    <img src="{{ asset('public/frontend/images/element/kolkata.fb97ce82.svg') }}" alt="Kolkata">-->
                <!--    <p>Kolkata</p>-->
                <!--</div>-->
                <!--<div class="city-item" data-city="Delhi">-->
                <!--    <img src="{{ asset('public/frontend/images/element/delhi.6e21e427.svg') }}" alt="Delhi">-->
                <!--    <p>Delhi</p>-->
                <!--</div>-->
                <!--<div class="city-item" data-city="Chennai">-->
                <!--    <img src="{{ asset('public/frontend/images/element/chennai.2e7b9a5b.svg') }}" alt="Chennai">-->
                <!--    <p>Chennai</p>-->
                <!--</div>-->
                <!--<div class="city-item" data-city="Bangalore">-->
                <!--    <img src="{{ asset('public/frontend/images/element/beng.9c2db9f4.svg') }}" alt="Bangalore">-->
                <!--    <p>Bangalore</p>-->
                <!--</div>-->
                <!--<div class="city-item" data-city="Mumbai">-->
                <!--    <img src="{{ asset('public/frontend/images/element/mumbai.a4109533.svg') }}" alt="Mumbai">-->
                <!--    <p>Mumbai</p>-->
                <!--</div>-->
            </div>
        </div>
    </div>


    @include('frontend.section.top-modal')
    @include('frontend.partials.footer')
    @include('partials.footer-asset')
    @include('frontend.partials.extensions.tawk-to')

    @stack('script')
    @php
        $errorName = '';
    @endphp
    @if ($errors->any())
        @php
            $error = (object) $errors;
            $msg = $error->default;
            $messageNames = $msg->keys();
            $errorName = $messageNames[0];
        @endphp
    @endif
    <script>
        var error = "{{ $errorName }}";
        if (
            error == 'firstname' ||
            error == 'agree' ||
            error == 'register_password' ||
            error == 'register_email' ||
            error == 'lastname'
        ) {
            $('.register-btn').addClass('active');
            $('#login').addClass('d-none');
            $('.login-btn').removeClass('active');
            $('#register').removeClass('d-none');
        }
    </script>

    <script>
        var status = "{{ @$cookie->status }}";
        //cookies results
        var approval_status = "{{ $approval_status }}";
        var c_user_agent = "{{ $c_user_agent }}";
        var c_ip_address = "{{ $c_ip_address }}";
        var c_browser = "{{ $c_browser }}";
        var c_platform = "{{ $c_platform }}";
        //system informations
        var s_ipAddress = "{{ $s_ipAddress }}";
        var s_browser = "{{ $s_browser }}";
        var s_platform = "{{ $s_platform }}";
        var s_agent = "{{ $s_agent }}";
        const pop = document.querySelector('.cookie-main-wrapper')
        if (status == 1) {
            if (approval_status == 'allow' || approval_status == 'decline' || c_user_agent === s_agent || c_ip_address ===
                s_ipAddress || c_browser === s_browser || c_platform === s_platform) {
                pop.style.bottom = "-300px";
            } else {
                window.onload = function() {
                    setTimeout(function() {
                        pop.style.bottom = "20px";
                    }, 2000)
                }
            }
        } else {
            pop.style.bottom = "-300px";
        }
        // })
    </script>
    <script>
        (function($) {
            "use strict";
            //Allow
            $('.cookie-btn').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var postData = {
                    type: "allow",
                };
                $.post('{{ route('global.set.cookie') }}', postData, function(response) {
                    throwMessage('success', [response]);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                });
            });
            //Decline
            $('.cookie-btn-cross').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var postData = {
                    type: "decline",
                };
                $.post('{{ route('global.set.cookie') }}', postData, function(response) {
                    throwMessage('error', [response]);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                });
            });
        })(jQuery)
    </script>

    <script>
        // Check if the current page is the home page using the Blade variable
        const isHomePage = {{ $is_home_page ? 'true' : 'false' }};

        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("cityModal");
            const closeModal = document.getElementById("closeModal");
            const closevendorModal = document.getElementById("closevendorModal");
            const cities = document.querySelectorAll(".city-item");
            let cityFromSession = "{{ session('selected_city') }}";

            if (cityFromSession) {
                $('#current-location').text(cityFromSession);
            }
            // Only show the popup if isHomePage is true
            if (isHomePage) {
                if (!cityFromSession) {
                    // Show popup on page load
                    modal.style.display = "flex";
                }


            } else {
                // Ensure it is hidden on all other pages
                modal.style.display = "none";
            }



            // Close when user clicks X
            closeModal.addEventListener("click", () => modal.style.display = "none");
            closevendorModal.addEventListener("click", () => document.getElementById("vendorModal").style.display =
                "none");
            // Close popup on city select (no alert)
            cities.forEach(city => {
                city.addEventListener("click", () => {
                    const selectedCity = city.dataset.city;
                    $('#current-location').text(selectedCity);

                    fetch('/set-session-city', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            city: selectedCity
                        })
                    });


                    modal.style.display = "none";

                    // Optional: Store selected city for later use
                    localStorage.setItem("selectedCity", selectedCity);

                    // You might want to reload the page or update content here based on the selected city
                });
            });
        });


        function open_city_popup() {
            document.getElementById("cityModal").style.display = "flex";
        }
    </script>


</body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</html>
