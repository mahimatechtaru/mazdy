<style>
    #preloader {
        position: fixed;
        inset: 0;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: all 0.4s ease;
    }

    .logo-loader {
        width: 320px;
        animation: fadeZoom 1.2s infinite alternate;
    }

    @keyframes fadeZoom {
        from {
            opacity: 0.6;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1.05);
        }
    }
</style>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="preloader">
    <img src="{{ get_logo() }}" class="logo-loader" alt="Medzy Health">
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


<script>
    window.addEventListener("load", function() {

        document.getElementById("preloader").style.display = "none";
    });
</script>
