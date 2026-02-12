@extends('frontend.layouts.app')
@section('title', $title)
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

                    <div class="property-info mb-5" data-aos="fade-up" data-aos-delay="300">
                        <div class="property-header">
                            <h1 class="property-title">{{ $property->judul ?? '-' }}</h1><span></span>
                            <div class="property-meta">
                                <span class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $alamatLengkap }}
                                </span>
                            </div>
                        </div>

                        <div class="pricing-section">
                            <div class="main-price fs-5">Rp. {{ number_format($property->harga, 0, ',', '.') }}<span
                                    class="period"></span></div>

                        </div>
                    </div>
                    <div class="property-details mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="fw-bold">Deskripsi Properti</h3>
                        <p>{{ strip_tags($property->deskripsi ?? '-') }}</p>

                        <ul class="list-unstyled mt-3">
                            @if ($property->jenisProperti->nama == 'Tanah')
                                <i class="bi bi-bounding-box me-2"></i>
                                <span>Luas Tanah:</span> <strong>{{ $property->luas_tanah ?? '-' }} m<sup>2</sup></strong>
                            @else
                                <i class="bi bi-house-door me-2"></i>
                                <span>KT:</span> <strong>{{ $property->jumlah_kamar_tidur ?? '-' }}</strong>
                                <i class="bi bi-droplet me-2"></i>
                                <span>KM:</span> <strong>{{ $property->jumlah_kamar_mandi ?? '-' }}</strong>
                                <i class="bi bi-aspect-ratio me-2"></i>
                                <span>LB:</span> <strong>{{ $property->luas_bangunan ?? '-' }} m<sup>2</sup></strong>
                                <i class="bi bi-bounding-box me-2"></i>
                                <span>LT:</span> <strong>{{ $property->luas_tanah ?? '-' }} m<sup>2</sup></strong>
                            @endif
                        </ul>


                        <div class="features-grid mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="fw-bold">Fasilitas</h5>
                                    <ul class="feature-list">
                                        @if ($property->facilities && $property->facilities->count())
                                            @foreach ($property->facilities as $feature)
                                                <li>
                                                    <i class="{{ $feature->icon ?? 'bi bi-check2' }}"></i>
                                                    {{ $feature->name }}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
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

                        <div class="agent-card mb-4" data-aos="fade-up" data-aos-delay="350">
                            <h4 class="fw-bold mb-3">Kontak Agen</h4>
                            <p>Agen kami siap membantu Anda mendapatkan properti idaman Anda!</p>
                            <hr>
                            <div class="row">
                                <div id="agentCarousel" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        @foreach ($agens as $index => $agen)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div
                                                    class="agent-header d-flex gap-4 p-4 d-flex align-items-center justify-content-center">
                                                    <div class="agent-avatar">
                                                        @if ($agen->pas_foto)
                                                            <img src="{{ asset('storage/' . $agen->pas_foto) }}"
                                                                alt="{{ $agen->nama_lengkap }}">
                                                        @else
                                                            <img src="{{ asset('themes/frontend/assets/img/default.png') }}"
                                                                alt="Agen Default">
                                                        @endif
                                                        <div class="online-status"></div>
                                                    </div>
                                                    <div class="agent-info">
                                                        <h4 class="fw-bold">{{ $agen->nama_lengkap }}</h4>
                                                        <div class="contact-item mt-2">
                                                            <i class="bi bi-envelope"></i>
                                                            <span>{{ $agen->email }}</span>
                                                        </div>

                                                        @php
                                                            $socialMap = [
                                                                'instagram' => 'instagram',
                                                                'facebook' => 'facebook',
                                                                'twitter' => 'twitter-x',
                                                                'tiktok' => 'tiktok',
                                                                'linkedin' => 'linkedin',
                                                                'youtube' => 'youtube',
                                                                'whatsapp' => 'whatsapp',
                                                            ];
                                                        @endphp

                                                        @if ($agen->social_media && $agen->social_media_id)
                                                            <div class="contact-item mt-2">
                                                                <i
                                                                    class="bi bi-{{ $socialMap[strtolower($agen->social_media)] ?? 'question-circle' }}"></i>
                                                                <span>{{ $agen->social_media_id }}</span>
                                                            </div>
                                                        @endif

                                                        {{-- ✅ Tombol WA sesuai agen --}}
                                                        @if ($agen->no_hp)
                                                            <div class="agent-actions mt-3">
                                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agen->no_hp) }}?text={{ urlencode('Halo, saya tertarik dengan properti ini: ' . $property->judul . '. Apakah masih tersedia?') }}"
                                                                    class="btn btn-success w-100 mb-2" target="_blank">
                                                                    <i class="bi bi-whatsapp"></i> WA Sekarang
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    <!-- Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#agentCarousel"
                                        data-bs-slide="prev">
                                        <i class="bi bi-chevron-left fs-5 text-success"></i>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#agentCarousel"
                                        data-bs-slide="next">
                                        <i class="bi bi-chevron-right fs-5 text-success"></i>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
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
