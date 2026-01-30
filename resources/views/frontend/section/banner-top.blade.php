<style>
    .image-carousel {
        position: relative;
        width: 100%;
        height: 90vh;
        overflow: hidden;
    }

    .carousel-track {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .carousel-image {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .carousel-image.active {
        opacity: 1;
    }

    /* Navigation buttons */
    .nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.4);
        color: #fff;
        border: none;
        font-size: 32px;
        padding: 8px 14px;
        cursor: pointer;
        z-index: 5;
    }

    .nav.prev {
        left: 15px;
    }

    .nav.next {
        right: 15px;
    }

    /* Dots */
    .carousel-dots {
        position: absolute;
        bottom: 20px;
        width: 100%;
        text-align: center;
        z-index: 5;
    }

    .dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        background: #ccc;
        margin: 0 5px;
        border-radius: 50%;
        cursor: pointer;
    }

    .dot.active {
        background: #0b4c8c;
    }
</style>
<script>
    const images = document.querySelectorAll('.carousel-image');
    const dots = document.querySelectorAll('.dot');
    let current = 0;

    function showSlide(index) {
        images.forEach(img => img.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        images[index].classList.add('active');
        dots[index].classList.add('active');
    }


    dots.forEach((dot, index) => {
        dot.onclick = () => {
            current = index;
            showSlide(current);
        };
    });

    // Auto slide
    setInterval(() => {
        current = (current + 1) % images.length;
        showSlide(current);
    }, 500);
</script>

</script>
<section class="banner-section bg-overlay-banner physiotherapy-banner-section-carousel">
    <div class="image-carousel">
        <div class="carousel-track">
            <img src="{{ asset('frontend/images/element//hospital.png') }}" class="carousel-image active">
            <img src="{{ asset('frontend/images/element//patient.png') }}" class="carousel-image">
            <img src="{{ asset('frontend/images/element//provider.png') }}" class="carousel-image">
        </div>


        <!-- Dots -->
        <div class="carousel-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>


</section>
