@php
    use App\Models\Package;
    use App\Models\Service;
    use App\Models\Frontend\FaqCategory; // Assumed model
    use App\Models\Frontend\FaqItem; // Assumed model

    $categoryIds = FaqCategory::whereHas('items', function ($query) {
        $query->where('is_published', true);
    })
        ->limit(4)
        ->pluck('id');

    $faqs = collect();
    foreach ($categoryIds as $categoryId) {
        $faq = FaqItem::where('category_id', $categoryId)
            ->where('is_published', true)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($faq) {
            $faqs->push($faq);
        }
    }

    $subscriptionPlans = Package::where('is_active', 1)->orderBy('price', 'asc')->get();
    $services = Service::all();

@endphp
@extends('frontend.layouts.master')

@section('content')
    <style>
        /* --- Global Styles --- */
        body {
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }

        section {
            padding: 40px 5%;
            text-align: center;
        }

        h1 {
            font-size: 37px;
        }

        h2 {
            font-size: 2em;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
        }

        h3 {
            font-size: 1.5em;
            color: #1a1a1a;
        }

        .btn-primary {
            background: linear-gradient(to right, #637DFE, #203499);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .details-link {
            display: inline-block;
            color: #000;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95em;
        }

        /* --- 1. Hero Section --- */
        .hero {
            padding: 60px 5%;
        }

        .hero p {
            font-size: 1.1em;
            color: #777;
            margin-bottom: 30px;
        }

        .hero-image-placeholder {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #007bff50, #9fd5ff);
            border-radius: 10px;
        }


        /* --- 2. Subscription Plans Section --- */
        .plans-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .plan-card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            /* Layout adjustments for equal rows (simulating lg-4) */
            flex: 1 1 25%;
            max-width: 375px;
            min-width: 350px;

            text-align: left;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            /* Flex for internal content alignment (buttons stay at bottom) */
            display: flex;
            flex-direction: column;
            margin: 15px;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .plan-card.popular {
            border: 3px solid #203499;
            padding-top: 40px;
        }

        .popular-tag {
            position: absolute;
            top: 0;
            right: 0;
            background: linear-gradient(to right, #637DFE, #203499);
            color: white;
            font-size: 0.8em;
            font-weight: bold;
            padding: 5px 15px;
            border-bottom-left-radius: 10px;
            border-top-right-radius: 7px;
        }

        .plan-card .price {
            font-size: 2.5em;
            font-weight: 800;
            background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            margin: 10px 0 20px;
        }

        .plan-card .price span {
            font-size: 0.4em;
            font-weight: 400;
            color: #555;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            flex-grow: 1;
            /* Pushes the button area down for equal height */
        }

        .features-list li {
            padding: 8px 0;
            font-size: 1em;
            color: #333;
            border-bottom: 1px dashed #eee;
        }

        .features-list i {
            color: #203499;
            margin-right: 10px;
        }

        .ideal-for {
            font-size: 0.9em;
            color: #888;
            margin-bottom: 15px;
            min-height: 40px;
        }


        /* --- 3. Individual Service Pricing Section --- */
        .services-section {
            background-color: white;
        }

        .pricing-table-container {
            overflow-x: auto;
            width: 90%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            min-width: 600px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 15px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #e9f5ff;
            color: #1a1a1a;
            font-weight: 700;
            font-size: 0.9em;
            text-transform: uppercase;
            border-bottom: 2px solid #203499;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .disclaimer {
            font-size: 0.8em;
            color: #888;
            margin-top: 20px;
            text-align: center;
        }


        /* --- 4. Payment Options & FAQs Section --- */
        .faq-section {
            background-color: #fff;
            padding-bottom: 60px;
        }

        .payment-options-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 25px;
            max-width: 800px;
            margin: 30px auto;
            text-align: left;
        }

        .payment-options-box h3 {
            margin-top: 0;
            color: #203499;
        }

        .faq-container {
            max-width: 800px;
            margin: 40px auto 0;
            text-align: left;
        }

        .faq-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-item summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            font-weight: 600;
            font-size: 1.1em;
            cursor: pointer;
            list-style: none;
            color: #333;
        }

        .faq-item p {
            padding: 0 15px 15px;
            margin: 0;
            color: #555;
            border-top: 1px solid #eee;
        }

        .plans-slider {
            padding: 20px 0 50px;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
        }

        .plan-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 320px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .plan-card.highlight {
            background: #e8f1ff;
            border: 2px solid #0b5ed7;
        }

        .price {
            font-weight: 600;
            margin: 10px 0 15px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #0b5ed7;
        }

        .swiper-pagination-bullet-active {
            background: #0b5ed7;
        }


        /* Mobile adjustment for plan cards */
        @media (max-width: 950px) {
            .plan-card {
                flex: 1 1 100%;
                max-width: 450px;
            }
        }
    </style>
    <header class="hero">
        <h1>Flexible Care Plans for Every Need.</h1>
        <p>Choose from our curated packages or pay-per-service options.</p>
        <!--<div class="hero-image-placeholder">-->
        <!--    </div>-->
    </header>

    @include('frontend.pages.ccu')
    {{-- @include('frontend.section.ourplan') --}}

    <section class="plans-section">
        <div class="container">
            <h2 class="section-title">Subscription Plans</h2>

            <div class="swiper plans-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">

                        @foreach ($subscriptionPlans as $plan)
                            <div class="plan-card">


                                @if ($plan->badge)
                                    <div class="popular-tag">{{ $plan->badge }}</div>
                                @endif

                                <h3>{{ $plan->name }}</h3>

                                <p class="price">
                                    ₹{{ number_format($plan->price, 0) }}
                                    <span>/{{ $plan->duration ?? 'month' }}</span>
                                </p>

                                <ul class="features-list">
                                    @if ($plan->inclusions)
                                        @php
                                            $featureList = explode(',', $plan->inclusions);
                                        @endphp

                                        @foreach ($featureList as $inclusion)
                                            <li><i class="fas fa-check-circle"></i> {{ trim($inclusion) }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                                <p class="ideal-for">{{ $plan->target_audience ?? $plan->short_description }}</p>

                                <button class="btn-primary">Subscribe Now</button>
                                <a href="#" class="btn-details details-link">View Detailed Breakdown</a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <!-- Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>
        <p class="note">
            *Additional charges applicable as per service provider and medical requirement.
        </p>
        </div>


    </section>


    @include('frontend.pages.service_faq')
@endsection



@push('script')
    <script>
        var swiper = new Swiper(".plans-slider", {
            slidesPerView: 1,
            spaceBetween: 70,
            loop: false,
            autoplay: {
                delay: 40000,
                disableOnInteraction: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 1,
                },
                1224: {
                    slidesPerView: 2,
                }
            }
        });
    </script>
@endpush
