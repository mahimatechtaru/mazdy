<!--  how its work -->
@php

    $app_local = get_default_language_code() ?? 'en';
    $default = App\Constants\LanguageConst::NOT_REMOVABLE;

    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::HOW_ITS_WORK_SECTION);
    $how_its_work = App\Models\Admin\SiteSections::getData($slug)->first();

@endphp


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        How to work section
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="how-work-section ptb-40">
    <div class="container">
        <div class="section-tag pb-20">
            <div class="row">
                <div class="col-xl-10 col-lg-12">
                    <div class="section-title">
                        <h2 class="title" style="text-aling: center;">
                            {{ $how_its_work->value->language->$app_local->heading ?? ($how_its_work->value->language->$default->heading ?? '') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
      @php
    $items = $how_its_work->value->items ?? [];
    $item_data = (array) $items;

    $part1 = $item_data;

@endphp

    <div class="how-work-area">
        <div class="row mb-20-none">
            <div class="col-lg-12 mb-20">
                <div class="steps-content">
                    <div class="step-listing">
                        <div class="row mb-20-none">
                            @foreach ($part1 ?? [] as $key => $item)
                            <div class="col-lg-3 mb-20">
                                <div class="content">
                                    <h4 class="title">{{ $item->language->$app_local->title ?? ($item->language->$default->title ?? '') }}</h4>
                                    <p>{{ $item->language->$app_local->description ?? ($item->language->$default->description ?? '') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</section>
