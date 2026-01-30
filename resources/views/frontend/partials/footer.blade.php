@php
    // Existing PHP variables are kept but their output is replaced with static content below.
    $app_local = get_default_language_code();
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FOOTER_SECTION);
    $footer = App\Models\Admin\SiteSections::getData($slug)->first();
    $usefull_links = App\Models\Admin\UsefulLink::where('status', true)->get();
    $contact = App\Models\Admin\SiteSections::getData('contact')->first();
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::STATISTICS);
    $services = App\Models\ServicesCategory::all();

@endphp
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<footer class="footer-section bg-overlay-footer bg_img"
    data-backgrounds="{{ asset('frontend/images/element/footer-bg.webp') }}">
    <div class="custom-container">
        <div class="footer-area">
            {{-- <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-10 col-md-12">
                    <h3>HealthCare At Home</h3>
                    <p>Your Trusted Partner for Quality Home Healthcare Services</p>

                </div>
            </div> --}}

            <div class="row footer-columns justify-content-left ">
                <div class="col-md-3 col-6 border_right">
                    <div class="footer-logo">
                        <a href="https://medzyhealth.com/"> <img src="{{ get_logo($basic_settings, 'dark') }}"
                                alt="logo"></a>
                        <div class="footer-links">
                            <li class="text-left"><a href="tel:{{ $contact->value->phone ?? '' }}"><i
                                        class="fas fa-phone-alt"></i>{{ $contact->value->phone ?? '' }}</a>
                            </li>
                            <li><a href="mailto:{{ $contact->value->email ?? '' }}"><i
                                        class="fas fa-envelope"></i>{{ $contact->value->email ?? '' }}</a>
                            </li>
                            <li class="text-left"><a href="#"><i
                                        class="fas fa-map-marker-alt"></i>{{ $contact->value->address ?? '' }}</a></li>

                        </div>
                        <div class="text-left mt-3">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>


                </div>

                <!-- Column 2: Company -->
                <div class="col-md-2 col-6 mt-4 mt-md-0 border_right">
                    <h5 class="column-title">Company</h5>
                    <ul class="footer-links">
                        <li><a href="https://medzyhealth.com/about">About Us</a></li>
                        <li><a href="https://medzyhealth.com/contact">Contact Us</a></li>
                        <li><a href="https://medzyhealth.com/faq">FAQs</a></li>
                        <li><a href="#privacy-policy">Privacy Policy</a></li>
                        <li><a href="#terms-conditions">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Column 3: Services -->
                <div class="col-md-2 col-6 mt-4 mt-md-0 border_right">
                    <h5 class="column-title">Services</h5>
                    <ul class="footer-links">
                        <li><a href="https://medzyhealth.com/our-services">Our Services</a></li>
                        <li><a href="https://medzyhealth.com/care-packages">Care Packages</a></li>
                        <li><a href="https://medzyhealth.com/find-doctor">Book a Service</a></li>
                    </ul>
                </div>

                <!-- Column 4: For Providers -->
                <div class="col-md-2 col-6 mt-4 mt-md-0 border_right">
                    <h5 class="column-title">Join Us As</h5>
                    <ul class="footer-links">
                        @foreach ($services as $service)
                            @php

                                // dd($service->name);
                                $title = $service->name ?? '';
                            @endphp
                            <li><a href="{{ url('/join-provider?category=' . $service->name) }}">{{ __($title) }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Column 5: Tutorials -->
                <div class="col-md-2 col-6 mt-4 mt-md-0">
                    <h5 class="column-title">Tutorials</h5>
                    <ul class="footer-links">
                        <li><a href="https://medzyhealth.com/tutorials">How Madzy Works</a></li>
                        <li><a href="https://medzyhealth.com/tutorials">Joining Benefits</a></li>
                        <li><a href="https://medzyhealth.com/tutorials">How to join</a></li>

                    </ul>
                </div>
            </div>

            <!-- Copyright Area (Modified to static content) -->
            <div class="copyright-area">
                <div class="left-side">
                    <!-- The copyright text is now static as per the new image -->
                    <div class="copyright-text">
                        <p>&copy; {{ date('Y') }} HealthCare At Home. All rights reserved.</p>
                    </div>
                </div>
                <!-- The right side is emptied as the new footer design doesn't have links there -->
                <div class="right-side">
                    <div class="page-link-item">
                        <!-- Links removed as per new static design -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Optional CSS additions to better match the multi-column look if your
    existing footer CSS is not column-based (assuming the new columns are centered on mobile).
*/
    .footer-area {
        padding-top: 50px !important;
        padding-bottom: 30px;
    }

    .footer-area h3 {
        color: #3bc1ef;
    }

    .footer-columns {
        padding-bottom: 50px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        /* Separator line above copyright */
    }

    .column-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #3bc1ef;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .text-left {
        text-align: left;
    }

    .footer-links li a {
        text-decoration: none;
        line-height: 2.2;
        transition: color 0.3s;
    }

    .footer-links li a {
        text-decoration: none;
        line-height: 2.2;
        transition: color 0.3s;
    }

    .footer-links li a i {
        margin-right: 10px;
    }

    .footer-links li a:hover {
        color: #637DFE;
    }

    /* Ensure copyright text is centered on mobile for the new layout */
    @media (max-width: 768px) {
        .footer-columns .col-md-2 {
            text-align: center;
        }

        .footer-columns .col-md-2:nth-child(even) {
            /* Add some space between rows on mobile */
            margin-bottom: 20px;
        }

        .copyright-area .left-side,
        .copyright-area .right-side {
            width: 100%;
            text-align: center;
        }
    }
</style>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
