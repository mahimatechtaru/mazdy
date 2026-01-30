<style>
    /* --- Variables & Base Styles --- */
    :root {
        --color-primary-blue: #007bff;
        /* Similar to Doctro's main button */
        --color-light-blue: #e6f2ff;
        --color-best-value-orange: #ff914d;
        --color-best-value-dark: #cc5e00;
        --color-text-dark: #333;
        --color-text-light: #666;
        --color-border: #eee;
        --font-family-sans: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .msh-assurance-plans {
        padding: 10px 20px;
        /* background-color: #f9f9f9; Light gray background */
        font-family: var(--font-family-sans);
        color: var(--color-text-dark);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* --- Header Styling --- */
    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-header h2 {
        font-size: 2.5em;
        font-weight: 700;
        color: var(--color-primary-blue);
        /* Blue header accent */
        margin-bottom: 10px;
    }

    .section-header p {
        font-size: 1.1em;
        color: var(--color-text-light);
    }

    /* --- Grid Layout --- */
    .plans-grid {
        display: flex;
        gap: 30px;
        overflow: hidden;
        scroll-behavior: smooth;
    }

    /* --- Plan Card Styling --- */
    .plan-card {
        flex: 0 0 calc(33.333% - 20px);
        /* 3 cards at a time */
        max-width: calc(33.333% - 20px);
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        /* Subtle shadow for depth */
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid var(--color-border);
    }

    .plan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Plan Header */
    .plan-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .plan-header h3 {
        font-size: 1.5em;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .price-box {
        margin: 15px 0;
    }

    .price-value {
        font-size: 2.2em;
        font-weight: 800;
        color: var(--color-primary-blue);
    }

    .duration {
        font-size: 1em;
        color: var(--color-text-light);
    }

    .family-details {
        font-size: 0.9em;
        color: var(--color-text-light);
        border-bottom: 1px dashed var(--color-border);
        padding-bottom: 15px;
    }

    /* Features List */
    .features-list {
        list-style: none;
        padding: 0;
        margin: 15px 0;
        flex-grow: 1;
        /* Makes lists fill remaining space */
    }

    .features-list li {
        list-style: none;
        position: relative;
        padding-left: 28px;
        margin-bottom: 12px;
    }

    .features-list li::before {
        content: "✓";
        color: #1e90ff;
        /* blue tick */
        font-weight: bold;
        position: absolute;
        left: 0;
        top: 2px;
    }

    .benefits-list li {
        list-style: none;
        position: relative;
        padding-left: 20px;
        margin-bottom: 10px;
    }

    .benefits-list li::before {
        content: "•";
        color: #1e90ff;
        /* blue dot */
        font-size: 20px;
        position: absolute;
        left: 0;
        top: 0;
    }

    .icon {
        margin-right: 10px;
        font-weight: bold;
        min-width: 15px;
        margin-top: 3px;
    }

    /* Placeholder for checkmark icon (ideally use an SVG or FontAwesome) */
    .icon.check-blue::before {
        content: "✓";
        color: var(--color-primary-blue);
        font-size: 1.1em;
    }

    /* Discounts */
    .discounts {
        margin: 15px 0;
        padding: 10px;
        background-color: var(--color-light-blue);
        border-radius: 8px;
        font-size: 0.9em;
        color: var(--color-primary-blue);
    }

    .discounts p {
        margin: 5px 0;
    }

    /* --- Buttons --- */
    .platform-benefits-btn {
        width: 100%;
        background-color: #fff;
        color: var(--color-text-dark);
        border: 1px solid var(--color-border);
        padding: 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1em;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s;
    }

    .platform-benefits-btn:hover {
        background-color: var(--color-border);
    }

    .cta-button {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 8px;
        font-size: 1.1em;
        font-weight: 600;
        cursor: pointer;
        text-transform: uppercase;
        transition: background-color 0.2s, transform 0.1s;
        margin-top: auto;
        /* Pushes the button to the bottom */
    }

    .primary-blue {
        background-color: var(--color-primary-blue);
        color: white;
    }

    .primary-blue:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
    }

    /* --- Best Value Plan Specific Styling --- */
    .plan-card.best-value {
        /* Optional: Make the best value card slightly stand out */
        border-color: var(--color-best-value-orange);
        box-shadow: 0 8px 20px rgba(255, 145, 77, 0.15);
    }

    .best-value-tag {
        position: absolute;
        top: 0;
        right: 20px;
        background: linear-gradient(135deg, var(--color-best-value-orange) 0%, var(--color-best-value-dark) 100%);
        color: white;
        font-weight: 700;
        padding: 5px 15px;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        text-transform: uppercase;
        font-size: 0.8em;
    }

    /* --- Slide Animation for Discounts --- */
    .discounts {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.3s ease;
        padding: 0 10px;
        /* initial padding zero effect */
    }

    .discounts.open {
        max-height: 200px;
        /* enough height for content */
        padding: 10px;
    }

    /* --- Mobile Responsiveness --- */
    @media (max-width: 768px) {
        .plans-grid {
            grid-template-columns: 1fr;
        }

        .plan-card {
            padding: 25px;
        }
    }
</style>

<!-- <section class="msh-assurance-plans"> -->
<div class="container">
    <div class="flex justify-between md:flex-row sm:flex-row xxsm:flex-col">
        <div class="sm:py-3 md:py-0 msm:py-3 xsm:py-3 xxsm:py-3">
            <h2
                class="font-medium 2xl:text-4xl xl:text-4xl xlg:text-4xl lg:text-4xl xmd:text-4xl md:text-3xl msm:text-2xl sm:text-2xl xsm:text-2xl xxsm:text-2xl leading-10 font-fira-sans text-black">
                Subscription Plans
            </h2>
        </div>
        <div class="flex">
            <button type="button"
                class="prev w-10 md:px-2 lg:text-base lg:py-2 md:text-sm md:py-2 sm:py-2 sm:px-3 msm:py-2 msm:px-3 xsm:py-2 xsm:px-3 xxsm:py-2 xxsm:px-3 text-primary border border-primary text-center">
                <svg class="m-auto" width="8" height="12" viewBox="0 0 8 12" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.29303 11.707L0.586032 5.99997L6.29303 0.292969L7.70703 1.70697L3.41403 5.99997L7.70703 10.293L6.29303 11.707Z" />
                </svg>
            </button>
            <button type="button"
                class="ml-2 next w-10 md:px-2 lg:text-base lg:py-2 md:text-sm md:py-2 sm:py-2 sm:px-3 msm:py-2 msm:px-3 xsm:py-2 xsm:px-3 xxsm:py-2 xxsm:px-3 text-primary border border-primary text-center">
                <svg class="m-auto" width="8" height="12" viewBox="0 0 8 12" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.70697 11.707L7.41397 5.99997L1.70697 0.292969L0.292969 1.70697L4.58597 5.99997L0.292969 10.293L1.70697 11.707Z" />
                </svg>
            </button>
        </div>

    </div>

    <p class="">Comprehensive healthcare solutions designed for your family's wellbeing</p>

    <div class="plans-grid">
        @foreach ($subscriptionPlans as $package)
            <div class="plan-card {{ $package->best_value ? 'best-value' : '' }}">

                {{-- BEST VALUE --}}
                @if ($package->best_value)
                    <div class="best-value-tag">BEST VALUE</div>
                @endif

                <div class="plan-header">
                    <h3>{{ $package->name }}</h3>

                    <div class="price-box blue-accent">
                        <span class="price-value">
                            ₹{{ number_format($package->price) }}
                        </span>
                        <span class="duration">
                            / {{ $package->duration }}
                        </span>
                    </div>

                    <p class="family-details">
                        Family: {{ $package->member }}
                    </p>
                </div>

                {{-- FEATURES / BENEFITS --}}
                @if (!empty($package->description))
                    <ul class="features-list">
                        {!! $package->description !!}
                    </ul>
                @endif
                <button class="platform-benefits-btn">
                    Platform Benefits <span>&#x25be;</span>
                </button>

                @if (!empty($package->benefits))
                    <div class="discounts">
                        <ul class="benefits-list">
                            {!! $package->benefits !!}
                        </ul>
                    </div>
                @endif



            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".platform-benefits-btn").forEach(btn => {
                btn.addEventListener("click", function() {

                    const discounts = this.nextElementSibling;
                    const arrow = this.querySelector("span");

                    discounts.classList.toggle("open");

                    arrow.innerHTML = discounts.classList.contains("open") ?
                        "&#x25b4;" // up
                        :
                        "&#x25be;"; // down
                });
            });

        });
    </script>
