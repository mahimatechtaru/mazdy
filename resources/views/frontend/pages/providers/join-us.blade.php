 @extends('frontend.layouts.master')

 @section('content')
     <style>
         /* Basic Typography (Ensure these are in your main CSS file) */

         /* Header/Hero Section Styling */
         .hero-section {
             padding: 60px 5%;
         }

         .hero-section h1 {
             font-size: 37px;
         }

         .hero-section p {
             font-size: 1.1em;
             color: #777;
             margin-bottom: 30px;
         }

         .why-partner-section {
             padding: 80px 20px;
         }

         .why-partner-section h2 {
             font-size: 33px;
             margin-bottom: 50px;
         }

         /* 4-Column Grid for Features */
         .features-grid {
             display: grid;
             /* On desktop, 4 columns; minmax ensures responsiveness */
             grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
             gap: 20px;
             max-width: 1200px;
             margin: 0 auto;
             text-align: left;
         }

         .feature-box {
             background: #ffffff;
             padding: 30px;
             border-radius: 15px;
             text-align: left;
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
             transition: transform 0.3s, box-shadow 0.3s;
         }

         .feature-box:hover {
             transform: translateY(-5px);
             box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
         }

         .feature-box h3 {
             font-size: 1.3em;
             font-weight: 600;
             color: #333;
         }

         /* Media Query for responsiveness */
         @media (max-width: 768px) {
             .features-grid {
                 grid-template-columns: repeat(2, 1fr);
                 /* 2 columns on tablets */
             }
         }

         .who-can-join-section {
             padding: 0px 20px;
         }

         .who-can-join-section h2 {
             font-size: 2em;
             margin-bottom: 50px;
         }

         /* Flexbox layout to arrange and wrap provider boxes */
         .provider-types-grid {
             display: flex;
             flex-wrap: wrap;
             justify-content: center;
             /* Center the boxes horizontally */
             gap: 15px;
             max-width: 1000px;
             margin: 0 auto;
         }

         .provider-type-box {
             background: #f0f0f0;
             /* Slightly darker light gray */
             padding: 12px 25px;
             border-radius: 4px;
             font-weight: 500;
             font-size: 1em;
             color: #333;
             /* Use display: block/inline-block/flex to apply padding */
             display: inline-block;
         }

         /* --- REQUIRED DOCUMENTS SECTION --- */
         .requirements-section {
             padding: 80px 20px;
             text-align: center;
             /* Center the main heading */
         }

         .requirements-section h2 {
             font-size: 33px;
             /* Matches the size you used for other headings */
             margin-bottom: 50px;
             font-weight: 700;
         }

         .requirements-list {
             max-width: 800px;
             /* Constrains the width for readability */
             margin: 0 auto 40px auto;
             /* Center the list container */
             text-align: left;
             /* Align the content inside the container to the left */
         }

         .requirements-list h3 {
             font-size: 1.25em;
             font-weight: 600;
             margin-bottom: 15px;
             color: #444;
         }

         .btn-book {
             background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
             color: white;
             padding: 8px 15px;
             border-radius: 8px;
             text-decoration: none;
             font-weight: 600;
             font-size: 0.9em;
             border: none;
             white-space: nowrap;
         }

         .btn-book:hover {
             opacity: 0.9;
             color: white;
         }

         .requirements-list ul {
             list-style-type: none;
             /* Remove default bullets */
             padding: 0;
             margin: 0;
         }

         .requirements-list ul li {
             padding-left: 1.5em;
             /* Space for custom bullet */
             margin-bottom: 15px;
             /* Spacing between list items */
             position: relative;
             line-height: 1.6;
             color: #333;
         }

         /* Custom Bullet Point (using a small filled circle) */
         .requirements-list ul li::before {
             content: '•';
             color: #007bff;
             /* Use your primary brand color (blue) for the bullet */
             font-weight: bold;
             display: inline-block;
             width: 1em;
             margin-left: -1em;
             position: absolute;
             left: 0;
             top: 0;
             font-size: 1.2em;
             /* Makes the bullet slightly larger */
         }

         /* Styling for the bolded item type names (e.g., Doctors, Nurses) */
         .requirements-list ul li strong {
             font-weight: 700;
             color: #333;
             /* Ensure they stand out */
         }

         .faq-section {
             text-align: center;
             padding-top: 60px;
             padding-bottom: 60px;
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

             margin-bottom: 20px;
         }

         /* DEFAULT (PC / Laptop) */
         .video-wrapper video {
             width: 100%;
             height: auto;
             max-height: 500px;
             object-fit: contain;
             ;
             /* âœ… NO CUT */
             border-radius: 10px;
             background: #fff;
             /* prevents white gaps */
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
                 // width: auto;
                 height: 100%;
                 max-height: none;
                 object-fit: cover;
                 /* looks better on mobile */
             }

         }

         /* Desktop & laptop */
         @media (min-width: 992px) {
             .video-wrapper {
                 // margin-top: 30px;   /* ðŸ‘ˆ FIX: top spacing */
             }

         }

         /* Media Query for responsiveness */
         @media (max-width: 600px) {
             .requirements-section {
                 padding: 50px 15px;
             }

             .requirements-section h2 {
                 font-size: 28px;
                 margin-bottom: 30px;
             }

             .requirements-list {
                 margin-bottom: 30px;
             }
         }
     </style>
     <header class="container hero-section  justify-content-center">
         <h1>Join Our Network of Trusted Care Providers</h1>
         <p>Partner with HealthCare At Home and extend your reach, enhance your practice, and make a real difference.</p>
     </header>
     <!-- provider account -->
     <section class="register-section hospital-account bg-overlay-account bg_img"
         data-background="{{ asset('/frontend/images/banner/account-bg.webp') }}">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-xl-6 col-lg-7 col-md-9">
                     <div class="register-form">
                         <div class="login-form">
                             <div class="register-header-top">
                                 <h3 class="title">{{ __('Join as Provider') }}</h3>
                             </div>
                             {{-- Register Form --}}
                             <form id="register" class="" method="POST"
                                 action="{{ setRoute('providers.register.submit') }}">
                                 @csrf
                                 <div class="personal-account pt-30 select-account" data-select-target="1">
                                     <div class="row">
                                         <div class="col-lg-12 form-group">
                                             <label>{{ __('Full Name') }}</label>
                                             <input type="text" class="form-control form--control" name="name"
                                                 placeholder="{{ __('Full Name') }}">
                                         </div>
                                         <div class="col-lg-12 form-group">
                                             <label>{{ __('Username') }}</label>
                                             <input type="email" class="form-control form--control" name="email"
                                                 placeholder="{{ __('Enter Email Address as Username ') }}">
                                         </div>
                                         <div class="col-lg-12 form-group show_hide_password-2">
                                             <label>{{ __('Password') }}</label>
                                             <input type="password" class="form-control form--control" name="password"
                                                 placeholder="{{ __('Password') }}">
                                             <a href="#0" class="show-pass"><i class="fa fa-eye-slash"
                                                     aria-hidden="true"></i></a>
                                         </div>
                                         <div class="col-lg-12  form-group show_hide_password-2">
                                             <label>{{ __('Confirm Password') }}</label>
                                             <input type="password" class="form-control form--control"
                                                 name="confirm_password" placeholder="{{ __('Confirm your Password') }}">
                                             <a href="#0" class="show-pass-2"><i class="fa fa-eye-slash"
                                                     aria-hidden="true"></i></a>
                                         </div>

                                         @php
                                             $agree_policy = DB::table('basic_settings')->first();
                                         @endphp

                                         <div class="col-lg-12 form-group">
                                             <div class="custom-check-group">
                                                 <input type="checkbox" id="agree" name="agree">
                                                 <label for="agree" class="mb-0">
                                                     {{ __('I have read and agreed with the') }}
                                                     <a href="{{ url('useful-link/terms-condition') }}"
                                                         class="text--base">{{ __('Terms & Conditions') }}</a>
                                                 </label>
                                             </div>
                                         </div>
                                         <div class="col-lg-12 form-group text-center">
                                             <button type="submit"
                                                 class="btn--base w-100">{{ __('Register Now') }}</button>
                                             <label for="level-1" class="mb-0 pt-10">{{ __('Already A Member?') }} <a
                                                     href="{{ url('providers/login') }}"
                                                     class="text--base">{{ __('Login Here') }}</a></label>
                                         </div>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-6 col-lg-7 col-md-9">

                     <div class="video-wrapper">
                         <!--<video autoplay muted loop>-->
                         <video autoplay muted loop controls playsinline>
                             <!--<source src="video.mp4" type="video/mp4">-->
                             <source src="{{ asset('backend/images/web-settings/image-assets/medzy_vendor_video.mp4') }}"
                                 type="video/mp4">
                         </video>

                     </div>
                 </div>
             </div>
             <div class="row justify-content-center">
                 @include('frontend.pages.providers.steps')
             </div>
         </div>

     </section>
     <section class="why-partner-section">
         <div class="container">
             <h2>Why Partner with HealthCare At Home?</h2>
             <div class="features-grid">
                 <div class="feature-box">
                     <h3>Flexible Hours & Schedule</h3>
                     <p>Manage your own availability and take on new cases that fit your lifestyle.</p>
                 </div>
                 <div class="feature-box">
                     <h3>Expand Your Patient Reach</h3>
                     <p>Connect with a wider patient base in need of quality at-home healthcare services.</p>
                 </div>
                 <div class="feature-box">
                     <h3>Competitive Earnings & Timely Payouts</h3>
                     <p>Benefit from attractive compensation and reliable, prompt payments for your services.</p>
                 </div>
                 <div class="feature-box">
                     <h3>Dedicated Partner Support</h3>
                     <p>Receive ongoing assistance and resources from our dedicated support team.</p>
                 </div>
                 <div class="feature-box">
                     <h3>Seamless Digital Tools</h3>
                     <p>Utilize our intuitive platform for efficient case management, and communication.</p>
                 </div>
                 <div class="feature-box">
                     <h3>Professional Development</h3>
                     <p>Access continuous learning opportunities and resources to enhance your skills.</p>
                 </div>
                 <div class="feature-box">
                     <h3>Supportive Community</h3>
                     <p>Join a network of peers for collaboration, knowledge sharing, and mutual support.</p>
                 </div>
             </div>
         </div>
     </section>
     <section class="who-can-join-section">
         <div class="container">
             <h2>Who Can Join Our Network?</h2>
             <div class="provider-types-grid">
                 <div class="provider-type-box">Doctors</div>
                 <div class="provider-type-box">Nurses</div>
                 <div class="provider-type-box">Paramedics</div>
                 <div class="provider-type-box">Diagnostic Labs</div>
                 <div class="provider-type-box">Equipment Suppliers</div>
                 <div class="provider-type-box">Pharmacies</div>
                 <div class="provider-type-box">Ambulance Drivers</div>
             </div>
         </div>
     </section>

     <section class="why-partner-section">
         <div class="container">
             <h2>Our Simple Registration Process</h2>
             <div class="features-grid">
                 <div class="feature-box">
                     <span class="step-number">1</span>
                     <h3>Sign Up & Create Profile</h3>
                     <p>Begin by creating your provider account on our platform.</p>
                 </div>
                 <div class="feature-box">
                     <span class="step-number">2</span>
                     <h3>Submit Documents for Verification</h3>
                     <p>Upload necessary KYC, licenses, and professional certifications.</p>
                 </div>
                 <div class="feature-box">
                     <span class="step-number">3</span>
                     <h3>Get Verified & Onboarded</h3>
                     <p>Our team reviews your submission and completes the onboarding process.</p>
                 </div>
                 <div class="feature-box">
                     <span class="step-number">4</span>
                     <h3>Start Accepting Requests</h3>
                     <p>Once approved, you can begin receiving and accepting patient requests.</p>
                 </div>

             </div>
         </div>
     </section>
     <section class="requirements-section">
         <div class="container">
             <h2>What You'll Need to Get Started</h2>

             <div class="requirements-list">
                 <h3>General Requirements for All Providers:</h3>
                 <ul>
                     <li><strong>Valid Government-Issued ID</strong> (e.g., Passport, National ID Card)</li>
                     <li><strong>Proof of Address</strong> (e.g., Utility Bill, Bank Statement)</li>
                     <li><strong>Professional Resume/CV</strong></li>
                     <li><strong>Bank Account Details</strong> for Payouts</li>
                     <li><strong>Professional Liability Insurance</strong> (where applicable)</li>
                 </ul>
             </div>

             <div class="requirements-list">
                 <h3>Specific Requirements by Provider Type:</h3>
                 <ul>
                     <li>
                         <strong>Doctors:</strong> Medical Degree, Medical License (current and valid), Specialty
                         Certifications (if any), Good Standing Certificate from Medical Council.
                     </li>
                     <li>
                         <strong>Nurses:</strong> Nursing Degree/Diploma, Nursing License (current and valid), BLS/ACLS
                         Certification.
                     </li>
                     <li>
                         <strong>Paramedics:</strong> Paramedic Certification/License, BLS/ACLS/PALS Certification, Driving
                         License (for ambulance drivers).
                     </li>
                     <li>
                         <strong>Diagnostic Labs:</strong> Lab Accreditation/License, List of Services Offered, Equipment
                         Calibration Certificates, Quality Control Documentation.
                     </li>
                     <li>
                         <strong>Equipment Suppliers:</strong> Business Registration, Product Catalog, Quality
                         Certifications for Equipment, Delivery & Installation Capabilities.
                     </li>
                     <li>
                         <strong>Pharmacies:</strong> Pharmacy License, Pharmacist-in-Charge License, Drug Dispensing
                         Permits, Inventory Management System details.
                     </li>
                     <li>
                         <strong>Ambulance Drivers:</strong> Valid Driving License (Commercial/Professional), First Aid &
                         CPR Certification, Vehicle Registration & Insurance.
                     </li>
                 </ul>
             </div>
         </div>
     </section>

     <section class="compliance-security-section pt-20 pb-60" style="background-color: #f0f4f8;">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-lg-10 text-center">
                     <h2 class="title mb-4">
                         Redy To Join Our Growing Network ?
                     </h2>
                     <a href="#" class="btn-book">
                         Register Now
                     </a>
                 </div>
             </div>
         </div>
     </section>

     <section class="faq-section">
         <h2>Frequently Asked Questions for Providers</h2>

         <div class="faq-container">
             <details class="faq-item">
                 <summary>
                     How long does the verification process take? <i class="fas fa-chevron-down"></i>
                 </summary>
                 <p>The verification process typically takes 3–5 business days, depending on the completeness of your</p>
             </details>

             <details class="faq-item">
                 <summary>
                     When and how do I receive payouts? <i class="fas fa-chevron-down"></i>
                 </summary>
                 <p>Payouts are processed weekly via direct bank transfer to the account details provided during
                     registration.</p>
             </details>

             <details class="faq-item">
                 <summary>
                     What kind of support is available for providers?<i class="fas fa-chevron-down"></i>
                 </summary>
                 <p>We offer 24/7 dedicated email and phone support, along with an extensive knowledge base and community
                 </p>
             </details>

             <details class="faq-item">
                 <summary>
                     Can I set my own service rates? <i class="fas fa-chevron-down"></i>
                 </summary>
                 <p>While we provide recommended rates, you have the flexibility to set your own competitive service rates..
                 </p>
             </details>

             <details class="faq-item">
                 <summary>
                     How are patient requests assigned? <i class="fas fa-chevron-down"></i>
                 </summary>
                 <p>Patient requests are assigned based on your availability, location, specialty, and patient needs. You
                     can</p>
             </details>
         </div>
     </section>
 @endsection
