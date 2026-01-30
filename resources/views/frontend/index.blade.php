@extends('frontend.layouts.master')
@push('css')
@endpush
@section('content')
    {{-- @include('frontend.section.banner') --}}
    @include('frontend.section.medzy-banner')
    @include('frontend.section.join-us')
    @include('frontend.section.service_block')
    @include('frontend.section.service')
    {{-- @include('frontend.section.service-banner') --}}
    @include('frontend.section.features')

    @include('frontend.section.sos-banner')
    @include('frontend.section.who-can-use')
    @include('frontend.section.medzy-section')
    @include('frontend.section.how-it-work')
    @include('frontend.section.why-choose-us')
    @include('frontend.section.statistics')
    @include('frontend.section.download-app')
@endsection
@push('script')
@endpush
