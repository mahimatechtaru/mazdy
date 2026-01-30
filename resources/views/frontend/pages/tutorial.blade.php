@php
    // आवश्यक मॉडल्स को इम्पोर्ट करें
    use App\Models\Frontend\FaqCategory;
    use App\Models\Frontend\FaqItem;

@endphp
<style>
    /* HERO */
    .hero {
        background: linear-gradient(135deg, #5c76f4, #253aa1);
        color: #fff;
        padding: 70px 0;
    }

    .hero h1 {
        font-size: 42px;
    }

    .hero p {
        font-size: 18px;
        margin-top: 10px;
    }

    /* TABS */
    .tabs {
        display: flex;
        justify-content: center;
        margin-top: -30px;
    }

    .tabs button {
        background: #fff;
        border: none;
        padding: 15px 30px;
        font-size: 16px;
        cursor: pointer;
        margin: 0 5px;
        border-radius: 6px 6px 0 0;
        font-weight: 600;
    }

    .tabs button.active {
        background: linear-gradient(135deg, #5c76f4, #253aa1);
        color: #fff;
    }

    /* CONTENT */
    .tab-content {
        display: none;
        background: #fff;
        padding: 50px 40px;
        border-radius: 0 0 10px 10px;
    }

    .tab-content.active {
        display: block;
    }

    .section-title {
        font-size: 28px;
        margin-bottom: 20px;
    }

    /* STEPS */
    .steps {
        display: block;
        /*grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px; */
    }

    .step {
        background: #f9fafc;
        padding: 25px;
        border-radius: 10px;
        border: 1px solid #5b2dbf;
        box-shadow: 5px 5px;
        width: 42%;
        float: left;
        margin: 15px;

    }

    .step h4 {
        margin: 0 0 10px;
    }

    .step i {
        color: #5b2dbf;
        margin-right: 8px;
    }

    .qa-section-wrapper {
        border-top: 2px solid;
        padding: 10px;
        margin: 20px 0;
    }

    .qa-section {
        flex-direction: column;
        gap: 15px;
    }

    .qa-card {
        background-color: #f6f6f6;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 5px;
    }

    .video-wrapper {
        /* height: 100vh;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center; */
        min-width: 1200px;
    }

    /* DEFAULT (PC / Laptop) */
    .video-wrapper video {
        width: 100%;
        min-height: 500px;
        object-fit: contain;
        /* âœ… NO CUT */
        border-radius: 15px;
        background-color: #000;
    }

    /* LARGE DESKTOPS */
    @media (min-width: 1400px) {
        .video-wrapper video {
            // max-height: 380px;
        }
    }

    /* MOBILE ONLY */
    @media (max-width: 768px) {
        .video-wrapper video {
            width: auto;
            height: 100%;
            max-height: none;
            object-fit: cover;
            /* looks better on mobile */
        }
    }

    /* Desktop & laptop */
    @media (min-width: 992px) {

        .video-wrapper video {
                {
                width: auto;
            }
        }
</style>
@extends('frontend.layouts.master')

@section('content')
    <!-- HERO -->
    <div class="hero">
        <div class="container">
            <h1 class="text-white">Tutorials – How Medzy Works</h1>
            <p>Step-by-step guidance for Patients, Hospitals, and Healthcare Providers</p>
        </div>
    </div>

    <!-- TABS -->
    <div class="container">
        <div class="tabs">
            <button class="tab-btn active" onclick="openTab('patient')">Customer</button>
            <button class="tab-btn" onclick="openTab('provider')">Provider</button>
            <button class="tab-btn" onclick="openTab('hospital')">Hospital</button>
        </div>

        <!-- PATIENT VIEW -->
        <div id="patient" class="tab-content active">
            <h2 class="section-title">Customer(Patients & Families)</h2>
            @php
                $users = FaqCategory::whereHas('items', function ($query) {
                    $query->where('is_published', true);
                })
                    ->with([
                        'items' => function ($query) {
                            $query->where('is_published', true)->orderBy('sort_order', 'asc');
                        },
                    ])
                    ->where('id', 6)
                    ->orderBy('name', 'asc')
                    ->get();

            @endphp


            <div class="steps row justify-content-center">
                <div class="step col-5">
                    <h4><i class="fa fa-user-plus"></i> Register / Login</h4>
                    <p>Create an account using mobile number or email with OTP verification.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-users"></i> Add Family Members</h4>
                    <p>Manage healthcare for parents, children, or dependents from one dashboard.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-list"></i> Choose Service</h4>
                    <p>Select ICU at Home, Nursing Care, Doctor Visits, Diagnostics, or Equipment.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-calendar-check"></i> Book & Schedule</h4>
                    <p>Choose date, time, duration, and location with transparent pricing.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-house-medical"></i> Receive Care</h4>
                    <p>Verified professionals deliver hospital-grade care at home.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-file-medical"></i> Reports & Support</h4>
                    <p>Access reports, prescriptions, invoices, and 24×7 support.</p>
                </div>
            </div>

            <div class="col-8 pt-40">
                <div class="video-wrapper">
                    <!--<video autoplay muted loop>-->
                    <video autoplay muted loop controls playsinline>
                        <!--<source src="video.mp4" type="video/mp4">-->
                        <source src="{{ asset('backend/images/web-settings/image-assets/medzy_user_video.mp4') }}"
                            type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="qa-section-wrapper">
                <h2 class="text-[#031432] text-center font-poppins text-[32px] font-semibold leading-normal mb-6">
                    Frequently Asked Questions</h2>
                @foreach ($users as $category)
                    <div class="qa-section" data-category-content="{{ $category->name }}"
                        style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">

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

        <!-- HOSPITAL VIEW -->
        <div id="hospital" class="tab-content">
            <h2 class="section-title">Hospital View</h2>

            <div class="steps row justify-content-center">
                <div class="step col-5">
                    <h4><i class="fa fa-hospital"></i> Hospital Onboarding</h4>
                    <p>Register hospital, verify credentials, and configure services.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-stethoscope"></i> List Services</h4>
                    <p>Offer ICU at Home, post-surgery care, diagnostics, and specialist visits.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-bell"></i> Receive Requests</h4>
                    <p>Get real-time patient requests based on location and availability.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-user-doctor"></i> Assign Teams</h4>
                    <p>Allocate doctors, nurses, and technicians digitally.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-chart-line"></i> Monitor Care</h4>
                    <p>Track service delivery, outcomes, and patient feedback.</p>
                </div>

                <div class="step col-5">
                    <h4><i class="fa fa-file-invoice"></i> Billing & Reports</h4>
                    <p>Automated billing, analytics, and performance reports.</p>
                </div>
            </div>
            <div class="col-8  text-center">

                <div class="video-wrapper">
                    <!--<video autoplay muted loop>-->
                    <video autoplay muted loop controls playsinline>
                        <!--<source src="video.mp4" type="video/mp4">-->
                        <source src="{{ asset('backend/images/web-settings/image-assets/medzy_hospital_video.mp4') }}"
                            type="video/mp4">
                    </video>
                </div>
            </div>
            @php
                // सभी प्रकाशित FAQ Categories को उनके प्रकाशित Items के साथ प्राप्त करें।
                $hospitals = FaqCategory::whereHas('items', function ($query) {
                    $query->where('is_published', true);
                })
                    ->with([
                        'items' => function ($query) {
                            // केवल प्रकाशित आइटम्स को sort_order के आधार पर लोड करें
                            $query->where('is_published', true)->orderBy('sort_order', 'asc');
                        },
                    ])
                    ->where('id', 7)
                    // ⭐️ FIX: display_order को हटाकर 'name' द्वारा ऑर्डर किया गया
                    ->orderBy('name', 'asc')
                    ->get();

            @endphp
            <div class="qa-section-wrapper">
                <h2 class="text-[#031432] text-center font-poppins text-[32px] font-semibold leading-normal mb-6">
                    Frequently Asked Questions</h2>
                @foreach ($hospitals as $category)
                    <div class="qa-section" data-category-content="{{ $category->name }}"
                        style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">

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

        <!-- PROVIDER VIEW -->
        <div id="provider" class="tab-content">
            <h2 class="section-title">Provider View (Doctors, Nurses, Labs, Ambulance, Pharmacy)</h2>

            <div class="steps row justify-content-center">
                <div class="step">
                    <h4><i class="fa fa-id-card"></i> Provider Registration</h4>
                    <p>Submit credentials, certifications, and availability.</p>
                </div>

                <div class="step">
                    <h4><i class="fa fa-check-circle"></i> Verification</h4>
                    <p>Medzy verifies qualifications to ensure patient safety.</p>
                </div>

                <div class="step">
                    <h4><i class="fa fa-bell"></i> Accept Assignments</h4>
                    <p>Receive nearby service requests matching expertise.</p>
                </div>

                <div class="step">
                    <h4><i class="fa fa-user-nurse"></i> Deliver Care</h4>
                    <p>Provide professional care at home or hospital-assigned locations.</p>
                </div>

                <div class="step">
                    <h4><i class="fa fa-clipboard"></i> Update Records</h4>
                    <p>Upload vitals, treatment notes, and service updates.</p>
                </div>

                <div class="step">
                    <h4><i class="fa fa-wallet"></i> Payments & Support</h4>
                    <p>Transparent payouts with dedicated provider assistance.</p>
                </div>
            </div>
            <div class="col-8  text-center">

                <div class="video-wrapper">
                    <!--<video autoplay muted loop>-->
                    <video autoplay muted loop controls playsinline>
                        <!--<source src="video.mp4" type="video/mp4">-->
                        <source src="{{ asset('backend/images/web-settings/image-assets/medzy_vendor_video.mp4') }}"
                            type="video/mp4">
                    </video>
                </div>
            </div>
            @php
                // सभी प्रकाशित FAQ Categories को उनके प्रकाशित Items के साथ प्राप्त करें।
                $Provider = FaqCategory::whereHas('items', function ($query) {
                    $query->where('is_published', true);
                })
                    ->with([
                        'items' => function ($query) {
                            // केवल प्रकाशित आइटम्स को sort_order के आधार पर लोड करें
                            $query->where('is_published', true)->orderBy('sort_order', 'asc');
                        },
                    ])
                    ->where('id', 8)
                    // ⭐️ FIX: display_order को हटाकर 'name' द्वारा ऑर्डर किया गया
                    ->orderBy('name', 'asc')
                    ->get();

            @endphp

            <div class="qa-section-wrapper">
                <h2 class="text-[#031432] text-center font-poppins text-[32px] font-semibold leading-normal mb-6">
                    Frequently Asked Questions</h2>
                @foreach ($Provider as $category)
                    <div class="qa-section" data-category-content="{{ $category->name }}"
                        style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">

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




        <!-- CTA -->

        @include('frontend.section.medzy-section')


    </div>
@endsection
<script>
    function openTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        event.target.classList.add('active');
    }
</script>
