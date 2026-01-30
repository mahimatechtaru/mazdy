@php
    $app_local = get_default_language_code();
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::ABOUT_US_SECTION);
    $about = App\Models\Admin\SiteSections::getData($slug)->first();
    $faq_slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FAQ_SECTION);
    $faq = App\Models\Admin\SiteSections::getData($faq_slug)->first();
    $feedBack_slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::CLIENT_FEEDBACK_SECTION);
    $feedBack = App\Models\Admin\SiteSections::getData($feedBack_slug)->first();

@endphp
@extends('frontend.layouts.master')

@section('content')
    <!-- about section -->
    <section class="about-section pt-40">
        <div class="container">
            <div class="section-tag">
                <span><i class="las la-heart"></i>
                    {{ $about->value->language->$app_local->title ?? ($about->value->language->$default->title ?? '') }}</span>
            </div>
            <div class="row mb-30-none">
                <div class="col-lg-6 mb-30">
                    <div class="about-content">
                        <h2 class="title">
                            {{ $about->value->language->$app_local->heading ?? ($about->value->language->$default->heading ?? '') }}
                        </h2>
                        <p class="sub-title">
                            {{ $about->value->language->$app_local->sub_heading ?? ($about->value->language->$default->sub_heading ?? '') }}
                        </p>
                       <div class="about-website">
                        <p>
                            We understand the challenges patients and families face in navigating complex healthcare systems, and our mission is to simplify this journey. We strive to provide exceptional medical and support services, ensuring every individual receives the care they deserve, fostering recovery, well-being, and peace of mind.
                        </p>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-30">
                    <div class="about-img">
                        <img style="height: 250px; width: 650px;" src="{{ isset($about->value->image) ? get_image($about->value->image, 'site-section') : asset('path/to/default/image.jpg') }}"
                            alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Leadership Team Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="leadership-team-section pt-80 pb-60 d-none">
        <div class="container">
            <div class="section-header-title text-center pb-40">
                <h2 class="title">
                   Meet Our Leadership Team
                </h2>
            </div>
            <div class="row justify-content-center mb-40-none">
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-40">
                        <div class="team-member-card text-center p-4">
                            <div class="member-img mx-auto mb-4">
                                {{-- Assuming 'image' holds the member's photo and 'name' is used for alt text --}}
                                <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}"
                                     alt="{{ $member->language->$app_local->name ?? ($member->language->$default->name ?? 'Team Member') }}"
                                     class="rounded-circle border border-2 mx-auto" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <h4 class="member-name title mb-1">
                                Dr. Anya Sharma
                            </h4>
                            <p class="member-designation text-muted">
                                Chief Medical Officer
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-40">
                        <div class="team-member-card text-center p-4">
                            <div class="member-img mx-auto mb-4">
                                {{-- Assuming 'image' holds the member's photo and 'name' is used for alt text --}}
                                <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}"
                                     alt="{{ $member->language->$app_local->name ?? ($member->language->$default->name ?? 'Team Member') }}"
                                     class="rounded-circle border border-2 mx-auto" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <h4 class="member-name title mb-1">
                               Mr. Rohan Mehta
                            </h4>
                            <p class="member-designation text-muted">
                                CEO & Founder
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-40">
                        <div class="team-member-card text-center p-4">
                            <div class="member-img mx-auto mb-4">
                                {{-- Assuming 'image' holds the member's photo and 'name' is used for alt text --}}
                                <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}"
                                     alt="{{ $member->language->$app_local->name ?? ($member->language->$default->name ?? 'Team Member') }}"
                                     class="rounded-circle border border-2 mx-auto" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <h4 class="member-name title mb-1">
                                Ms. Priya Singh 
                            </h4>
                            <p class="member-designation text-muted">
                                 Head of Operations 
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-40">
                        <div class="team-member-card text-center p-4">
                            <div class="member-img mx-auto mb-4">
                                {{-- Assuming 'image' holds the member's photo and 'name' is used for alt text --}}
                                <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}"
                                     alt="{{ $member->language->$app_local->name ?? ($member->language->$default->name ?? 'Team Member') }}"
                                     class="rounded-circle border border-2 mx-auto" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <h4 class="member-name title mb-1">
                                Mr. David Lee
                            </h4>
                            <p class="member-designation text-muted">
                                Chief Technology Officer
                            </p>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Leadership Team Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        How to work section
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="how-work-section ptb-40">
    <div class="container">
        <div class="section-tag pb-20">
            <!--<span><i class="las la-heart"></i>-->
            <!--     {{ $faq->value->language->$app_local->title ?? ($faq->value->language->$default->title ?? '') }}-->
            <!--</span>-->
            <div class="row">
                <div class="col-xl-10 col-lg-12">
                    <div class="section-title">
                        <h2 class="title">
                            {{ $faq->value->language->$app_local->heading ?? ($faq->value->language->$default->heading ?? '') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
      @php
    $items =  $faq->value->items ?? [];
    $item_data = (array) $items;

    $part1 = $item_data;

@endphp

    <div class="how-work-area">
        <div class="row mb-20-none">
            <div class="col-lg-12 mb-20">
                <div class="steps-content">
                    <div class="step-listing">
                        <div class="row mb-20-none">
                            @foreach ($part1 ?? [] as $key => $item)
                            <div class="col-lg-3 mb-20">
                                <div class="content">
                                    <h4 class="title">{{ $item->language->$app_local->question ?? ($item->language->$default->title ?? '') }}</h4>
                                    <p>{{ $item->language->$app_local->answer ?? ($item->language->$default->answer ?? '') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</section>

                
                
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Compliance & Security Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="compliance-security-section pt-40 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="title mb-4">
                        Compliance & Security
                    </h2>
                    <p class="text-lg text-secondary">
                        At HealthCare At Home, your privacy and safety are our utmost priority. We adhere to the strictest industry
                        standards and regulations, including **GDPR** and **HIPAA compliance**, to ensure your personal health
                        information is always protected. Our platform employs advanced security measures to safeguard your
                        data, and our services are delivered by certified professionals who follow rigorous safety protocols. You
                        can trust us with your care.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Compliance & Security Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    @include('frontend.section.why-choose-us')
 
@endsection
