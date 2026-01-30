  @php
      use App\Models\Service;

      $services = Service::all();
  @endphp
  @extends('frontend.layouts.master')

  @section('content')
      <style>
          /* BASE CSS */
          .hero {
              padding: 60px 5%;
          }

          .hero p {
              font-size: 1.1em;
              color: #777;
              margin-bottom: 30px;
          }

          .homecare-services-section {
              padding: 50px 0;
              background-color: #ffffff;
              font-family: 'Poppins', sans-serif;
          }

          .container {
              max-width: 1200px;
              margin: 0 auto;
              padding: 0 20px;
          }

          .section-title {
              font-size: 2.5em;
              font-weight: 700;
              color: #1a1a1a;
              margin-bottom: 10px;
          }

          .section-subtitle {
              font-size: 1.1em;
              color: #666;
              margin-bottom: 50px;
          }

          .service-cards-grid {
              display: grid;
              grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
              gap: 30px;
              margin-bottom: 50px;
          }

          .service-card-item {
              background: #ffffff;
              padding: 30px;
              border-radius: 15px;
              text-align: left;
              box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
              transition: transform 0.3s, box-shadow 0.3s;
          }

          .service-card-item:hover {
              transform: translateY(-5px);
              box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
          }

          .service-card-item h3,
          h4 {
              font-size: 1.3em;
              font-weight: 600;
              color: #333;
              margin: 15px 0 10px;
          }

          .service-card-item p {
              color: #777;
              line-height: 1.5;
              margin-bottom: 20px;
          }

          .icon-box {
              width: 100%;
              height: 220px;
              /* border-radius: 50%; */
              background-color: #637dfe34;
              color: #637DFE !important;
              display: flex;
              justify-content: center;
              align-items: center;
              font-size: 1.8em;
              margin-bottom: 10px;
          }

          .service-link {
              display: inline-block;
              color: #000;
              text-decoration: none;
              font-weight: 600;
              font-size: 0.95em;
          }

          .service-link:hover {
              color: #0d6efd;
          }

          .call-to-action {
              display: flex;
              justify-content: center;
              gap: 20px;
              margin-top: 20px;
          }

          .btn-main {
              background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
              color: white;
              padding: 12px 30px;
              border-radius: 50px;
              text-decoration: none;
              font-weight: 600;
              border: none;
              cursor: pointer;
          }

          .btn-main:hover {
              background-color: #637dfe34;
          }

          #moreServices {
              display: none;
              grid-column: 1 / -1;
              grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
              gap: 30px;
          }

          #moreServices.show {
              display: grid;
          }

          .btn-secondary-toggle {
              background-color: transparent;
              color: #000;
              padding: 12px 30px;
              border-radius: 50px;
              text-decoration: none;
              font-weight: 600;
              border: 2px solid #637DFE;
              transition: all 0.3s;
              cursor: pointer;
          }

          .btn-secondary-toggle:hover {
              background-color: #637dfe34;
          }

          /* .icon-box img {
                                              filter: invert(33%) sepia(92%) saturate(2765%) hue-rotate(203deg) brightness(96%) contrast(92%);
                                          } */

          .service-actions {
              display: flex;
              gap: 10px;
              margin-top: auto;
              /* Pushes the button group to the bottom */
              padding-top: 15px;
              border-top: 1px solid #f0f0f0;
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

          .btn-request {
              background-color: #f0f0f0;
              color: #333;
              padding: 8px 15px;
              border-radius: 8px;
              text-decoration: none;
              font-weight: 600;
              font-size: 0.9em;
              border: 1px solid #ddd;
              white-space: nowrap;
          }

          .btn-book:hover {
              opacity: 0.9;
              color: white;
          }

          .btn-request:hover {
              background-color: #e0e0e0;
              color: #333;
          }

          .service-features {
              list-style: none;
              padding: 0;
              margin-bottom: 20px;
              font-size: 0.95em;
          }

          .service-features li {
              color: #555;
              margin-bottom: 5px;
              display: flex;
              align-items: center;
          }

          .service-features li i {
              color: var(--primary-color);
              font-size: 0.6em;
              /* Small dot size */
              margin-right: 8px;
          }

          h1 {
              font-size: 37px;
          }
      </style>
      <header class="row justify-content-center hero d-none">
          <div class="col-xl-8 col-lg-10">
              <h1>Comprehensive Home Healthcare Services</h1>
              <p>From emergency response to long-term care, we bring hospital-grade services to your home</p>
          </div>
      </header>
      <section class="homecare-services-section">
          <div class="container">
              <div class="section-tag pb-20">
                  <span><i class="las la-heart"></i>
                      Services</span>
                  <h2 class="title">Medzy Homecare Services</h2>
                  <p>From emergency response to long-term care, we bring hospital-grade services to your home</p>
              </div>
              <div class="service-cards-grid">
                  @foreach ($services as $index => $service)
                      <div class="service-card-item">
                          <div class="icon-box">
                              @if ($service->icon)
                                  <img src="{{ asset('' . $service->icon) }}" alt="{{ $service->name }}"
                                      style="width:100%;height:200px;;">
                              @else
                                  <i class="fas fa-capsules"></i>
                              @endif
                          </div>
                          <h3>{{ $service->name }}</h3>
                          <p>{{ $service->description }}</p>

                          <div class="service-actions">
                              {{-- Assuming you open a modal or link to a booking page --}}
                              <a href="{{ url('getservice-form/' . $service->id) }}" class="btn-book">
                                  Book The Service
                              </a>
                              {{-- Assuming you open a contact form or modal --}}
                              {{-- <a href="#" class="btn-request">
                                  Request More Info
                              </a> --}}
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
  @endsection
