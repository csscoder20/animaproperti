@extends('frontend.layouts.app')
@section('title', $title)

@push('styles')
<style>
.pricing-section {
  background: linear-gradient( 135deg, var(--accent-color), color-mix(in srgb, var(--accent-color), #6a11cb 30%) );
  padding: 25px;
  border-radius: 20px;
  margin-bottom: 30px;
  color: #ffffff;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.pricing-section .main-price {
    color: #ffffff;
    font-weight: 800;
    margin-bottom: 0;
    font-size: 1.5rem;
}
</style>
@endpush

@section('content')
    <section id="property-details" class="property-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-7">
                    <div class="property-hero mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="hero-image-container">
                            <div class="property-gallery-slider swiper init-swiper">
                                <div class="swiper-wrapper">
                                    @if ($property->images->isNotEmpty())
                                        @foreach ($property->images as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $image->path) }}"
                                                    alt="{{ $property->judul }}" class="img-fluid">
                                                <div class="hero-overlay">
                                                    <div class="property-badge">
                                                        <span
                                                            class="status-badge for-rent">{{ $property->penawaran }}</span>
                                                        @if ($property->unggulan == 1)
                                                            <span class="status-badge featured">Unggulan</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <img src="{{ asset('themes/frontend/assets/img/default.png') }}"
                                                alt="Default Image" class="img-fluid">
                                            <div class="hero-overlay">
                                                <div class="property-badge">
                                                    <span class="status-badge for-rent">{{ $property->penawaran }}</span>
                                                    @if ($property->unggulan == 1)
                                                        <span class="status-badge featured">Unggulan</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                        </div>

                        <div class="thumbnail-gallery mt-3">
                            <div class="property-thumbnails-slider swiper init-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($property->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $image->path) }}"
                                                class="img-fluid thumbnail-img" alt="Thumbnail {{ $loop->iteration }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-title bg-transparent py-3 mb-4">
                        <div class="container d-lg-flex justify-content-between align-items-center">
                            <nav class="breadcrumbs">
                                <ol>
                                    <li><a href="{{ '/sewa' }}">Sewa</a></li>
                                    <li class="current">Detail Properti</li>
                                </ol>
                            </nav>
                        </div>
                    </div>


                    <div class="property-details mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="fw-bold">Deskripsi Properti</h3>
                        <p>{{ strip_tags($property->deskripsi ?? '-') }}</p>
                    </div>

                    <h3 class="fw-bold">Lokasi Properti</h3>
                    @if ($mapsUrl)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="map-wrapper">
                                    <iframe src="{{ $mapsUrl }}" width="100%" height="350" style="border:0;"
                                        allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    @else
                        <p><i>Lokasi belum tersedia.</i></p>
                    @endif


                </div>

                <div class="col-lg-5">
                    <div class="sticky-sidebar">
                        

                        <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="350">
                            <div class="card-body p-4">
                                <div class="property-header mb-3">
                                    <h1 class="fw-bold fs-4 mb-2">{{ $property->judul ?? '-' }}</h1>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $alamatLengkap }}
                                    </p>
                                   
                                </div>

                                <hr>

                                <div class="facilities-section mt-3">
                                    <h5 class="fw-bold fs-6 mb-3">Fasilitas</h5>
                                    <div class="row g-2">
                                        <ul class="list-unstyled mt-3">
                                            @if ($property->fasilitas->count() > 0)
                                                @foreach ($property->fasilitas as $fasilitas)
                                                    <li class="mb-2">
                                                        <i class="bi {{ $fasilitas->icon ?? 'bi-check-circle' }} me-2"></i>
                                                        <span>{{ $fasilitas->nama }}</span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="text-muted">Currently no facilities data available.</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="pricing-section">
                                        <h3 class="main-price fs-5">
                                            Rp. {{ number_format($property->harga, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $agens = $property->agens;
                        @endphp
                        <div class="card mb-4 border-0 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body p-4">
                                <h4 class="fw-bold mb-3">Pesan Sekarang</h4>
                                <p class="text-muted small mb-4">Isi formulir pemesanan untuk mengecek ketersediaan dan booking via WhatsApp.</p>
                                <a href="{{ route('sewa.booking', $property->slug) }}" class="btn btn-primary w-100 py-3 fw-bold btn-custom-accent">
                                    <i class="bi bi-calendar-check me-2"></i> Lanjut ke Pemesanan
                                </a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="location-section mt-5" data-aos="fade-up" data-aos-delay="700">
            </div>
        </div>

    </section>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var thumbnailSwiper = new Swiper('.property-thumbnails-slider', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
            });

            // Inisialisasi galeri utama, dikaitkan dengan thumbnail
            var gallerySwiper = new Swiper('.property-gallery-slider', {
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: thumbnailSwiper,
                },
            });
        });
    </script>

@endsection
