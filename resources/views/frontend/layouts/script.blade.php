    <script src="{{ asset('themes/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <script>
        $(document).ready(function() {
            if (!sessionStorage.getItem('announcementShown')) {
                $.ajax({
                    url: '/api/announcement/active',
                    method: 'GET',
                    success: function(data) {
                        if (data && data.title) {
                            let htmlContent = `
                                <div style="text-align: left;">
                                    <h5 class="fw-bold">${data.title}</h5>
                                    <p>${data.content}</p>
                                </div>
                            `;

                            Swal.fire({
                                html: htmlContent,
                                icon: data.type ?? 'info',
                                confirmButtonText: 'Close',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                customClass: {
                                    popup: 'text-start',
                                }
                            });

                            if (data.show_once_per_session) {
                                sessionStorage.setItem('announcementShown', true);
                            }
                        }
                    }
                });
            }
        });
    </script>
