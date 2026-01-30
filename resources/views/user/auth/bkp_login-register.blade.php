@php
    $app_local = get_default_language_code();
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::LOGIN_SECTION);
    $login = App\Models\Admin\SiteSections::getData($slug)->first();
@endphp
@extends('frontend.layouts.master')

@push('css')
    <style>
        .video-wrapper {
            height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        /* DEFAULT (PC / Laptop) */
        .video-wrapper video {
            width: 100%;
            height: 500px;
            max-height: 500px;
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

            /* Q&A Cards */
            .qa-section {
                display: none;
                /* hidden by default */
                flex-direction: column;
                gap: 15px;
            }

            .qa-section-wrapper {
                display: inline;
                justify-content: center;
                gap: 20px;
            }

            .qa-card {
                background-color: #f6f6f6;
                padding: 20px;
                border-radius: 8px;
            }

            .qa-card h4 {
                font-size: 11px;
                font-weight: 600;
                color: #212121;
                margin-top: 0;
                margin-bottom: 8px;
            }

            .qa-card p {
                font-size: 15px;
                color: #444444;
                margin: 0;
                line-height: 1.5;
            }

            .qa-card ul {
                padding-left: 20px;
                margin: 10px 0;
            }

            .qa-card ul li {
                margin-bottom: 6px;
            }

            /* Category Tabs */
            .category-tabs {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                margin-bottom: 40px;
            }

            .tab-button {
                padding: 8px 18px;
                border: none;
                border-radius: 20px;
                /* Pill shape */
                font-size: 14px;
                cursor: pointer;
                white-space: nowrap;
                font-weight: 500;
            }

            /* Inactive Tab */
            .tab-button {
                background-color: #f0f0f0;
                color: #555555;
            }

            .tab-button.active {
                background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
                color: #ffffff;
                font-weight: 600;
            }

            /* Q&A Cards */
            .qa-section {
                display: none;
                /* hidden by default */
                flex-direction: column;
                gap: 15px;
            }

            .qa-card {
                background-color: #f6f6f6;
                padding: 20px;
                border-radius: 8px;
            }

            .qa-card h3 {
                font-size: 17px;
                font-weight: 600;
                color: #212121;
                margin-top: 0;
                margin-bottom: 8px;
            }

            .qa-card p {
                font-size: 15px;
                color: #444444;
                margin: 0;
                line-height: 1.5;
            }

            /* Basic responsiveness for smaller screens */
            @media (max-width: 600px) {
                .faq-title {
                    font-size: 24px;
                }

                .category-tabs {
                    justify-content: flex-start;
                    overflow-x: auto;
                    padding-bottom: 5px;
                }
            }

            body {
                font-family: 'Inter', 'Helvetica Neue',
                    background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 15px;
            }

            .section-header-title .title {
                font-size: 32px;
                font-weight: 700;
                color: #212121;
                margin-bottom: 0;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
                justify-content:
                    margin-left: -15px;
                margin-right: -15px;
                margin-bottom: -40px;
            }

            .col-xl-3,
            .col-lg-4,
            .col-md-6 {
                flex: 0 0 auto;
                padding-left: 15px;
                padding-right: 15px;
                margin-bottom: 40px;
            }

            .team-member-card {
                background-color: #f6f6f6;
                border-radius: 12px;
                text-align: center;
                padding: 25px;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .member-img {
                margin: 0 auto 20px;

            }

            .member-img img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                border: 3px solid #007bff;
                object-fit: cover;
            }

            .member-name {
                font-size: 16px;
                font-weight: 600;
                color: #212121;
                margin-bottom: 5px;
            }

            .member-designation {
                font-size: 15px;
                color: #444444;
                line-height: 1.6;
                margin-bottom: 15px;
                font-style: italic;
            }

            .testimonial-author {
                font-size: 14px;
                font-weight: 500;
                color: #333333;
                margin-top: auto;
            }

            .testimonial-role {
                font-size: 13px;
                color: #666666;
                margin-bottom: 0;
            }

            @media (min-width: 1200px) {
                .col-xl-3 {
                    width: 25%;
                }
            }

            @media (min-width: 992px) and (max-width: 1199px) {
                .col-lg-4 {
                    width: 33.3333%;
                }
            }

            @media (min-width: 768px) and (max-width: 991px) {
                .col-md-6 {
                    width: 50%;
                }
            }

            @media (max-width: 767px) {

                .col-xl-3,
                .col-lg-4,
                .col-md-6 {
                    width: 100%;
                }

                .leadership-team-section {
                    padding-top: 50px;
                    padding-bottom: 30px;
                }

                .section-header-title {
                    padding-bottom: 30px;
                }

                .section-header-title .title {
                    font-size: 28px;
                }

                .team-member-card {
                    padding: 20px;
                }

                .member-img img {
                    width: 80px;
                    height: 80px;
                }
            }
    </style>
@endpush

@section('content')
    <section class="register-section bg-overlay-account bg_img"
        data-background="{{ asset('frontend/images/banner/account-bg.webp') }}">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-5 col-lg-9 col-md-11">
                    <div class="register-form">
                        <div class="login-form">
                            <div class="login-header-top">
                                <h3 class="title">{{ __('Log in and Stay Connected') }}</h3>
                            </div>
                            <div class="register-header-top d-none">
                                <h3 class="title">{{ __('Register for an Account Today') }}</h3>
                            </div>
                            <div class="form-hader d-flex justify-content-between">
                                <div class="login-button">
                                    <button class="btn login-btn active">{{ __('Login') }}</button>
                                </div>
                                <div class="register-button">
                                    <button class="btn register-btn">{{ __('Registration') }}</button>
                                </div>
                            </div>a
                            <form class="account-form" id="login" method="POST"
                                action="{{ setRoute('user.login.submit') }}">
                                @csrf
                                <div class="login-information pt-30">
                                    <div class="row mb-10-none">
                                        <div class="col-lg-12 form-group mb-10">
                                            <label>{{ __('Enter Email') }}</label>
                                            <input type="email" class="form-control form--control" name="credentials"
                                                placeholder="{{ __('Enter Email') }}...">
                                        </div>
                                        <div class="col-lg-12 form-group show_hide_password mb-10">
                                            <label>{{ __('Enter Password') }}</label>
                                            <input type="password" class="form-control form--control" name="password"
                                                placeholder="{{ __('Enter Password') }}...">
                                            <a href="#0" class="show-pass"><i class="fa fa-eye-slash"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <div class="forgot-item text-end">
                                                <label><a href="{{ setRoute('user.password.forgot') }}"
                                                        class="text--base">{{ __('Forgot Password?') }}</a></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group text-center">
                                            <button type="submit" class="btn--base w-100">{{ __('Login Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register" class="d-none" method="POST"
                                action="{{ setRoute('user.register.submit') }}">
                                @csrf
                                <div class="personal-account pt-30 select-account" data-select-target="1">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 form-group">
                                            <label>{{ __('First Name') }}</label>
                                            <input type="text" class="form-control form--control" name="firstname"
                                                placeholder="{{ __('First Name') }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 form-group">
                                            <label>{{ __('Last Name') }}</label>
                                            <input type="text" class="form-control form--control" name="lastname"
                                                placeholder="{{ __('Last Name') }}">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label>{{ __('Email Address') }}</label>
                                            <input type="email" class="form-control form--control" name="email"
                                                placeholder="{{ __('Email') }}">
                                        </div>
                                        <div class="col-lg-6 form-group show_hide_password-2">
                                            <label>{{ __('Password') }}</label>
                                            <input type="password" class="form-control form--control" name="password"
                                                placeholder="{{ __('Password') }}">
                                            <a href="#0" class="show-pass-2"><i class="fa fa-eye-slash"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                        @php
                                            $agree_policy = DB::table('basic_settings')->first();
                                        @endphp

                                        @if ($agree_policy->agree_policy == true)
                                            <div class="col-lg-12 form-group">
                                                <div class="custom-check-group">
                                                    <input type="checkbox" id="level-1" name="agree">
                                                    <label for="level-1"
                                                        class="mb-0">{{ __('I have read agreed with the') }} <a
                                                            href="{{ url('useful-link/terms-condition') }}"
                                                            class="text--base">{{ __('Terms & Conditions') }}</a></label>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-12 form-group text-center">
                                            <button type="submit"
                                                class="btn--base w-100">{{ __('Register Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-9 col-md-11">

                    <div class="video-wrapper">
                        <!--<video autoplay muted loop>-->
                        <video autoplay muted loop controls playsinline>
                            <!--<source src="video.mp4" type="video/mp4">-->
                            <source src="{{ asset('backend/images/web-settings/image-assets/medzy_user_video.mp4') }}"
                                type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @include('user.auth.steps')
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            const tabButtons = $('.category-tabs .tab-button');
            const qaSections = $('.qa-section-wrapper .qa-section');

            // Default show first
            qaSections.hide();
            qaSections.first().css('display', 'flex');

            // On click tab
            tabButtons.on('click', function() {
                const selectedCategory = $(this).data('category').trim().toLowerCase();

                tabButtons.removeClass('active');
                $(this).addClass('active');

                qaSections.hide();

                qaSections.each(function() {
                    const sectionCategory = $(this).data('category-content')?.trim().toLowerCase();
                    if (sectionCategory === selectedCategory) {
                        $(this).css('display', 'flex');
                    }
                });
            });
        });
    </script>
@endpush
