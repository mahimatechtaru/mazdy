@php
    // आवश्यक मॉडल्स को इम्पोर्ट करें
    use App\Models\Frontend\FaqCategory;
    use App\Models\Frontend\FaqItem;

@endphp
@extends('frontend.layouts.master')
<style>
    .regiform {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        margin: 10px auto;
    }

    /* HERO */
    .hero {
        background: linear-gradient(135deg, #5c76f4, #253aa1);
        color: #fff;
        padding: 70px 0;
    }

    .hero h1 {
        font-size: 42px;
    }

    .hero p {
        font-size: 18px;
        margin-top: 10px;
    }

    /* TABS */
    .tabs {
        display: flex;
        justify-content: center;
        margin-top: -30px;
    }

    .tabs button {
        background: #fff;
        border: none;
        padding: 15px 30px;
        font-size: 16px;
        cursor: pointer;
        margin: 0 5px;
        border-radius: 6px 6px 0 0;
        font-weight: 600;
    }

    .tabs button.active {
        background: linear-gradient(135deg, #5c76f4, #253aa1);
        color: #fff;
    }

    /* CONTENT */
    .tab-content {
        display: none;
        background: #fff;
        padding: 50px 40px;
        border-radius: 0 0 10px 10px;
    }

    .tab-content.active {
        display: block;
    }

    .section-title {
        font-size: 28px;
        margin-bottom: 20px;
    }

    /* STEPS */
    .steps {
        display: block;
        /*grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px; */
    }

    .step {
        background: #f9fafc;
        padding: 25px;
        border-radius: 10px;
        border: 1px solid #5b2dbf;
        box-shadow: 5px 5px;
        width: 42%;
        float: left;
        margin: 15px;

    }

    .step h4 {
        margin: 0 0 10px;
    }

    .step i {
        color: #5b2dbf;
        margin-right: 8px;
    }

    .step p,
    .qa-section p {
        color: #000;
        margin-right: 8px;
    }

    .qa-section h3 {
        font-size: 20px;
    }

    .qa-section-wrapper {
        border-top: 2px solid;
        padding: 10px;
        margin: 20px 0;
    }

    .qa-section {
        flex-direction: column;
        gap: 15px;
    }

    .qa-card {
        background-color: #f6f6f6;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 5px;
    }

    .video-wrapper {
        /* height: 100vh;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center; */
        min-width: 1200px;
    }

    /* DEFAULT (PC / Laptop) */
    .video-wrapper video {
        width: 100%;
        min-height: 500px;
        object-fit: contain;
        /* âœ… NO CUT */
        border-radius: 15px;
        background-color: #000;
    }

    /* LARGE DESKTOPS */
    @media (min-width: 1400px) {
        .video-wrapper video {
            // max-height: 380px;
        }
    }

    /* MOBILE ONLY */
    @media (max-width: 768px) {
        .video-wrapper video {
            width: auto;
            height: 100%;
            max-height: none;
            object-fit: cover;
            /* looks better on mobile */
        }
    }

    /* Desktop & laptop */
    @media (min-width: 992px) {
        .video-wrapper video {
                {
                width: auto;
            }
        }
</style>
</style>
@php
    if (trim($item->language->en->title) == 'Doctor') {
        $logo = 'fa-user-md';
    } elseif (trim($item->language->en->title) == 'Nursing') {
        $logo = 'fa-user-circle';
    } elseif (trim($item->language->en->title) == 'Ambulance') {
        $logo = 'fa-ambulance';
    } elseif (trim($item->language->en->title) == 'Food Delivery') {
        $logo = 'fa-bolt';
    } elseif (trim($item->language->en->title) == 'Lab Tests') {
        $logo = 'fa-flask';
    } elseif (trim($item->language->en->title) == 'Pharmacy') {
        $logo = 'fa-medkit';
    } elseif (trim($item->language->en->title) == 'Medical Equipment') {
        $logo = 'fa-stethoscope';
    } elseif (trim($item->language->en->title) == 'Food Services') {
        $logo = 'fa-cutlery';
    } elseif (trim($item->language->en->title) == 'Medical Tourism') {
        $logo = 'fa-heartbeat';
    } elseif (trim($item->language->en->title) == 'Last Rites') {
        $logo = 'fa-solid fa-hands-praying';
    } else {
        $logo = 'fa-user-md';
    }
    $icon = 'fas ' . $logo;

@endphp
@section('content')
    <section class=" text-center d-block">
        <div class="custom-container container">
            {{-- <div class="row justify-content-center">
                <div class="col-xl-12">
                    <img src="{{ asset('frontend/images/banner/banner.png') }}" alt="Feature Icon"
                        style="width: 100%;max-height: 250px;">
                </div>
            </div> --}}
            <div class="row justify-content-center bg-info text-white ">
                <div class="col-xl-5 col-lg-7 col-md-9">
                    <div class="text-left " style="padding: 80px;">
                        <p><i class="{{ $icon }} icon" style="font-size: 300px"></i></p>
                        <h1 class="text-white">{{ $item->language->en->title ?? 'No title' }}</h1>
                        <p>{{ $item->language->en->details ?? 'No details available' }}</p>

                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-9">
                    <div class="text-left ptb-10">
                        <div class="regiform col-8 mx-autof">
                            <div class="register-header-top">
                                <h3 class="title">
                                    {{ __('Join as :role', ['role' => $item->language->en->title ?? 'Provider']) }}</h3>
                            </div>
                            {{-- Register Form --}}
                            <form id="register" class="" method="POST"
                                action="{{ setRoute('providers.register.submit') }}">
                                @csrf
                                <div class="personal-account pt-30 select-account" data-select-target="1">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label>{{ __('Full Name') }}</label>
                                            <input type="text" class="form-control form--control" name="name"
                                                placeholder="{{ __('Full Name') }}">
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>{{ __('Username') }}</label>
                                            <input type="email" class="form-control form--control" name="email"
                                                placeholder="{{ __('Enter Email Address as Username ') }}">
                                        </div>
                                        <div class="col-lg-12 form-group show_hide_password-2">
                                            <label>{{ __('Create Password') }}</label>
                                            <input type="password" class="form-control form--control" name="password"
                                                placeholder="{{ __('Create Password') }}">
                                            <a href="#0" class="show-pass"><i class="fa fa-eye-slash"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-lg-12  form-group show_hide_password-2">
                                            <label>{{ __('Confirm Password') }}</label>
                                            <input type="password" class="form-control form--control"
                                                name="confirm_password" placeholder="{{ __('Confirm your Password') }}">
                                            <a href="#0" class="show-pass-2"><i class="fa fa-eye-slash"
                                                    aria-hidden="true"></i></a>
                                        </div>

                                        @php
                                            $agree_policy = DB::table('basic_settings')->first();
                                        @endphp

                                        <div class="col-lg-12 form-group">
                                            <div class="custom-check-group">
                                                <input type="checkbox" id="agree" name="agree">
                                                <label for="agree" class="mb-0">
                                                    {{ __('I have read and agreed with the') }}
                                                    <a href="{{ url('useful-link/terms-condition') }}"
                                                        class="text--base">{{ __('Terms & Conditions') }}</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group text-center">
                                            <button type="submit"
                                                class="btn--base w-100">{{ __('Register Now') }}</button>
                                            <label for="level-1" class="mb-0 pt-10">{{ __('Already A Member?') }} <a
                                                    href="{{ url('providers/login') }}"
                                                    class="text--base">{{ __('Login Here') }}</a></label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ptb-20 text-left">
        <div class="container">
            {{-- <h2>{{ $page_title }}</h2> --}}
            {{-- <h3>{{ $item->language->en->title ?? 'No title' }}</h3> --}}
            <p>{!! $item->language->en->description ?? 'No description available' !!}</p>

            <div class="row justify-content-center text-white ">


                <div class="steps row justify-content-center">
                    <div class="step col-md-5">
                        <h4><i class="fa fa-id-card"></i> Provider Registration</h4>
                        <p>Submit credentials, certifications, and availability.</p>
                    </div>

                    <div class="step col-md-5">
                        <h4><i class="fa fa-check-circle"></i> Verification</h4>
                        <p>Medzy verifies qualifications to ensure patient safety.</p>
                    </div>

                    <div class="step col-md-5">
                        <h4><i class="fa fa-bell"></i> Accept Assignments</h4>
                        <p>Receive nearby service requests matching expertise.</p>
                    </div>

                    <div class="step col-md-5">
                        <h4><i class="fa fa-user-nurse"></i> Deliver Care</h4>
                        <p>Provide professional care at home or hospital-assigned locations.</p>
                    </div>

                    <div class="step col-md-5">
                        <h4><i class="fa fa-clipboard"></i> Update Records</h4>
                        <p>Upload vitals, treatment notes, and service updates.</p>
                    </div>

                    <div class="step col-md-5">
                        <h4><i class="fa fa-wallet"></i> Payments & Support</h4>
                        <p>Transparent payouts with dedicated provider assistance.</p>
                    </div>
                </div>

                <div class="col-12 pt-40">
                    <div class="video-wrapper">
                        <!--<video autoplay muted loop>-->
                        <video muted playsinline preload="metadata" class="hover-video">
                            <!--<source src="video.mp4" type="video/mp4">-->
                            <source src="{{ asset('backend/images/web-settings/image-assets/medzy_vendor_video.mp4') }}"
                                type="video/mp4">
                        </video>
                    </div>
                </div>
                @php
                    $users = FaqCategory::whereHas('items', function ($query) {
                        $query->where('is_published', true);
                    })
                        ->with([
                            'items' => function ($query) {
                                $query->where('is_published', true)->orderBy('sort_order', 'asc');
                            },
                        ])
                        ->where('id', 6)
                        ->orderBy('name', 'asc')
                        ->get();

                @endphp
                <div class="qa-section-wrapper">
                    <h2 class="text-[#031432] text-center font-poppins text-[32px] font-semibold leading-normal mb-6">
                        Frequently Asked Questions</h2>
                    @foreach ($users as $category)
                        <div class="qa-section" data-category-content="{{ $category->name }}"
                            style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">

                            @if ($category->items->isEmpty())
                                <div class="qa-card">
                                    <p class="text-center">{{ __('No questions published in this category yet.') }}</p>
                                </div>
                            @else
                                @foreach ($category->items as $item)
                                    <div class="qa-card">
                                        <h3>{{ $item->question }}</h3>
                                        <p>{!! $item->answer !!}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('.hover-video');

            videos.forEach(video => {
                video.addEventListener('mouseenter', () => {
                    video.play();
                });

                video.addEventListener('mouseleave', () => {
                    video.pause();
                    video.currentTime = 0; // optional: restart from beginning
                });
            });
        });
    </script>
@endpush
