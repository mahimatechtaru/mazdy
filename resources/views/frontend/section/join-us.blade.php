<!--  how its work -->
@php

    $app_local = get_default_language_code() ?? 'en';
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::HOW_ITS_WORK_SECTION);
    $how_its_work = App\Models\Admin\SiteSections::getData($slug)->first();

    $app_local = get_default_language_code() ?? 'en';
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FEATURES_SECTION);
    $features = App\Models\Admin\SiteSections::getData($slug)->first();
    $featureItems = $features->value->items ?? [];

    // Convert to plain array (if it's stdClass)
    $featureArray = is_array($featureItems) ? $featureItems : (array) $featureItems;

    // Left 5 items & Right 5 items
    $leftItems = array_slice($featureArray, 0, 5);
    $rightItems = array_slice($featureArray, 5, 5);

    $leftIndex = 0;
    $rightIndex = 0;
    $step_key = 0;

@endphp
<style>
    .btn-top {
        background: linear-gradient(90.88deg, #1d93b9 0%, #206199 100%);
        margin: 4px 1px;
    }

    .btn-top:hover {
        background-color: #637dfe34;
        color: #00228a;
    }
</style>


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Join Us section
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="justify-content-center ptb-40">
    <div class="container">
        {{-- <div class="section-tag pb-20">
            <div class="row">
                <div class="col-xl-10 col-lg-12">
                    <div class="section-title">
                        <h2 class="title" style="text-aling: center;">
                            Join Us
                        </h2>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="how-work-area">
            <div class="row mb-20-none">
                <div class="col-lg-12 mb-20">
                    <div class="steps-content">
                        <div class="step-listing">
                            <div class="row mb-20-none">
                                <div class="col-lg-4 mb-20">

                                    <div class="content">
                                        <a href="{{ route('user.register') }}">
                                            <h4 class="title">
                                                <i class="fas fa-user"></i> Join as Customer
                                            </h4>

                                            <p>Book appointments, consult doctors, and manage your health online.
                                                Access trusted healthcare services anytime, anywhere.</p>
                                            <button class="btn btn-top"
                                                onclick="location.href='{{ route('user.register') }}'">Join Now</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-20">
                                    <div class="content">
                                        <h4 class="title">
                                            <i class="fas fa-medkit"></i> Join as Provider
                                        </h4>
                                        @foreach ($featureArray as $val)
                                            @php
                                                $leftIndex++;
                                                $step_key++;
                                                $link = route('frontend.feature.details', [
                                                    'id' => $val->id ?? $loop->iteration,
                                                ]);
                                                if (
                                                    $val->language->$app_local->title == 'Customer' ||
                                                    $val->language->$app_local->title == 'Hospital'
                                                ) {
                                                    continue;
                                                }
                                            @endphp
                                            <a href="{{ $link }}"
                                                style="text-decoration: none; color: inherit;">
                                                <button class="btn btn-top"
                                                    onclick="location.href='{{ route('user.login') }}'">{{ $val->language->$app_local->title ?? ($val->language->$default->title ?? '') }}</button>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-20">

                                    <div class="content">
                                        <a href="{{ route('hospitals.register') }}">
                                            <h4 class="title">
                                                <i class="fas fa-hospital"></i> Join as Hospital
                                            </h4>
                                            <p>Streamline hospital operations and doctor management in one platform.
                                                Deliver better patient care with smart digital tools.</p>
                                            <button class="btn btn-top"
                                                onclick="location.href='{{ route('hospitals.register') }}'">Join
                                                Now</button>

                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</section>
