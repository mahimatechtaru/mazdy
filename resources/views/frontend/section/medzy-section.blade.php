<style>
    /* Container for the whole card */
    .medzy-card {
        font-family: "Montserrat", sans-serif, sans-serif;
        font-weight: 600;

        /* Dimensions and spacing */
        max-width: 1050px;
        margin: 0px auto;
        /* Centers the card horizontally */
        padding: 50px;

        /* Background Gradient (Teal/Cyan) */
        /* background: linear-gradient(to right, #637DFE, #203499); */
        background-image: url('{{ asset('/frontend/images/banner/know-more.png') }}');
        background-size: cover;

        /* Rounded Corners */
        border-radius: 20px;

        /* Text alignment and color */
        text-align: center;
        color: white;

        /* Optional: Subtle lift/shadow */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Title Styling */
    .medzy-title {
        font-size: 2em;
        margin-bottom: 20px;
        font-weight: 500;
        /* Medium weight */
    }

    /* Paragraph Text Styling */
    .medzy-text {
        font-family: Arial, sans-serif;
        /* Ensuring a readable font */
        font-size: 1.1em;
        line-height: 1.6;
        margin-bottom: 30px;
        /* Keeps the text block narrow for better readability */
        max-width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    /* Button Styling */
    .medzy-button {
        /* Button appearance */
        background-color: white;
        color: linear-gradient(to right, #637DFE, #203499);

        /* Padding and shape */
        padding: 12px 30px;
        border: none;
        border-radius: 30px;
        /* Pill-shape */

        /* Font and pointer */
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;

        /* Transition for smooth hover effect */
        transition: background-color 0.3s, opacity 0.3s, box-shadow 0.3s;
    }

    /* Button Hover Effect */
    .medzy-button:hover {
        opacity: 0.9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<section class="medzy-card bg-img">
    <div class="row justify-content-center">
        <div class="col-lg-5 text-center">

        </div>
        <div class="col-lg-7 text-center">
            <h2 class="medzy-title text-white">How does Medzy make Homecare safe and better?</h2>
            <p class="medzy-text">
                Medzy Homecare ensures safe and quality care by providing trusted, professionally
                trained, and verified caregivers by prioritizing clinical excellence, and patient safety
                over mere convenience.
            </p>
            <a href="{{ route('user.register') }}"> <button class="medzy-button">Know More</button></a>
        </div>

    </div>

</section>
