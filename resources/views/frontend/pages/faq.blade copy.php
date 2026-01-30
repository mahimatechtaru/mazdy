@php
// आवश्यक मॉडल्स को इम्पोर्ट करें
use App\Models\Frontend\FaqCategory;
use App\Models\Frontend\FaqItem;

// सभी प्रकाशित FAQ Categories को उनके प्रकाशित Items के साथ प्राप्त करें।
$categories = FaqCategory::whereHas('items', function ($query) {
$query->where('is_published', true);
})
->with(['items' => function ($query) {
// केवल प्रकाशित आइटम्स को sort_order के आधार पर लोड करें
$query->where('is_published', true)
->orderBy('sort_order', 'asc');
}])
// ⭐️ FIX: display_order को हटाकर 'name' द्वारा ऑर्डर किया गया
->orderBy('name', 'asc')
->get();

@endphp
@extends('frontend.layouts.master')

@section('content')
<style>
    .faq-container {
        max-width: 900px;
        margin: 0 auto;
        /* Center the content */
        padding: 20px;
    }

    .faq-title {
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
<!-- about section -->
<section class="about-section pt-40">
    <div class="container">
        <div class="section-tag">
            <span><i class="las la-heart"></i>
                FAQ's</span>
        </div>
        <div class="row mb-30-none">
            <div class="col-lg-12 mb-30">
                <div class="about-content">
                    <h2 class="title">
                        Your Questions, Answered.
                    </h2>
                    <p class="sub-title">
                        Find quick answers to common questions and see what our users have to say about their experience.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-60">
    <div class="container">
        <div class="section-tag">
            <h3 class="title text-center">
                Frequently Asked Questions
            </h3>

            <div class="search-bar">
                <input type="text" placeholder="Search for answers...">
            </div>

            {{-- 1. CATEGORY TABS (डायनामिक) --}}
            <div class="category-tabs" id="faq-categories">
                @foreach ($categories as $category)
                <button class="tab-button {{ $loop->first ? 'active' : '' }}"
                    data-category="{{ $category->name }}">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>

            {{-- 2. Q&A SECTIONS (डायनामिक) --}}
            <div class="qa-section-wrapper">
                @foreach ($categories as $category)
                <div class="qa-section"
                    data-category-content="{{ $category->name }}"
                    style="{{ $loop->first ? 'display: flex;' : 'display: none;' }}">

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
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Leadership Team Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="leadership-team-section pt-80 pb-60">
    <div class="container">
        <div class="section-tag">
            <span><i class="las la-heart"></i>
                User's</span>
        </div>
        <div class="section-header-title pb-40">
            <h2 class="title">
                What Our Users Say
            </h2>
        </div>
        <div class="row justify-content-center mb-40-none">
            {{-- Loop through your members/testimonials here --}}
            {{-- For demonstration, here's one card --}}
            <div class="col-xl-3 col-lg-3 col-md-6 mb-40">
                <div class="team-member-card text-center p-4">
                    <div class="member-img mx-auto mb-4">
                        {{-- Replace with actual image source --}}
                        <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}" alt="Sarah L."
                            class="rounded-circle border border-2 mx-auto" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <p class="member-designation">
                        "This platform has revolutionized how I manage my health appointments. The booking process is seamless, and I always find highly qualified providers. Truly a game-changer!"
                    </p>
                    <div class="testimonial-info">
                        <h4 class="testimonial-author title mb-1">
                            Sarah L.
                        </h4>
                        <p class="testimonial-role text-muted">
                            Patient
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 mb-40">
                <div class="team-member-card text-center p-4">
                    <div class="member-img mx-auto mb-4">
                        <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}" alt="Dr. Alex M."
                            class="rounded-circle border border-2 mx-auto" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <p class="member-designation">
                        "As a healthcare provider, joining this platform has significantly expanded my reach and streamlined my practice. The administrative tools are intuitive and efficient."
                    </p>
                    <div class="testimonial-info">
                        <h4 class="testimonial-author title mb-1">
                            Dr. Alex M.
                        </h4>
                        <p class="testimonial-role text-muted">
                            Provider
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 mb-40">
                <div class="team-member-card text-center p-4">
                    <div class="member-img mx-auto mb-4">
                        <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}" alt="David R."
                            class="rounded-circle border border-2 mx-auto" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <p class="member-designation">
                        "I was skeptical at first, but the ease of finding specialized care and managing my family's health records in one place is incredible. Highly recommend!"
                    </p>
                    <div class="testimonial-info">
                        <h4 class="testimonial-author title mb-1">
                            David R.
                        </h4>
                        <p class="testimonial-role text-muted">
                            Patient
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-40">
                <div class="team-member-card text-center p-4">
                    <div class="member-img mx-auto mb-4">
                        <img src="{{ get_image($member->image ?? null, 'site-section') ?? 'path/to/default/avatar.png' }}" alt="David R."
                            class="rounded-circle border border-2 mx-auto" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <p class="member-designation">
                        "The support team is fantastic! They helped me resolve an issue quickly and professionally. It's great to know there's reliable help when you need it."
                    </p>
                    <div class="testimonial-info">
                        <h4 class="testimonial-author title mb-1">
                            Emily C.
                        </h4>
                        <p class="testimonial-role text-muted">
                            Patient
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Leadership Team Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
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