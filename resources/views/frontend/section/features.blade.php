@php
    $app_local = get_default_language_code() ?? 'en';
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FEATURES_SECTION);
    $features = App\Models\Admin\SiteSections::getData($slug)->first();
    $featureItems = $features->value->items ?? [];

    // Convert to plain array (if it's stdClass)
    $featureArray = is_array($featureItems) ? $featureItems : (array) $featureItems;

    // Left 5 items & Right 5 items
    $leftItems = array_slice($featureArray, 0, 5);
    $rightItems = array_slice($featureArray, 5, 5);

    $leftIndex = 0;
    $rightIndex = 0;
    $step_key = 0;

@endphp
<style>
    .circular-template {
        padding: 20px 5%;
        background: #eff3fd;
    }

    .circular-template h2 {
        font-size: 2.2em;
        font-weight: 800;
        margin-bottom: 60px;
    }

    .circle-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
        position: relative;
    }

    /* --- SIDE BOXES --- */
    .side {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 20px;
        flex: 1;
        min-width: 320px;
    }

    .info-box {
        min-height: 100px;
        background: #fff;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 5px 14px;
        position: relative;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* --- ICON CIRCLE --- */
    .icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(to right, #637DFE, #203499);
        color: #fff;
        font-size: 1.6em;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* --- TEXT --- */
    .text h4 {
        flex: 1;
        margin: 0;
        font-size: 1.05em;
        font-weight: 700;
    }

    .text p {
        flex: 1;
        margin-top: 4px;
        color: #777;
        line-height: 1.5;
    }

    /* --- CONNECTOR LINES --- */

    /* --- CENTER CIRCLE --- */
    .center-circle {
        background: #fff;
        width: 270px;
        height: 270px;
        border-radius: 50%;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .center-circle h3 {
        margin: 0;
        font-weight: 600;
        font-size: 20px;
    }

    .center-circle span {
        color: #777;
        font-weight: 600;
    }

    .color-bars {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 4px;
        margin-top: 15px;
    }

    .color-bars .bar {
        width: 14px;
        height: 4px;
        border-radius: 2px;
    }

    /* --- COLORS --- */
    .purple {
        background: #a663cc;
    }

    .blue {
        background: #0091ff;
    }

    .teal {
        background: #22c1c3;
    }

    .yellow {
        background: #f4b942;
    }

    .orange {
        background: #ff8c42;
    }

    .pink {
        background: #ff5a8a;
    }

    .green {
        background: #00c776;
    }

    .indigo {
        background: #5465ff;
    }

    .red {
        background: #ff4a4a;
    }

    .gray {
        background: #9ca3af;
    }


    .box-1 {
        top: 5%;
        left: 41%;
    }

    .box-2 {
        top: 20%;
        left: 15%;
    }

    .box-3 {
        top: 40%;
        left: 5%;
    }

    .box-4 {
        top: 60%;
        left: 15%;
    }

    .box-5 {
        top: 80%;
        left: 41%;
    }

    /* --- RIGHT SIDE --- */
    .box-right-1 {
        top: 5%;
        right: 41%;
    }

    .box-right-2 {
        top: 20%;
        right: 15%;
    }

    .box-right-3 {
        top: 40%;
        right: 5%;
    }

    .box-right-4 {
        top: 60%;
        right: 15%;
    }

    .box-right-5 {
        top: 80%;
        right: 41%;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {

        .box-1,
        .box-2,
        .box-3,
        .box-4,
        .box-5,
        .box-right-1,
        .box-right-2,
        .box-right-3,
        .box-right-4,
        .box-right-5 {
            position: static !important;
            /* remove fixed/absolute placement */
            top: auto !important;
            left: auto !important;
            right: auto !important;
            margin: 0 auto;

            .circle-container {
                flex-direction: column;
                gap: 50px;
            }

            .side {
                align-items: center;
            }

            .info-box {
                flex-direction: row;
                text-align: left;
            }

            .info-box::after {
                display: none;
            }

        }
</style>
<section class="circular-template">
    <div class="container">
        <div class="circle-container">
            <div class="side left">
                @foreach ($leftItems as $item)
                    @php
                        $leftIndex++;
                        $step_key++;

                        if ($item->language->$app_local->title != 'User') {
                            $link = route('frontend.feature.details', ['id' => $item->id ?? $loop->iteration]);
                        } else {
                            if ($item->language->$app_local->title == 'User') {
                                $link = route('user.login');
                            }
                        }

                    @endphp
                    <a href="{{ $link }}" style="text-decoration: none; color: inherit;">
                        <div class="info-box box-{{ $leftIndex }}">
                            <div class="icon">
                                <p>{{ $step_key }}</p>
                            </div>
                            <div class="text">
                                @php
                                    if ($item->language->$app_local->title == 'Nursing') {
                                        $link = '#';
                                    }
                                    if ($item->language->$app_local->title == 'Hospital') {
                                        $link = route('hospitals.login');
                                    }
                                @endphp <h4>
                                    {{ $item->language->$app_local->title ?? ($item->language->$default->title ?? '') }}


                                </h4>
                                <p>{{ substr($item->language->$app_local->details ?? ($item->language->$default->details ?? ''), 0, 50) }}
                                    <span style="color: red"> Read More...</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>


            <!-- Center Circle -->

            <div class="center-circle" data-backgrounds="{{ asset('frontend/images/element/footer-bg.webp') }}">

                <img src="{{ get_logo($basic_settings) }}" alt="logo"
                    style="width:180px; margin-top:15px;margin-bottom:15px;">
                <h6>{{ $features->value->language->$app_local->heading ?? ($features->value->language->$default->heading ?? '') }}

                    <div class="color-bars">
                        <span class="bar purple"></span>
                        <span class="bar yellow"></span>
                        <span class="bar orange"></span>
                        <span class="bar pink"></span>
                        <span class="bar blue"></span>
                        <span class="bar teal"></span>
                    </div>
                </h6>
            </div>

            @php
                // Right side numbering reset
                $rightIndex = 0;
                $link = '';
            @endphp

            <div class="side right">
                @foreach ($rightItems as $item)
                    @php
                        $rightIndex++;
                        $step_key++;

                        if ($item->language->$app_local->title != 'Hospital') {
                            $link = route('frontend.feature.details', ['id' => $item->id ?? $loop->iteration]);
                        } else {
                            if ($item->language->$app_local->title == 'Hospital') {
                                $link = route('hospitals.login');
                            }
                        }

                    @endphp
                    <a href="{{ $link }}" style="text-decoration: none; color: inherit;">
                        <div class="info-box box-right-{{ $rightIndex }}">
                            <div class="icon">
                                <p>{{ $step_key }}</p>
                            </div>
                            <div class="text">
                                <h4>{{ $item->language->$app_local->title ?? ($item->language->$default->title ?? '') }}
                                </h4>
                                <p>{{ substr($item->language->$app_local->details ?? ($item->language->$default->details ?? ''), 0, 50) }}
                                    <span style="color: red"> Read More...</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
