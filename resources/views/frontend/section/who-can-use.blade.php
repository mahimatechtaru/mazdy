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
        width: 60px;
        height: 60px;
        border-radius: 50%;
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

    .icon-box img {
        filter: invert(33%) sepia(92%) saturate(2765%) hue-rotate(203deg) brightness(96%) contrast(92%);
    }
</style>

<section class="homecare-services-section">
    <div class="container">
        <div class="section-tag pb-10">
            <span><i class="las la-heart"></i>
                Who Can Use</span>
            <h2 class="title">Who Can Use Our Services</h2>
        </div>
        <div class="service-cards-grid">
            <div class="service-card-item">
                <div class="icon-box">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
                <h3>Prolonged ICU Stay</h3>
                <p>Being equal to or longer than 10 days. Prolonged ICU stay can adversely
                    affect the health status by increasing the risk of infection, complications, and, possibly,
                    mortality.</p>
                <a href="#" class="service-link">View Details <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="service-card-item">
                <div class="icon-box">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <h3>Cancer Care</h3>
                <p>We provide comprehensive cancer care at home service. Our service includes
                    pain management and supervised cancer support for side effects.</p>
                <a href="#" class="service-link">View Details <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-item">
                <div class="icon-box">
                    <i class="fa-solid fa-bed"></i>
                </div>
                <h3>Terminally III Lung Patients</h3>
                <p>Terminally Ill Lung Patients require special care to survive. Sunburst Healthcare provides special
                    care to them.</p>
                <a href="#" class="service-link">View Details <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-item">
                <div class="icon-box">
                    <i class="fa-solid fa-house-medical-circle-check"></i>
                </div>
                <h3>Neuro Carey</h3>
                <p>Patients recovering from Neurological illnesses often require prolonged care. Such patients benefit
                    greatly from home healthcare.</p>
                <a href="#" class="service-link">View Details <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-item">
                <div class="icon-box">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <h3>Ventilatory & Tracheostomy Care</h3>
                <p>Sunburst Healthcare can provide ventilatory services and tracheostomy care to patients who need such
                    services for extended</p>
                <a href="#" class="service-link">View Details <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-item">
                <div class="icon-box">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <h3>Post Trauma Care</h3>
                <p>Sunburst Healthcare provides Home Care services to patients who are recovering from trauma and need
                    intensive care.</p>
                <a href="#" class="service-link">View Details <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <!--<div class="call-to-action">-->
        <!--    <button id="exploreMoreBtn" class="btn-main">-->
        <!--        Explore More <i class="fas fa-plus"></i>-->
        <!--    </button>-->
        <!--</div>-->
    </div>
</section>
