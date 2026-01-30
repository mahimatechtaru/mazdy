@php
    $app_local = get_default_language_code();
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::CONTACT_SECTION);
    $contact = App\Models\Admin\SiteSections::getData($slug)->first();

@endphp
@extends('frontend.layouts.master')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Contact Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="contact-section pt-60">
        <div class="container">
            <div class="contact-area">
                <div class="row">
                    <div class="col-xl-9 col-lg-9">
                        <div class="contact-form-area">
                            <div class="contact-header pb-30">
                                <h4 class="title">{{ $contact->value->language->$app_local->title ?? '' }}</h4>
                                <p class="title">We’re here to help! Reach out to us for any inquiries, support, or
                                    feedback.</p>
                            </div>
                            <form class="contact-form" action="{{ setRoute('frontend.contact.message.send') }}"
                                method="POST">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-xl-6 col-lg-6 col-md-6 form-group">
                                        <label>{{ __('Full Name') }}<span>*</span></label>
                                        <input type="text" name="name" class="form--control"
                                            placeholder="{{ __('Enter Full Name') }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 form-group">
                                        <label>{{ __('Email Address') }}<span>*</span></label>
                                        <input type="email" name="email" class="form--control"
                                            placeholder="{{ __('Enter Email Address') }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 form-group">
                                        <label>{{ __('Phone No:') }} <small>(Optional)</small></label>
                                        <input type="tel" name="phone" class="form--control"
                                            placeholder="{{ __('Enter Phone No.') }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 form-group">
                                        <label>{{ __('Subject') }}</label>
                                        <input type="text" name="subject" class="form--control"
                                            placeholder="{{ __('Enter Subject here') }}">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 form-group">
                                        <label>{{ __('Message') }}<span>*</span></label>
                                        <textarea class="form--control" name="message" placeholder="{{ __('Type your message here...') }}"></textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn--base">{{ __('Send Message') }}</button>
                                    </div>
                                </div>
                            </form>
                            <div class="contact-system  mt-20-none">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <h4 style="text-align: center;">Contact Information</h4>
                                        <div class="contact-system-area mb-10-none">
                                            <div class="contact-widget mb-10">
                                                <div class="contact-item-icon">
                                                    <img src="{{ asset('public/frontend/images/icon/mobile.gif') }}"
                                                        alt="icon">
                                                </div>
                                                <div class="contact-item-content">
                                                    <h4>Primary Phone Number</h4>
                                                    <span class="sub-title"> <a
                                                            href="tel:{{ $contact->value->phone ?? '' }}">{{ $contact->value->phone ?? '' }}</a></span>
                                                </div>
                                            </div>
                                            <div class="contact-widget mb-10">
                                                <div class="contact-item-icon">
                                                    <img src="{{ asset('public/frontend/images/icon/email.gif') }}"
                                                        alt="icon">
                                                </div>
                                                <div class="contact-item-content">
                                                    <h4>Support Email Address</h4>
                                                    <span class="sub-title"> <a
                                                            href="mailto:{{ $contact->value->email ?? '' }}">{{ $contact->value->email ?? '' }}</a></span>
                                                </div>
                                            </div>
                                            <div class="contact-widget mb-10">
                                                <div class="contact-item-icon">
                                                    <img src="{{ asset('public/frontend/images/icon/location.gif') }}"
                                                        alt="icon">
                                                </div>
                                                <div class="contact-item-content">
                                                    <h4>Physical Address</h4>
                                                    <p class="sub-title">
                                                        {{ substr($contact->value->address ?? ($contact->value->address ?? ''), 0, 60) }}
                                                    </p>
                                                    <p class="sub-title">
                                                        {{ substr($contact->value->address ?? ($contact->value->address ?? ''), 60) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="contact-widget mb-10">
                                                <div class="contact-item-icon">
                                                    <i class="fas fa-clock contact-icon"></i>
                                                </div>
                                                <div class="contact-item-content">
                                                    <h4>Operating Hours</h4>
                                                    @foreach ($contact->value->schedules ?? [] as $item)
                                                        <span class="sub-title">{{ $item->schedule ?? '' }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="contact-section ptb-80">
        <div class="container">
            <div class="col-lg-12">
                <div class="location-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3070.1899657893728!2d90.42380431666383!3d23.779746865573756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7499f257eab%3A0xe6b4b9eacea70f4a!2sManama+Tower!5e0!3m2!1sen!2sbd!4v1561542597668!5m2!1sen!2sbd"
                        style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        end contact
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
