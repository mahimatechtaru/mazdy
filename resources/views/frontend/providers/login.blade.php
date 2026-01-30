@php
    $defualt_lang = get_default_language_code() ?? 'en';
@endphp
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
    </style>
@endpush
@section('content')
    @extends('frontend.layouts.master')

    <!-- provider account -->
    <section class="register-section hospital-account bg-overlay-account bg_img"
        data-background="{{ asset('frontend/images/banner/account-bg.webp') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-9 col-md-11">
                    <div class="register-form">
                        <div class="login-form">
                            <div class="login-header-top">
                                <h3 class="title">{{ __('Login as Provider') }}</h3>
                            </div>

                            {{-- Login Form --}}
                            <form class="account-form" id="login" method="POST"
                                action="{{ setRoute('providers.login.submit') }}">
                                @csrf
                                <div class="login-information pt-30">
                                    <div class="row mb-10-none">
                                        <div class="col-lg-12 form-group mb-10">
                                            <label>{{ __('Username') }}</label>
                                            <input type="email" class="form-control form--control" name="credentials"
                                                placeholder="{{ __('Enter Email as your Username') }}...">
                                        </div>
                                        <div class="col-lg-12 form-group show_hide_password mb-10">
                                            <label>{{ __('Password') }}</label>
                                            <input type="password" class="form-control form--control" name="password"
                                                placeholder="{{ __('Enter Password') }}...">
                                            <a href="#0" class="show-pass"><i class="fa fa-eye-slash"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <div class="forgot-item text-end">
                                                <label><a href="{{ setRoute('providers.password.forgot') }}"
                                                        class="text--base">{{ __('Forgot Password?') }}</a></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group text-center">
                                            <button type="submit" class="btn--base w-100">{{ __('Login Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-9 col-md-11">
                    <div class="video-wrapper">
                        <video autoplay muted loop controls playsinline>
                            <source src="{{ asset('backend/images/web-settings/image-assets/medzy_vendor_video.mp4') }}"
                                type="video/mp4">
                        </video>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
