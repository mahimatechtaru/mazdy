@extends('frontend.layouts.master')
@php
    $knowledge_center = App\Models\Frontend\KnowledgeCenter::orderByDesc('id')->get();
@endphp
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    td:nth-child(even) {
        color: #3046b2 !important;
        cursor: pointer;
    }
</style>

@section('content')
    <section class="about-section pt-40">
        <div class="container">

            <div class="row mb-30-none">
                <div class="col-lg-12 mb-30">
                    <div class="about-content">
                        <h2 class="title">
                            Knowledge Center
                        </h2>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" text-center d-block">
        <div class=" container">
            <div class="">
                <div class="table-area ptb-40 mtb-40">
                    <div class="table-wrapper">
                        <div class=" table-responsive">
                            <table class="custom-table">
                                {{-- <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                </tr> --}}
                                <tbody>
                                    @foreach ($KnowledgeCenter as $key => $kc)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td style="width:70%">{{ $kc->title }}</td>
                                            <td><a class="" target="_blank"
                                                    href="{{ asset('uploads/documents/' . $kc->doc) }}">{{ $kc->doc }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ get_paginate($KnowledgeCenter) }}
            </div>
    </section>
@endsection
