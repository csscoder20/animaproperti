    <script src="{{ asset('themes/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('themes/frontend/assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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


    @if (request()->is('/'))
        <script>
            var slideCount = {{ $countActive }};
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: slideCount === 1 ? 1 : 1,
                spaceBetween: 10,
                breakpoints: slideCount === 1 ? {} : {
                    768: {
                        slidesPerView: 1.5,
                        spaceBetween: 20
                    },
                    992: {
                        slidesPerView: 1.5,
                        spaceBetween: 20
                    },
                },
                freeMode: true,
                grabCursor: true,
                pagination: {
                    el: ".mySwiper .swiper-pagination",
                    clickable: true
                }
            });
        </script>

        <script>
            new Swiper(".recentSwiper", {
                slidesPerView: 1.2,
                spaceBetween: 15,
                breakpoints: {
                    768: {
                        slidesPerView: 2.5,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                },
                grabCursor: true,
                pagination: {
                    el: ".recentSwiper .swiper-pagination",
                    clickable: true
                }
            });
        </script>

        <script>
            var swiper = new Swiper('.newestPropertiSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        </script>

        <script>
            var swiper = new Swiper('.propertiDijual', {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        </script>
        <script>
            var swiper = new Swiper('.kenapaPilihKami', {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        </script>

        <script>
            var swiper = new Swiper('.kenapaPilihKamiSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        </script>
    @endif
