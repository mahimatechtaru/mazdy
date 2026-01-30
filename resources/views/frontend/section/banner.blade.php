@php

    $app_local = get_default_language_code() ?? 'en';
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::BANNER_SECTION);
    $banner = App\Models\Admin\SiteSections::getData($slug)->first();

@endphp

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Banner Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<div class="banner-section bg_img"
    data-background="{{ isset($banner->value->image) ? get_image($banner->value->image, 'site-section') : asset('path/to/default/image.jpg') }}">

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-xl-8 col-lg-10 d-none">
                <div class="banner-content">
                    <h1 class="title">
                        {{ $banner->value->language->$app_local->heading ?? ($banner->value->language->$default->heading ?? '') }}
                    </h1>
                    <p>{{ $banner->value->language->$app_local->sub_heading ?? '' }}</p>
                    <div class="banner-btn">
                        {{-- <a href="{{ setRoute('frontend.find.doctor') }}"
                            class="btn--base btn">{{ $banner->value->language->$app_local->left_button ?? ($banner->value->language->$default->left_button ?? '') }}</a> --}}

                        <!--<a href="{{ setRoute('hospitals.login') }}" class="btn--base btn >{{ $banner->value->language->$app_local->right_button ?? ($banner->value->language->$default->right_button ?? '') }}-->
                        <!--<i class="fab fa-telegram-plane"></i></a><a href="{{ route('providers.login') }}"-->
                        <!--class="btn--base btn">Join as provider-->
                        <!--<i class="fab fa-telegram-plane"></i></a>-->

                        {{-- <div class="dropdown">
                                  <button class="btn--base btn btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $banner->value->language->$app_local->right_button ??($banner->value->language->$default->right_button ?? '') }}
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a class="btn btn--base dropdown-item" href="{{ route('user.login') }}">Join as a User </a></li>
                                    <li><a class="btn btn--base dropdown-item" href="{{ route('frontend.join-provider')}}">Join as a Vendor</a></li>
                                    <li><a class="btn btn--base dropdown-item" href="{{ setRoute('hospitals.login') }}">Join as a Hospital</a></li>
                                  </ul>
                                </div> --}}


                        <div class="top-left">
                            <a href="{{ route('user.register') }}"> <button class="btn--base btn btn-secondary "
                                    type="button">
                                    Join as User</button></a>
                            <a href="#"> <button onclick="open_popup()" class="btn--base btn btn-secondary "
                                    type="button">
                                    Join as Provider</button></a>
                            <a href="{{ setRoute('hospitals.register') }}"> <button class="btn--base btn btn-secondary "
                                    type="button">
                                    Join as Hospital</button></a>
                        </div>
                    </div>
                    {{-- <div class="banner-element">

                        <img
                            src="{{ isset($banner->value->secondary_image) ? get_image($banner->value->secondary_image, 'site-section') : asset('path/to/default/image.jpg') }}"}}">
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Banner Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
