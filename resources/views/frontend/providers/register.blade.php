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

    <form id="register" class="d-none" method="POST" action="{{ route('providers.register.submit') }}">
        @csrf
        <div class="personal-account pt-30">
            <div class="row">
                <div class="col-lg-12 form-group">
                    <label>{{ __('First Name') }}</label>
                    <input type="text" class="form-control form--control" name="name"
                        placeholder="{{ __('Enter First Name') }}">
                </div>
                <div class="col-lg-12 form-group">
                    <label>{{ __('Last Name') }}</label>
                    <input type="text" class="form-control form--control" name="last_name"
                        placeholder="{{ __('Enter Last Name') }}">
                </div>
                <div class="col-lg-12 form-group">
                    <label>{{ __('Email Address') }}</label>
                    <input type="email" class="form-control form--control" name="email"
                        placeholder="{{ __('Enter Email') }}">
                </div>
                <div class="col-lg-12 form-group">
                    <label>{{ __('Mobile Number') }}</label>
                    <input type="text" class="form-control form--control" name="mobile"
                        placeholder="{{ __('Enter Mobile Number') }}">
                </div>
                <div class="col-lg-12 form-group show_hide_password-2">
                    <label>{{ __('Enter Password') }}</label>
                    <input type="password" class="form-control form--control" name="password"
                        placeholder="{{ __('Enter Password') }}">
                    <a href="#0" class="show-pass"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                </div>
                <div class="col-lg-12 form-group">
                    <label>{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control form--control" name="password_confirmation"
                        placeholder="{{ __('Confirm Password') }}">
                </div>
                <div class="col-lg-12 form-group text-center">
                    <button type="submit" class="btn--base w-100">{{ __('Register Now') }}</button>
                </div>
            </div>
        </div>
    </form>
