<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link href="{{ asset('themes/frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('themes/frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('themes/frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/frontend/assets/css/main.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>
    .view-masonry,
    .view-rows {
        display: none;
    }

    .view-masonry.active,
    .view-rows.active {
        display: block;
    }

    .text-small {
        font-size: 0.875rem;
    }

    * {
        font-family: "Segoe UI";
    }

    .btn-view-all-5newest-properties {
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 50px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: var(--accent-color);
        color: var(--contrast-color);
        border-color: var(--accent-color);
    }

    .detailProperty {
        background-color: var(--accent-color);
        border-radius: 30px;
        color: #fff;
        border: 0;
    }

    .detailProperty:hover {
        background-color: var(--accent-color);
        font-weight: bold;
    }

    .propertiDisewakan .section-title h2:after,
    .propertiDijual .section-title h2:after,
    .beritaTerbaru .section-title h2:after,
    .kenapaPilihKami .section-title h2:after,
    .propertiTerbaru .section-title h2:after {
        content: "";
        position: absolute;
        display: block;
        width: 50px;
        height: 3px;
        background: var(--accent-color);
        left: 0;
        right: auto !important;
        bottom: 0;
        margin: auto;
    }

    .propertiDisewakan p.text-left,
    .propertiDijual p.text-left,
    .kenapaPilihKami p.text-left,
    .beritaTerbaru p.text-left,
    .propertiTerbaru p.text-left {
        text-align: left;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }

    @media (min-width: 1200px) {
        a.waMe.btn.btn-success.px-3.py-2.rounded-pill {
            padding: 15px !important;
        }
    }

    .swiper {
        width: 100%;
        padding-bottom: 20px;
    }

    .swiper-slide img {
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .newestPropertiSwiper .swiper-wrapper,
    .kenapaPilihKami .swiper-wrapper,
    .recentSwiper .swiper-wrapper {
        height: auto !important;
    }

    .swiper-pagination-bullet-active {
        width: 30px !important;
        border-radius: 10px !important;
    }

    span.swiper-pagination-bullet {
        width: 15px;
        border-radius: 5px;
    }
</style>
