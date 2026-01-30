<style>
    .plans-section {
        padding: 60px 20px;
    }

    .section-title {
        text-align: center;
        font-size: 30px;
        margin-bottom: 40px;
    }

    .plans-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .plan-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .plan-card h3 {
        margin-bottom: 10px;
        color: #0b5ed7;
    }

    .price {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .plan-card ul {
        list-style: none;
        padding: 0;
    }

    .plan-card li {
        margin-bottom: 8px;
        font-size: 14px;
    }

    .plan-card.highlight {
        background: #e8f1ff;
        transform: scale(1.05);
    }

    .note {
        text-align: center;
        margin-top: 30px;
        font-size: 13px;
        color: #777;
    }
</style>
<section class="plans-section">
    <div class="container">
        <h2 class="section-title">Subscription Plans</h2>

        <div class="plans-grid">
            <div class="plan-card">
                <h3>Basic</h3>
                <p class="price">₹11,800 / year</p>
                <ul>
                    <li>Emergency help (108 / 100)</li>
                    <li>Doctor & health worker support</li>
                    <li>On-demand services</li>
                    <li>Medical equipment kit</li>
                </ul>
            </div>

            <div class="plan-card">
                <h3>Recovery</h3>
                <p class="price">₹22,800 / year</p>
                <ul>
                    <li>Monthly emergency training</li>
                    <li>Emergency medicines</li>
                    <li>Basic + additional recovery care</li>
                </ul>
            </div>

            <div class="plan-card highlight">
                <h3>Rejuvenation (O₂ Therapy)</h3>
                <p class="price">₹22,800 – ₹8L*</p>
                <ul>
                    <li>Medical accommodation</li>
                    <li>Biosafe environment</li>
                    <li>BP & sugar monitoring</li>
                    <li>Controlled temperature & O₂</li>
                </ul>
            </div>

            <div class="plan-card">
                <h3>Advance</h3>
                <p class="price">₹22,800 – ₹8L*</p>
                <ul>
                    <li>CCU bed & monitor</li>
                    <li>Rental equipment</li>
                    <li>Prescribed by clinician</li>
                </ul>
            </div>
        </div>

        <p class="note">
            *Additional charges applicable as per service provider and medical requirement.
        </p>
    </div>
</section>
