@php
    $app_local = get_default_language_code();
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::VENDOR_BANNER_SECTION);
    $banner = App\Models\Admin\SiteSections::getData($slug)->first();

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::VENDOR_FEATURES_SECTION);
    $features = App\Models\Admin\SiteSections::getData($slug)->first();

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::VENDOR_REQUIREMENTS_SECTION);
    $requirements = App\Models\Admin\SiteSections::getData($slug)->first();

@endphp
@extends('frontend.layouts.master')

@section('content')
    <!-- Hospital Landing page -->
    <section class="vendor-banner bg-overlay-vendor bg_img vendor-bg"
        data-background="{{ isset($banner->value->image) ? get_image($banner->value->image, 'site-section') : asset('path/to/default/image.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12">
                    <div class="vendor-banner-content">
                        <div class="banner-title">
                            <h1 class="title">
                                {{ $banner->value->language->$app_local->heading ?? ($banner->value->language->$default->heading ?? '') }}
                            </h1>
                        </div>
                        <div class="banner-subtitle">
                            <p>{{ $banner->value->language->$app_local->sub_heading ?? '' }}</p>
                        </div>
                        <div class="banner-btn">
                            <a href="{{ setRoute('hospitals.login') }}"
                                class="btn--base">{{ $banner->value->language->$app_local->button ?? ($banner->value->language->$default->button ?? '') }}
                                <i class="las la-stethoscope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                            Start Hospital Feature
                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Hospital Feature
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="vendor-feature ptb-80">
    <div class="container">
        <div class="section-tag pb-30">
            <span><i class="las la-heart"></i>
                {{ $features->value->language->$app_local->section_title ?? ($features->value->language->$default->section_title ?? '') }}</span>
            <div class="row">
                <div class="col-xl-10 col-lg-12">
                    <div class="section-title">
                        <h2 class="title">
                            {{ $features->value->language->$app_local->heading ?? ($features->value->language->$default->heading ?? '') }}
                        </h2>
                        <p> {{ $features->value->language->$app_local->description ?? ($features->value->language->$default->description ?? '') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @php
            $items = $features->value->items ?? [];
            $item_data = (array) $items;

            $converted_data = count($item_data) > 0 ? array_chunk($item_data, ceil(count($item_data) / 2)) : [[], []];

            $part1 = $converted_data[0] ?? [];
            $part2 = $converted_data[1] ?? [];

            // Initialize a counter for continuous numbering
            $counter = 1;
        @endphp

        <div class="row mb-20-none">
            <div class="col-lg-6 mb-20">
                @foreach ($part1 ?? [] as $item)
                <div class="feature-content">
                    <h3 class="heading text--base">{{ $counter++ }}. {{ $item->language->$app_local->title ?? '' }}</h3>
                    <ul class="feature-listing">
                        @foreach ($item->detailsItem as $data)
                            <li> {{ $data->language->$app_local->details ?? ($item->language->$default->details ?? '') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            <div class="col-lg-6 mb-20">
                @foreach ($part2 ?? [] as $item)
                <div class="feature-content">
                    <h3 class="heading text--base">{{ $counter++ }}. {{ $item->language->$app_local->title ?? '' }}</h3>
                    <ul class="feature-listing">
                        @foreach ($item->detailsItem as $data)
                            <li> {{ $data->language->$app_local->details ?? ($item->language->$default->details ?? '') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


    <!-- Hospital Requirements -->
    <section class="hospital-requirements pb-80">
        <div class="container">
            <div class="section-tag pb-30">
                <span><i class="las la-heart"></i>
                    {{ $requirements->value->language->$app_local->title ?? ($requirements->value->language->$default->title ?? '') }}</span>
                <div class="row">
                    <div class="col-xl-10 col-lg-12">
                        <div class="section-title">
                            <h2 class="title">
                                {{ $requirements->value->language->$app_local->heading ?? ($requirements->value->language->$default->heading ?? '') }}
                            </h2>
                            <p> {{ $requirements->value->language->$app_local->sub_heading ?? ($requirements->value->language->$default->sub_heading ?? '') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-30-none justify-content-center">
                @foreach ($requirements->value->items ?? [] as $key => $value)
                    <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                        <div class="required-content-area">
                            <div class="icon">
                                <i class="{{ $value->icon ?? '' }}"></i>
                            </div>
                            <div class="required-content">
                                <h3 class="title">
                                    {{ $value->language->$app_local->item_title ?? $value->language->$default->item_title }}
                                </h3>
                                <p>{{ $value->language->$app_local->item_description ?? $value->language->$default->item_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
