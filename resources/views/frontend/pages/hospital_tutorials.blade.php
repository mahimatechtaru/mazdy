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
        ->where('id', 3)
        // ⭐️ FIX: display_order को हटाकर 'name' द्वारा ऑर्डर किया गया
        ->orderBy('name', 'asc')
        ->get();

@endphp
<style>
    .sub-container {
        max-width: 1500px !important;
        margin: 0 auto;
        padding: 20px;
    }

    .sub-section {
        background-color: #fff !important;
    }

    .sub-section-title,
    .sub-section-contant {
        display: block;
        font-size: 20px;
        font-weight: 600;
        color: #293ea6;
        margin-bottom: 20px;
        border: 2px solid;
        background: #dfe4ff;
        padding: 10px;
    }

    .qa-section,
    .qa-sub-section,
    .sub-content {
        min-width: 1200px;
    }

    @media (min-width:1025px) and (max-width:1330px) {

        .qa-section,
        .qa-sub-section,
        .sub-content {
            min-width: 1000px;
        }
    }

    @media (min-width:768px) and (max-width:1024px) {

        .qa-section,
        .qa-sub-section,
        .sub-content {
            min-width: 800px;
        }
    }

    @media (min-width:441px) and (max-width:769px) {

        .qa-section,
        .qa-sub-section,
        .sub-content {
            min-width: 350px;
        }
    }

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
<section class="sub-section">
    <div class="sub-container">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Steps to Join
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @include('user.auth.steps')
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How to Book Services
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="feature-description">
                            Go To <b>Care Packages</b> section and
                            Browse available packages and select the one that suits your needs.
                            Log in or sign up, then enter patient and location details.
                            Complete the online payment to confirm your booking.
                            You’ll receive confirmation and care will be scheduled as per your plan.
                        </p>
                        <p class="feature-description mt-2">
                            Booking a healthcare package on MedzyHealth is a simple and user-friendly process
                            designed
                            to make quality medical care accessible from the comfort of your home. To get
                            started, visit
                            the official MedzyHealth website and navigate to the Care Packages section from the
                            main
                            menu. Here, you will find a wide range of thoughtfully curated healthcare packages
                            that
                            cater to different needs, such as post-hospital recovery, elderly care, long-term
                            nursing
                            support, ICU setup at home, and preventive healthcare plans. Each package clearly
                            lists the
                            services included, duration, benefits, and pricing, allowing you to compare options
                            and
                            choose the one that best suits your medical requirements and budget.</p>
                        <p class="feature-description mt-2">
                            Once you have selected a suitable package, click on the Subscribe Now or Book
                            Package button
                            to proceed. If you are an existing user, simply log in using your registered mobile
                            number
                            or email. New users can quickly sign up by providing basic details and completing a
                            secure
                            verification process. After logging in, you will be asked to enter patient
                            information such
                            as name, age, contact details, service address, preferred start date, and any
                            specific
                            health concerns. Providing accurate details helps MedzyHealth assign the right
                            healthcare
                            professionals and ensure smooth service delivery.</p>
                        <p class="feature-description mt-2">
                            The final step is completing the payment through MedzyHealth’s secure online payment
                            gateway, which supports UPI, debit cards, credit cards, and other digital payment
                            options.
                            Once the payment is successful, your package booking is confirmed instantly. You
                            will
                            receive confirmation details along with information about the assigned care team and
                            service
                            schedule. MedzyHealth’s care coordination team stays in touch to ensure timely
                            service
                            delivery, ongoing support, and a seamless healthcare experience. With transparent
                            pricing,
                            verified providers, and end-to-end assistance, booking packages on MedzyHealth
                            offers peace
                            of mind and dependable healthcare at your doorstep.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How to Avail Services
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="feature-description">Go To <b>Our services</b> section and choose the
                            healthcare
                            service you need.</p>
                        <p class="feature-description">Availing healthcare services through MedzyHealth is
                            designed to
                            be simple, reliable, and
                            completely hassle-free for patients and their families. To begin, users can visit
                            medzyhealth.com and explore a wide range of home-based healthcare services,
                            including doctor
                            consultations, nursing care, ICU setup at home, medical equipment rentals, elderly
                            care,
                            diagnostic tests, and specialized care packages. Each service page provides clear
                            information about what is included, helping users make informed decisions based on
                            their
                            medical needs. Once the required service is selected, users can click on the Book
                            Now or
                            Subscribe option to proceed. MedzyHealth allows both registered and new users to
                            continue
                            seamlessly by logging in or signing up using a mobile number or email, ensuring
                            quick access
                            without complicated processes.</p>
                        <p class="feature-description ">After logging in, users are guided to provide essential
                            details
                            such as patient information, service location, preferred date and time, and any
                            specific
                            medical requirements. This information helps MedzyHealth assign the most suitable
                            and
                            verified healthcare professionals, including doctors, nurses, therapists, or
                            technicians.
                            Users can then securely complete the booking by making an online payment through
                            trusted
                            options like UPI, debit cards, credit cards, or digital wallets. Once the booking is
                            confirmed, users receive instant confirmation along with service details and
                            timelines.
                            MedzyHealth’s dedicated care coordination team follows up to ensure smooth service
                            delivery,
                            timely provider arrival, and continuous support throughout the care period. With its
                            integrated ecosystem and patient-centric approach, MedzyHealth ensures high-quality
                            healthcare services delivered safely and comfortably at home, giving families peace
                            of mind
                            and dependable medical support when they need it most.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                        FAQ's
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="qa-section-wrapper">
                            @foreach ($categories as $category)
                                <div class="qa-section" data-category-content="{{ $category->name }}"
                                    style="min-width: 80%;{{ $loop->first ? 'display: flex;' : 'display: none;' }}">

                                    @if ($category->items->isEmpty())
                                        <div class="qa-card">
                                            <p class="text-center">
                                                {{ __('No questions published in this category yet.') }}</p>
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
            </div>
        </div>

        <div class="video-wrapper mt-5">
            <!--<video autoplay muted loop>-->
            <video autoplay muted loop controls playsinline>
                <!--<source src="video.mp4" type="video/mp4">-->
                <source src="{{ asset('backend/images/web-settings/image-assets/medzy_vendor_video.mp4') }}"
                    type="video/mp4">
            </video>
        </div>
</section>
