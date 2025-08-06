    <script src="{{ asset('themes/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/js/main.js') }}"></script>
    @if (!empty($settings['google_tag_manager']))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_tag_manager'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ $settings['google_tag_manager'] }}');
        </script>
    @endif
