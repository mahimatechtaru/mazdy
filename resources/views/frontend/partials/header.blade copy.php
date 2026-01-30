@php
$menues = DB::table('setup_pages')->where('status', 1)->get();
$language = App\Models\Admin\Language::where('status', 1)->first();
$contact = App\Models\Admin\SiteSections::getData('contact')->first();
@endphp
<style>
    /* BASE CSS */
    .btn-top {
        background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2px 10px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        font-size: 12px;
        cursor: pointer;
    }

    .btn-top:hover {
        background-color: #637dfe34;
    }
</style>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<header class="header-section position-relative">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container custom-container">
                <!-- Top Bar -->
                <div class="top-bar">
                    <div class="top-left">
                        <a href="{{ route('user.login') }}"><button class="btn btn-top">Join as User</button></a>
                        <a href="#" onclick="open_popup()"><button class="btn btn-top">Join as Provider</button></a>
                        <a href="{{ route('hospitals.login') }}"><button class="btn btn-top">Join as
                                Hospital</button></a>
                    </div>
                    <div class="location flex items-center" onclick="open_city_popup()" style="cursor: pointer;">
                        <i class="fas fa-map-marker-alt"></i>
                        <p class="ms-2 text-[16px] tab-profile" id="current-location">Jaipur</p>
                    </div>

                    <div class="location flex items-center">
                        <i class="fas fa-phone-alt"></i>
                        <p><a href="tel:{{ $contact->value->phone ?? '' }}">{{ $contact->value->phone ?? '' }}</a></p>
                    </div>

                    <div class="top-right">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                </div>


                <div class="header-bottom-area">
                    <div class="container custom-container">
                        <div class="header-menu-content">
                            <nav class="navbar navbar-expand-xl p-0">
                                <a class="site-logo site-title" href="{{ setroute('frontend.index') }}"><img
                                        src="{{ get_logo($basic_settings) }}" alt="site-logo"></a>
                                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="fas fa-bars"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav main-menu ms-auto">
                                        @foreach ($menues as $item)
                                        @php
                                        $title = $item->title ?? '';
                                        @endphp
                                        <li><a href="{{ url($item->url) }}"
                                                class=" @if ($current_url == url($item->url)) active @endif ">{{ __($title) }}
                                            </a></li>
                                        @endforeach
                                    </ul>
                                    <div class="language-select d-none">
                                        @php
                                        $session_lan = session('local') ?? get_default_language_code();

                                        @endphp
                                        <select class="form--control langSel nice-select" name="lang_switcher">
                                            @foreach ($__languages as $item)
                                            <option value="{{ $item->code }}"
                                                @if ($session_lan==$item->code) selected @endif>
                                                {{ __($item->name) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="header-action">
                                        <div class="header-action">
                                            @if (Auth::guard('hospital')->check())
                                            <a class="btn--base"
                                                href="{{ setRoute('hospitals.dashboard') }}">{{ __('Dashboard') }}</a>
                                            @elseif (Auth::guard('web')->check())
                                            <a class="btn--base"
                                                href="{{ setRoute('user.dashboard') }}">{{ __('Dashboard') }}</a>
                                            @else
                                            <a href="{{ setRoute('user.login') }}"
                                                class="btn--base">{{ __('Login Now') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
</header>


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


@push('script')
<script>
    $("select[name=lang_switcher]").change(function() {
        var selected_value = $(this).val();
        var submitForm =
            `<form action="{{ setRoute('frontend.languages.switch') }}" id="local_submit" method="POST"> @csrf <input type="hidden" name="target" value="${$(this).val()}" ></form>`;
        $("body").append(submitForm);
        $("#local_submit").submit();
    });
</script>
@endpush