@php
    use App\Models\Service;

    // Fetch all services
    $services = Service::all();
@endphp

<style>
    /* BASE CSS */
    .homecare-services-section {
        padding: 10px 0;
        background-color: #ffffff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-title {
        font-size: 2.5em;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .section-subtitle {
        font-size: 1.1em;
        color: #666;
        margin-bottom: 50px;
    }

    .service-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .service-card-item {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        text-align: left;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .service-card-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .service-card-item h3 {
        font-size: 1.3em;
        font-weight: 600;
        color: #333;
        margin: 15px 0 10px;
    }

    .service-card-item p {
        color: #777;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .icon-box {
        width: 100%;
        height: 250px;
        background-color: #637dfe34;
        color: #637DFE !important;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.8em;
        margin-bottom: 10px;
    }

    .service-link {
        display: inline-block;
        color: #000;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95em;
    }

    .service-link:hover {
        color: #0d6efd;
    }

    .call-to-action {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .btn-main {
        background: linear-gradient(90.88deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-main:hover {
        background-color: #637dfe34;
    }

    #moreServices {
        display: none;
        grid-column: 1 / -1;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    #moreServices.show {
        display: grid;
    }

    .btn-secondary-toggle {
        background-color: transparent;
        color: #000;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        border: 2px solid #637DFE;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-secondary-toggle:hover {
        background-color: #637dfe34;
    }

    /*
        .icon-box img {
            filter: invert(33%) sepia(92%) saturate(2765%) hue-rotate(203deg) brightness(96%) contrast(92%);
        } */
</style>

<section class="homecare-services-section">
    <div class="container">
        <div class="section-tag pb-20">
            <span><i class="las la-heart"></i>
                Services</span>
            <h2 class="title">What We Offer</h2>
        </div>
        <div class="service-cards-grid">
            @foreach ($services as $index => $service)
                @if ($index == 6)
        </div>
        <div id="moreServices" class="service-cards-grid">
            @endif

            <div class="service-card-item">
                <div class="icon-boxx">
                    @if ($service->icon)
                        <img src="{{ asset('' . $service->icon) }}" alt="{{ $service->name }}"
                            style="width:100%;height:200px;">
                    @else
                        <i class="fas fa-capsules"></i>
                    @endif
                </div>
                <h3>{{ $service->name }}</h3>
                <p>{{ $service->description }}</p>
                <a href="{{ url('getservice-form/' . $service->id) }}" class="service-link">View Details <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            @endforeach
        </div>

        <div class="call-to-action">
            <button id="exploreMoreBtn" class="btn-main">
                Explore More <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const moreServices = document.getElementById('moreServices');
        const exploreBtn = document.getElementById('exploreMoreBtn');

        exploreBtn.addEventListener('click', function() {
            moreServices.classList.toggle('show');

            if (moreServices.classList.contains('show')) {
                exploreBtn.innerHTML = 'Show Less <i class="fas fa-minus"></i>';
                exploreBtn.classList.remove('btn-main');
                exploreBtn.classList.add('btn-secondary-toggle');
            } else {
                exploreBtn.innerHTML = 'Explore More <i class="fas fa-plus"></i>';
                exploreBtn.classList.add('btn-main');
                exploreBtn.classList.remove('btn-secondary-toggle');
            }

            exploreBtn.scrollIntoView({
                behavior: 'smooth',
                block: 'end'
            });
        });
    });
</script>
