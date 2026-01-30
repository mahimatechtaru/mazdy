<style>
    /* --- CAROUSEL BANNER STYLES --- */
    .custom-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 0px !important;
    }

    .banner-section-carousel {
        /* padding: 20px 0; */
        padding: 0;
        /* Reduced padding for cleaner look */
    }

    .banner-wrapper-carousel {
        /* Main container for the carousel
        background-color: #a4e6f2; */
        background: linear-gradient(90.88deg, #92d7e4 0%, #8ed6e4 100%);
        /* border-radius: 15px; */
        position: relative;
        overflow: hidden;
        max-width: 100%;
        margin: 0 auto;
    }

    /* .slides-container {
        width: 100%;
        <!-- Set a fixed height for the banner area -->
        height: 350px;
        position: relative;
    } */

    .slide {
        display: none;
        width: 100%;
        height: 100%;
        position: absolute;
        inset: 0;
        background-size: contain;
        /* IMPORTANT */
        background-position: center;
        /* IMPORTANT */
        background-repeat: no-repeat;
        transition: opacity 1.2s ease-in-out;
        opacity: 0;
    }

    .slide.active {
        display: block;
        opacity: 1;
    }

    /* --- DOT NAVIGATION STYLES --- */

    .dot-navigation-container {
        text-align: center;
        padding: 15px 0 10px 0;
    }

    .dot {
        height: 12px;
        width: 12px;
        margin: 0 4px;
        background-color: rgba(0, 0, 0, 0.3);
        /* Default dot color */
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.6s ease;
    }

    .dot.active,
    .dot:hover {
        background-color: #007bff;
        /* Highlight color for active/hover dot */
    }

    .slides-container {
        width: 100%;
        min-height: 350px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .slides-container {
            min-height: 180px;
        }
    }

    @media (min-width: 769px) and (max-width: 991px) {
        .slides-container {
            min-height: 250px;
        }
    }

    /* Responsive Adjustments */
    @media (min-width: 992px) and (max-width: 1499px) {
        .slides-container {
            height: 300px;
        }
    }

    /* Responsive Adjustments */
    @media (min-width: 1500px) {
        .slides-container {
            height: 350px;
        }
    }
</style>

<script>
    let slideIndex = 1;
    let autoSlideTimer;

    window.onload = function() {
        showSlides(slideIndex);
        startAutoSlide();
    };

    function startAutoSlide() {
        if (autoSlideTimer) clearInterval(autoSlideTimer);

        autoSlideTimer = setInterval(function() {
            plusSlides(1);
        }, 5000);
    }

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
        startAutoSlide();
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        let dots = document.getElementsByClassName("dot");

        if (n > slides.length) {
            slideIndex = 1;
        }

        if (n < 1) {
            slideIndex = slides.length;
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].classList.remove('active');
        }

        slides[slideIndex - 1].classList.add('active');
        dots[slideIndex - 1].classList.add('active');
    }
</script>
<section class="banner-section bg-overlay-banner banner-section-carousel">
    <div class="custom-container container-fluid">
        <div class="banner-wrapper-carousel">

            <!-- Slides Container: Holds all images -->
            <div class="slides-container">
                <!-- IMPORTANT: Please replace 'path/to/your/imgN.png' with your actual image URLs -->
                <div class="slide fade active"
                    style="background-image: url('{{ asset('frontend/images/banner/our_services.png') }}');'"></div>
                <div class="slide fade "
                    style="background-image: url('{{ asset('frontend/images/element/patient.png') }}');'"></div>
                <div class="slide fade"
                    style="background-image: url('{{ asset('frontend/images/element/provider.png') }}');"></div>
                <div class="slide fade"
                    style="background-image: url('{{ asset('frontend/images/element/hospital.png') }}');"></div>
                <!-- Add more slides here if needed -->
            </div>

            <!-- Navigation Dots/Indicators -->
            <div class="dot-navigation-container">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <!-- Add more dots corresponding to the slides -->
            </div>
        </div>
    </div>
</section>
