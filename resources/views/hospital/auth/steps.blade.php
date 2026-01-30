<style>
    /* General container and typography */

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .section {
        padding: 10px;
        margin: 30px;
        background-color: #fcfcfcad;
        border: 2px;
        border-radius: 10px;
    }

    .section-title {
        font-size: 36px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .section-subtitle {
        font-size: 18px;
        color: #666;
        max-width: 800px;
        margin: 0 auto 50px auto;
        line-height: 1.6;
    }

    /* Main content layout (image + grid) */
    .content {
        display: flex;
        flex-wrap: wrap;
        /* Allows wrapping on smaller screens */
        gap: 30px;
        /* Space between the image column and features grid */
    }

    .image-column {
        margin-top: auto;
        margin-bottom: auto;
        flex: 1;
        /* Takes up available space */
        min-width: 300px;
        /* Minimum width for the image column */
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        /* Ensures image corners are rounded */
    }

    .main-image {
        width: 100%;
        height: 100%;
        /* Make image fill the column height */
        object-fit: cover;
        /* Cover the area, cropping if necessary */
        border-radius: 12px;
        display: block;
        /* Remove extra space below image */
    }

    .features-grid {
        background: #fff;
        padding: 36px;
        flex: 2;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    /* Feature Card Styling */
    .feature-card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 25px;
        text-align: left;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease-in-out;
        display: flex;
        /* For icon and text alignment */
        flex-direction: column;
        justify-content: flex-start;
        /* Align content to the top */
        min-height: 180px;
        /* Ensure cards have a consistent height */
    }

    .feature-card:hover {
        transform: translateY(-5px);
        color: #637DFE;
    }

    .feature-card i {
        font-size: 5px;
        /* Icon size */
        color: #0b0b0b;
        /* Primary brand color for icons */
        margin-top: 8px;
        margin-bottom: 8px;
        margin-left: auto;
        margin-right: 5px;
        display: block;
        /* Ensures icon is on its own line */
        float: left;
    }

    .feature-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .feature-description {
        font-size: 14px;
        color: #777;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .content {
            flex-direction: column;
            /* Stack columns on medium screens */
        }

        .image-column {
            min-width: unset;
            /* Remove min-width when stacked */
            width: 100%;
            height: auto;
            /* Allow image height to adjust */
        }

        .main-image {
            max-height: 400px;
            /* Limit image height on smaller screens */
        }

        .features-grid {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            /* Adjust grid for smaller screens */
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 28px;
        }

        .section-subtitle {
            font-size: 16px;
        }

        .feature-card {
            padding: 20px;
            min-height: unset;
            /* Remove min-height for very small screens */
        }

        .feature-title {
            font-size: 18px;
        }

        .feature-description {
            font-size: 14px;
        }
    }
</style>
<section class="section">
    <div class="container">
        <h2 class="section-title">How MEDZY Works</h2>
        <p>MEDZY connects patients, hospitals, and verified healthcare service providers to deliver hospital-quality
            care at home with transparency, tracking, and support.</p>

        <div class="content">
            <div class="features-grid">
                <div class="feature-card">
                    <h3 class="feature-title">Step 1: Hospital Onboarding</h3>
                    <p class="feature-description">
                    <ul>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Register hospital
                            on MEDZY</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Upload KYC,
                            agreements, certifications</b></li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Define:</li>
                        <ol class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>o Services &
                            packages offered</ol>
                        <ol class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>o Coverage areas
                        </ol>
                        <ol class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>o Commission
                            terms</ol>
                    </ul>
                    </p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Step 2: Receive Bookings</h3>
                    <p class="feature-description">
                    <ul>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Get assigned
                            bookings from MEDZY admin</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>View patient
                            details & care requirements</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Accept or
                            decline within SLAr</li>
                    </ul>
                    </p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Step 3: Assign Your Team</h3>
                    <p class="feature-description">
                    <ul>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Assign doctors,
                            nurses, ambulance, labs</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Manage rosters &
                            availability</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Coordinate care
                            through hospital dashboard</li>
                    </ul>
                    </p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Step 4: Care Delivery & Monitoring</h3>
                    <p class="feature-description">
                    <ul>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Track service
                            progress in real time</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Communicate with
                            patient securely</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Upload
                            prescriptions, reports & notes</li>
                    </ul>
                    </p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Step 5: Billing & Settlement</h3>
                    <p class="feature-description">
                    <ul>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Raise invoice to
                            MEDZY after completion</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>MEDZY deducts
                            platform commission</li>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>Settlement
                            processed as per agreement</li>
                    </ul>
                    </p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Reports & Dashboard</h3>
                    <p class="feature-description">
                    <ul>
                        <li class="feature-description"><i class="fa fa-circle " aria-hidden="true"></i>View performance
                            metrics:</li>
                        <ol class="feature-description">o Bookings</ol>
                        <ol class="feature-description">o Revenue</ol>
                        <ol class="feature-description">o Response time</ol>
                        <ol class="feature-description">o Pending settlements</ol>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
</section>
