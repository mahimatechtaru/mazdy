@php
    // आवश्यक मॉडल्स को इम्पोर्ट करें
    use App\Models\Frontend\FaqCategory;
    use App\Models\Frontend\FaqItem;

    // सभी प्रकाशित FAQ Categories को उनके प्रकाशित Items के साथ प्राप्त करें।
    $categories = FaqCategory::whereHas('items', function ($query) {
        $query->where('is_published', true);
    })
        ->with([
            'items' => function ($query) {
                // केवल प्रकाशित आइटम्स को sort_order के आधार पर लोड करें
                $query->where('is_published', true)->orderBy('sort_order', 'asc');
            },
        ])
        // ⭐️ FIX: display_order को हटाकर 'name' द्वारा ऑर्डर किया गया
        ->orderBy('name', 'asc')
        ->get();

@endphp
@extends('frontend.layouts.master')

@section('content')
    <style>
        .faq-search {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .faq-item {
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            padding: 16px;
            font-size: 18px;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding: 0 16px;
        }

        .faq-answer p {
            margin: 12px 0;
        }

        .faq-item.active .faq-answer {
            max-height: 300px;
        }

        .faq-item.active .icon {
            transform: rotate(45deg);
        }

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
                            Find quick answers to common questions and see what our users have to say about their
                            experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- 1. CATEGORY TABS (डायनामिक) --}}
    <div class="category-tabs pt-40" id="faq-categories">
        @foreach ($categories as $category)
            <button class="tab-button {{ $loop->first ? 'active' : '' }}" data-category="{{ $category->name }}">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    <div class="faq-section">

        <!-- Search Box -->
        <div class="search-bar">
            <input type="text" id="faqSearch" placeholder="Search for answers..." class="faq-search">
        </div>
        <div class="qa-section-wrapper">
            @foreach ($categories as $category)
                <div class="qa-section" data-category-content="{{ $category->name }}"
                    style="{{ $loop->first ? 'display: flex;' : 'display: none;' }}">
                    @foreach ($category->items as $item)
                        <!-- FAQ Item -->
                        <div class="faq-item qa-card">
                            <button class="faq-question">
                                {{ $item->question }}
                                <span class="icon">+</span>
                            </button>
                            <div class="faq-answer">
                                <p>
                                    {!! $item->answer !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <!-- Add more FAQ items here -->

    </div>
@endsection

@push('script')
    <script>
        // Accordion Toggle
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const faqItem = button.parentElement;
                faqItem.classList.toggle('active');
            });
        });

        // Search Function
        document.getElementById('faqSearch').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let faqs = document.querySelectorAll('.faq-item');

            faqs.forEach(faq => {
                let question = faq.querySelector('.faq-question').innerText.toLowerCase();
                let answer = faq.querySelector('.faq-answer').innerText.toLowerCase();

                if (question.includes(searchValue) || answer.includes(searchValue)) {
                    faq.style.display = "block";
                } else {
                    faq.style.display = "none";
                }
            });
        });

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
