@extends('frontend.layouts.master')

@push('css')
@endpush

@section('content')
    <section class="make-appointment ptb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="appointment-area">
                        <h3 class="title"><i class="fas fa-info-circle text--base mb-20"></i> {{ __('Make Appointment') }}
                        </h3>
                        <div class="doctor-card">
                            <div class="doctor-thumb">
                                <img src="{{ asset('public/' . $service->icon) }}" alt="services-img">
                            </div>
                            <div class="doctor-details">
                                <h4 class="title"><i class="fas la-user"></i>{{ $service->name }}</h4>
                                <p><strong>{{ $service->title }}</strong></p>
                                <p><strong>{{ $service->description }}</strong></p>

                            </div>
                        </div>
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
                                                value="{{ auth()->user()->firstname ?? '' }}"
                                                placeholder={{ __('Enter Name') }}>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-10">
                                            <label>{{ __('Mobile Number') }}</label>
                                            <input type="number" name="number" class="form--control"
                                                value="{{ auth()->user()->mobile ?? '' }}"
                                                placeholder={{ __('Enter Number') }}>
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


                                        <!--<div class="col-lg-6 col-md-6 mb-10">-->
                                        <!--    <label>{{ __('Schedule Date') }}</label>-->
                                        <!--    <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" min="{{ now()->format('Y-m-d') }}">-->

                                        <!--</div>-->
                                        <!--<div class="col-lg-6 col-md-6 mb-10">-->
                                        <!--    <label>{{ __('Schedule time') }}</label>-->
                                        <!--    <input type="time" name="time" value="{{ now()->format('H:i') }}">-->
                                        <!--</div>-->

                                        <div class="col-xl-12 col-lg-12 mb-10">
                                            <label>{{ __('Your Message') }} <small
                                                    class="text--warning">{{ __('optional') }}</small></label>
                                            <textarea name="message" class="form--control" placeholder="Write Here..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="appointment-footer pt-5 row">

                                    <div class="col-lg-12 form-group pt-3">
                                        <button type="submit" id="bookNowBtn"
                                            class="btn--base small w-100">{{ __('Book Now') }}</button>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
