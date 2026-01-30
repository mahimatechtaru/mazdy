<style>
    .medzy-banner-img {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 16px;
    }

    .medzy-banner-img img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 24px;
    }

    @media (max-width: 768px) {
        .medzy-banner-img {
            margin: 24px auto;
        }

        .medzy-banner-img img {
            border-radius: 16px;
        }
    }

    @media (max-width: 768px) {
        .medzy-banner-img img {
            transform: scale(1.05);
        }
    }
</style>
<section class="medzy-banner-img">
    <img src="{{ asset('/frontend/images/banner/our_services.png') }}" alt="Medzy Health Banner">
</section>
