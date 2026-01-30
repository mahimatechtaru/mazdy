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

    .btn-danger {
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-top:hover {
        background-color: #637dfe34;
    }

    .top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f2f6ff;
        padding: 8px 20px;
        font-size: 14px;
        border-bottom: 1px solid #e3e9f5;
    }

    .top-bar-left,
    .top-bar-center,
    .top-bar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Center Info */
    .top-info {
        color: #1f2a44;
        cursor: pointer;
    }

    .top-info i {
        margin-right: 5px;
        color: #5b6cff;
    }

    /* Social Icons */
    .top-bar-right a {
        color: #5b6cff;
        font-size: 14px;
        transition: 0.3s;
    }

    .top-bar-right a:hover {
        color: #3f51ff;
    }

    @media (max-width: 991px) {
        .top-bar {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
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
                    <div class="top-bar-left">
                        <a href="/register" class="btn-top">Join as Customer</a>
                        <a href="javascript:void(0)" onclick="open_popup()" class="btn-top">Join as Provider</a>
                        <a href="/hospitals/register" class="btn-top">Join as Hospital</a>
                    </div>

                    <div class="top-bar-center">
                        <span onclick="open_city_popup()" class="top-info">
                            <i class="fas fa-map-marker-alt"></i> Jaipur(Rajasthan), India
                        </span>

                        <span class="btn btn-danger ">
                            <a href="#">SOS Helpline </a>
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:+919352454200">+91 9352454200</a>
                        </span>
                    </div>

                    <div class="top-bar-right">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-blogger"></i></a>
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
                                                    @if ($session_lan == $item->code) selected @endif>
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
