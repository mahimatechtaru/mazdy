@php

    $app_local = get_default_language_code() ?? 'en';
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FEATURES_SECTION);
    $features = App\Models\Admin\SiteSections::getData($slug)->first();
    $featureItems = $features->value->items ?? [];

    // Convert to plain array (if it's stdClass)
    $featureArray = is_array($featureItems) ? $featureItems : (array) $featureItems;

@endphp

<style>
    .tutorial-container {
        max-width: 900px;
        margin: 0 auto;
        /* Center the content */
        padding: 20px;
    }

    .tutorial-title {
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        color: #212121;
        margin-bottom: 30px;
    }

    /* Search Bar */
    .search-bar {
        margin-bottom: 30px;
        text-align: center;
    }

    .search-bar input {
        width: 100%;
        max-width: 600px;
        padding: 12px 20px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        color: #444;
    }

    .search-bar input::placeholder {
        color: #888;
    }

    /* Category Tabs */
    .category-tabs {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
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
        width: 32%
    }

    .sub-tab-button {
        padding: 10px;
        border-radius: 10px;
    }

    .sub-tab-button.active,
    .sub-content.active {
        display: block;
    }

    .sub-tab-button.active,
    .tab-button.active {
        background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: #ffffff;
        font-weight: 600;
    }

    /* Q&A Cards */
    .qa-section,
    .sub-content {
        display: none;
        /* hidden by default */
        flex-direction: column;
        gap: 15px;
        min-width: 1000px;
    }

    .sub-content {
        background: rgb(74 95 201);
        padding: 10px;
        color: rgb(255, 255, 255);

    }

    .qa-section-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
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

    .section {

        background-color: #3289ef !important;
        color: #fff;
    }

    .section-title,
    .section-contant {
        display: none;
    }

    /* Basic responsiveness for smaller screens */
    @media (max-width: 600px) {
        .tutorial-title {
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

@extends('frontend.layouts.master')
<div class="container">
    <div class="section-tag">
        <span><i class="las la-heart"></i>
            Tutorial's</span>
    </div>
    <div class="section-tag">
        <h3 class="title text-center">
            How MEDZY Works
        </h3>

        <div class="category-tabs main-tabs" id="tutorial-categories">
            <button class="tab-button active" data-category="user">
                User
            </button>
            <button class="tab-button" data-category="provider">
                Provider
            </button>
            <button class="tab-button" data-category="hospital">
                Hospital
            </button>
        </div>

        <div class="qa-section-wrapper">

            <div class="qa-section" data-category-content="user" style="display: flex;">
                @include('frontend.pages.user_tutorials')
            </div>
            <div class="qa-section" data-category-content="provider">

                <div class="category-tabs sub-tabs" id="provider-features">
                    @php
                        $i = $j = 0;
                    @endphp
                    @foreach ($featureArray as $k => $val)
                        @php
                            if (
                                $val->language->$app_local->title == 'User' ||
                                $val->language->$app_local->title == 'Hospital'
                            ) {
                                $i++;
                                continue;
                            }

                            $link = route('frontend.feature.details', [
                                'id' => $val->id ?? $loop->iteration,
                            ]);

                        @endphp
                        <button class="sub-tab-button {{ $i == 1 ? 'active' : '' }}"
                            data-sub="{{ str_replace(' ', '-', strtolower($val->language->$app_local->title ?? ($val->language->$default->title ?? ''))) }}">
                            {{ ucfirst($val->language->$app_local->title ?? ($val->language->$default->title ?? '')) }}
                        </button>
                        @php $i++; @endphp
                    @endforeach
                </div>
                @foreach ($featureArray as $val)
                    @php
                        if (
                            $val->language->$app_local->title == 'Customer' ||
                            $val->language->$app_local->title == 'Hospital'
                        ) {
                            $j++;
                            continue;
                        }
                    @endphp
                    <div class="sub-content {{ $j == 1 ? 'active' : '' }}"
                        data-sub-content="{{ str_replace(' ', '-', strtolower($val->language->$app_local->title ?? ($val->language->$default->title ?? ''))) }}">
                        {!! ucfirst(
                            strtolower($val->language->$app_local->description ?? ($val->language->$default->description ?? '')),
                        ) !!}
                    </div>
                    @php $j++; @endphp
                @endforeach

            </div>
            <div class="qa-section" data-category-content="hospital">
                @include('frontend.pages.hospital_tutorials')
            </div>
        </div>
    </div>
</div>
</section>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* =========================
               MAIN TABS
            ========================= */
            document.querySelectorAll('.main-tabs .tab-button').forEach(btn => {
                btn.addEventListener('click', () => {

                    document.querySelectorAll('.main-tabs .tab-button')
                        .forEach(b => b.classList.remove('active'));

                    document.querySelectorAll('.qa-section')
                        .forEach(sec => sec.style.display = 'none');

                    btn.classList.add('active');

                    const category = btn.dataset.category;
                    const section = document.querySelector(
                        `.qa-section[data-category-content="${category}"]`
                    );

                    if (section) section.style.display = 'block';
                });
            });

            /* =========================
               SUB TABS (PROVIDER ONLY)
            ========================= */
            document.querySelectorAll('.qa-section .sub-tab-button')
                .forEach(btn => {
                    btn.addEventListener('click', function() {

                        const providerSection = this.closest(
                            '.qa-section'
                        );

                        providerSection.querySelectorAll('.sub-tab-button')
                            .forEach(b => b.classList.remove('active'));

                        providerSection.querySelectorAll('.sub-content')
                            .forEach(c => c.style.display = 'none');

                        console.log(this.dataset);


                        this.classList.add('active');

                        const sub = this.dataset.sub;
                        const content = providerSection.querySelector(
                            `.sub-content[data-sub-content="${sub}"]`
                        );

                        if (content) content.style.display = 'block';
                    });
                });

        });
    </script>
@endpush
