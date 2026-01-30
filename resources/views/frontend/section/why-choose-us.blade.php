<style>
/* General container and typography */

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.why-choose-us-section {
    padding: 60px 0;
    background-color: #f0f4f8; /* Light blue-grey background */
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
.why-choose-us-content {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping on smaller screens */
    gap: 30px; /* Space between the image column and features grid */
}

.image-column {
    margin-top: auto;
    margin-bottom: auto;
    flex: 1; /* Takes up available space */
    min-width: 300px; /* Minimum width for the image column */
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Ensures image corners are rounded */
}

.main-image {
    width: 100%;
    height: 100%; /* Make image fill the column height */
    object-fit: cover; /* Cover the area, cropping if necessary */
    border-radius: 12px;
    display: block; /* Remove extra space below image */
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
    display: flex; /* For icon and text alignment */
    flex-direction: column;
    justify-content: flex-start; /* Align content to the top */
    min-height: 180px; /* Ensure cards have a consistent height */
}

.feature-card:hover {
    transform: translateY(-5px);
     color: #637DFE;
}

.feature-card i {
    font-size: 40px; /* Icon size */
    color: #637DFE; /* Primary brand color for icons */
    margin-bottom: 15px;
    margin-left: auto;
    margin-right: auto;
    display: block; /* Ensures icon is on its own line */
}

.feature-title {
    font-size: 20px;
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
    .why-choose-us-content {
        flex-direction: column; /* Stack columns on medium screens */
    }
    .image-column {
        min-width: unset; /* Remove min-width when stacked */
        width: 100%;
        height: auto; /* Allow image height to adjust */
    }
    .main-image {
        max-height: 400px; /* Limit image height on smaller screens */
    }
    .features-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Adjust grid for smaller screens */
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
        min-height: unset; /* Remove min-height for very small screens */
    }
    .feature-title {
        font-size: 18px;
    }
    .feature-description {
        font-size: 14px;
    }
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<section class="why-choose-us-section">
    <div class="container">
        <h2 class="section-title">Why Choose Us?</h2>

        <div class="why-choose-us-content">
            <div class="image-column">
                <img src="https://www.apollohomecare.com/assets/why-choose-us.png" alt="Caregiver assisting elderly patient" class="main-image">
            </div>
            <div class="features-grid">
                <div class="feature-card">
                   <i class="fa-solid fa-handshake"></i><h3 class="feature-title">Verified & Experienced Providers</h3>
                    <p class="feature-description">
                        Access a network of highly qualified and thoroughly vetted healthcare professionals
                    </p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-clock"></i> <h3 class="feature-title">24/7 Availability</h3>
                    <p class="feature-description">
                       Medical support and services available around the clock, whenever you need them. 
                    </p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-hands-holding-circle"></i> <h3 class="feature-title"> Personalized Care Plans</h3>
                    <p class="feature-description">
                        Tailored treatment plans designed to meet your unique health needs and preferences.
                    </p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-user-doctor"></i><h3 class="feature-title">Integrated Digital Health</h3>
                    <p class="feature-description">
                         Seamless digital tools for appointments, records, and communication.
                    </p>
                </div>
                
        </div>
    </div>
</section>