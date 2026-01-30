@extends('frontend.layouts.master')

@push('css')
    <style>
        .doctor-card {
            display: flex;
            align-items: center;
            gap: 20px;
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 10px;
            background-color: #fafafa;
        }

        .doctor-thumb img {
            width: 100%;
            /* max-width: 200px; */
            border-radius: 10px;
            min-height: 700px;
        }

        .doctor-details {
            flex: 1;
        }

        .appointment_area .doctor-card .doctor-thumb {
            min-width: 500px;
            min-height: 700px;
        }

        .appointment_area {
            background-color: #fcfcfc;
            padding: 30px;
            border-radius: 10px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 7px 0px;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 7px 0px;
        }

        @media (max-width: 991px) and (min-width: 769px) {
            .doctor-thumb img {
                max-width: 400px
            }
        }

        @media (max-width: 768px) and (min-width: 481px) {
            .doctor-thumb img {
                max-width: 250px
            }
        }
    </style>
@endpush

@section('content')
    <section class="make-appointment ptb-20">
        <div class="custom-container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="appointment_area">
                        <h3 class="title"> {{ $service->name }}</h3>
                        <p><strong>{{ $service->title }}</strong></p>
                        <p><strong>{{ $service->description }}</strong></p>
                        <div class="row doctor-card">
                            <div class="doctor-thumb col-6">
                                <img src="{{ asset($service->icon) }}" alt="services-img">
                            </div>
                            <div class="doctor-details col-6">
                                {{-- <h4 class="title"><i class="fas la-user"></i>{{ $service->name }}</h4>
                                <p><strong>{{ $service->title }}</strong></p>
                                <p><strong>{{ $service->description }}</strong></p> --}}
                                <form action="{{ route('frontend.doctor.booking.store') }}" id="doctorBookingForm"
                                    class="doc-form mt-20" method="POST">
                                    @csrf
                                    <input type="text" name="service_id" value="{{ $service->id }}" hidden>
                                    <input type="hidden" id="scheduleId" name="schedule_id" value="">
                                    <div class="about-details pt-10">
                                        <div class="shedule-title pt-4">
                                            <h4 class="title"><i class="fas fa-history text--base"> </i>
                                                {{ __('Make Appointment') }}
                                            </h4>
                                        </div>
                                        <div class="shedule-area">
                                            <div class="row mb-10-none">
                                                <div class="col-lg-6 col-md-6 mb-10">
                                                    <label>{{ __('Enter Name') }}</label>
                                                    <input type="text" name="name" class="form--control"
                                                        placeholder={{ __('Enter Name') }}>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-10">
                                                    <label>{{ __('Enter Gender') }}</label>
                                                    <select name="gender" class="nice-select nice-select-hight"
                                                        style="display: none;">
                                                        <option value="male">{{ __('Male') }}</option>
                                                        <option value="female">{{ __('Female') }}</option>
                                                        <option value="other">{{ __('Other') }}</option>
                                                    </select>

                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-10 age-select">
                                                    <label>{{ __('Enter Age') }}</label>
                                                    <input type="number" name="age" class="form--control"
                                                        placeholder="Enter Age">
                                                    <div class="age-type">
                                                        <select name="age_type" class="nice-select" style="display: none;">
                                                            <option value="Year">{{ __('Year') }}</option>
                                                            <option value="Month">{{ __('Month') }}</option>
                                                            <option value="Days">{{ __('Days') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-10">
                                                    <label>{{ __('Mobile Number') }}</label>
                                                    <input type="number" name="number" class="form--control"
                                                        placeholder={{ __('Enter Number') }}>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-10">
                                                    <label>{{ __('Schedule Date') }}</label>
                                                    <input type="date" name="date">

                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-10">
                                                    <label>{{ __('Schedule time') }}</label>
                                                    <input type="time" name="time">

                                                </div>
                                                {{-- <div class="col-lg-12 col-md-12 mb-10">
                                            <x-location-picker 
                                                label="Pickup Location"
                                                id="pickup_autocomplete"
                                                mapId="pickup_map"
                                                latId="pickup_lat"
                                                lngId="pickup_lng"
                                            />
                                        </div> --}}
                                                <div class="col-xl-12 col-lg-12 mb-10">
                                                    <label>{{ __('Your Message') }} <small
                                                            class="text--warning">{{ __('optional') }}</small></label>
                                                    <textarea name="message" class="form--control" placeholder="Write Here..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="appointment-footer pt-5 row">
                                            {{-- <div class="col-lg-6 form-group pt-3">
                                                <button type="submit" id="checkAvailabilityBtn"
                                                    class="btn--base small w-100">{{ __('Check Availability') }}</button>
                                            </div> --}}
                                            <div class="col-lg-12 form-group pt-3">
                                                <button type="submit" id="bookNowBtn"
                                                    class="btn--base small w-100">{{ __('Book Now') }}</button>
                                                {{-- <span>System will Assign.</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($service->id == 1)
                        @include('frontend.pages.services-booking.icu')
                    @endif
                    @if ($service->id == 2)
                        @include('frontend.pages.services-booking.medical-equipment')
                    @endif
                    @if ($service->id == 3)
                        @include('frontend.pages.services-booking.nurse')
                    @endif
                    @if ($service->id == 4)
                        @include('frontend.pages.services-booking.labtest')
                    @endif
                    @if ($service->id == 5)
                        @include('frontend.pages.services-booking.elderly_care_service')
                    @endif
                    @if ($service->id == 6)
                        @include('frontend.pages.services-booking.ventilator_support')
                    @endif
                    @if ($service->id == 7)
                        @include('frontend.pages.services-booking.occupational_health_services')
                    @endif
                    @if ($service->id == 8)
                        @include('frontend.pages.services-booking.dialysis_service')
                    @endif
                    @if ($service->id == 9)
                        @include('frontend.pages.services-booking.nursing_care_at_home')
                    @endif
                    @if ($service->id == 10)
                        @include('frontend.pages.services-booking.healthcare_attendant_at_home')
                    @endif
                    @if ($service->id == 11)
                        @include('frontend.pages.services-booking.physiotherapy_at_home')
                    @endif
                    @if ($service->id == 12)
                        @include('frontend.pages.services-booking.doctor_visit_at_home')
                    @endif
                    @if ($service->id == 15)
                        @include('frontend.pages.services-booking.medical_Accommodation_at_home')
                    @endif
                    @if ($service->id == 16)
                        @include('frontend.pages.services-booking.ambulance')
                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('doctorBookingForm');
            const checkBtn = document.getElementById('checkAvailabilityBtn');
            const bookBtn = document.getElementById('bookNowBtn');
            bookBtn.addEventListener('click', function(e) {
                form.action = "{{ route('frontend.doctor.booking.store') }}";
            });
        });
    </script>
    <script></script>
@endpush
