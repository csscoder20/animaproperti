@extends('frontend.layouts.app')
<style>
    a.card.p-2.d-flex.flex-column.align-items-center.rounded-3.justify-content-center.text-center {
        box-shadow: 0 0 1px rgba(40, 41, 61, .04), 0 2px 4px rgba(96, 97, 112, .16);
        border: 1px solid #fff;
    }

    span.status-badge.featured.small.text-muted {
        color: #103524;
    }
</style>
@section('content')
@section('title', $title)
<section id="hero" class="hero section pb-0">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="hero-wrapper">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                        <div class="search-container" data-aos="fade-up" data-aos-delay="300">
                            <div class="search-header">
                                <h3>Cari Properti</h3>
                                <p>{{ $settings['welcome_text'] ?? 'Temukan Properti Impian Anda' }}</p>
                            </div>
                            <form action="{{ route('properties.index') }}" method="GET" class="property-search-form">
                                <div class="search-grid">
                                    <div class="search-field">
                                        <label for="search-location" class="field-label">Kota</label>
                                        <select id="search-location" name="lokasi" class="form-select">
                                            <option value="">Semua Kota</option>
                                            @foreach ($kecamatanList as $city)
                                                <option value="{{ $city->kode }}">{{ $city->nama }}</option>
                                            @endforeach
                                        </select>
                                        <i class="bi bi-geo-alt field-icon"></i>
                                    </div>

                                    <div class="search-field">
                                        <label for="search-type" class="field-label">Tipe Properti</label>
                                        <select id="search-type" name="tipe" class="form-select">
                                            <option value="">Semua Properti</option>
                                            @foreach ($propertyTypes as $type)
                                                <option value="{{ $type->slug }}">{{ ucfirst($type->nama) }}</option>
                                            @endforeach
                                        </select>
                                        <i class="bi bi-building field-icon"></i>
                                    </div>

                                    <div class="search-field">
                                        <label for="offering" class="field-label">Jenis Penawaran</label>
                                        <select id="offering" name="offering">
                                            <option value="">Semua</option>
                                            <option value="Disewa">Disewakan</option>
                                            <option value="Dijual">Dijual</option>
                                        </select>
                                        <i class="bi bi-building field-icon"></i>
                                    </div>

                                    <div class="search-field">
                                        <label for="price_range" class="field-label">Harga</label>
                                        <select id="price_range" name="harga">
                                            <option value="">Semua Harga</option>
                                            <option value="<1000"> &lt; 100 Juta</option>
                                            <option value="100-500">100 Juta - 500 Juta</option>
                                            <option value="500-1000">500 Juta - 1 M</option>
                                            <option value=">1000">&gt; 1 M</option>
                                        </select>
                                        <i class="bi bi-cash field-icon"></i>
                                    </div>

                                    <div class="search-field">
                                        <label for="bedrooms" class="field-label">Kamar</label>
                                        <select id="bedrooms" name="kamar">
                                            <option value="">Semua</option>
                                            <option value="1">1 Kamar</option>
                                            <option value="2">2 Kamar</option>
                                            <option value="3">3 Kamar</option>
                                            <option value="4">4 Kamar</option>
                                            <option value="5">5+ Kamar</option>
                                        </select>
                                        <i class="bi bi-door-open field-icon"></i>
                                    </div>
                                </div>

                                <button type="submit" class="search-btn">
                                    <i class="bi bi-search"></i>
                                    <span>Cari</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($featuredProperty)
                    <div class="col-lg-5">
                        <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                            <div class="visual-container mb-3">
                                <div class="featured-property">
                                    <img src="{{ $featuredProperty->gbr_primary_properti
                                        ? asset('storage/' . $featuredProperty->gbr_primary_properti)
                                        : asset('themes/frontend/assets/img/default.png') }}"
                                        alt="Featured Property" class="img-fluid">

                                    <div class="property-info">
                                        <div class="property-price">Rp.
                                            {{ number_format($featuredProperty->harga, 0, ',', '.') }}</div>
                                        <div class="property-details">
                                            <span><i class="bi bi-pin-map"></i>
                                                {{ $featuredProperty->alamat_lengkap }}</span>
                                            <span><i class="bi bi-house"></i>
                                                {{ $featuredProperty->jumlah_kamar_tidur }} Kamar Tidur,
                                                {{ $featuredProperty->jumlah_kamar_mandi }} Kamar Mandi</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="overlay-images">
                                    @foreach ($featuredProperty->images->take(2) as $key => $image)
                                        <div class="overlay-img overlay-{{ $key + 1 }}">
                                            <img src="{{ $image->url }}" alt="Property Image {{ $key + 1 }}"
                                                class="img-fluid">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-lg-10 col-md-12 col-sm-12">
                                        @php $carouselId = 'carouselFeaturedAgents'; @endphp

                                        @if ($featuredProperty && $featuredProperty->agens->count())
                                            <div id="{{ $carouselId }}" class="carousel slide agent-card"
                                                data-bs-ride="false">
                                                <div class="carousel-inner">
                                                    @foreach ($featuredProperty->agens as $i => $agen)
                                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                            <div
                                                                class="agent-profile d-flex align-items-center justify-content-center">
                                                                <img src="{{ $agen->pas_foto ? asset('storage/' . $agen->pas_foto) : asset('themes/frontend/assets/img/default.png') }}"
                                                                    alt="Foto Agen" class="agent-photo">
                                                                <div class="agent-info">
                                                                    <h4>{{ $agen->nama_lengkap }}</h4>
                                                                    <p>{{ $agen->no_hp ?? 'No. HP tidak tersedia' }}
                                                                    </p>
                                                                </div>
                                                                <a href="https://wa.me/{{ $agen->no_hp ?? '628114617733' }}?text={{ urlencode('Halo, saya tertarik dengan properti ini: ' . $featuredProperty->judul . '. Apakah masih tersedia?') }}"
                                                                    target="_blank" class="contact-agent-btn">
                                                                    <i class="bi bi-whatsapp"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @if ($featuredProperty->agens->count() > 1)
                                                    <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                                        <i class="bi bi-chevron-left fs-5 text-success"></i>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                        data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                                        <i class="bi bi-chevron-right fs-5 text-success"></i>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="row flex-nowrap overflow-auto gap-2 pb-2">
                @php
                    $icons = [
                        'Apartemen' => 'bi bi-house-door',
                        'Cluster' => 'bi bi-house',
                        'Gudang' => 'bi bi-box-seam',
                        'Kantor' => 'bi bi-building',
                        'Kost' => 'bi bi-person-lines-fill',
                        'Perumahan' => 'bi bi-houses',
                        'Ruko' => 'bi bi-shop',
                        'Rumah' => 'bi bi-house-check',
                        'Tanah' => 'bi bi-globe',
                        'Villa' => 'bi bi-tree',
                    ];
                @endphp

                @foreach ($propertyTypes as $type)
                    <div class="col-auto">
                        <a href="{{ route('properties.index', ['tipe' => $type->slug]) }}"
                            class="card p-2 d-flex flex-column align-items-center rounded-3 justify-content-center text-center"
                            style="width: 100px; height: 100px;">
                            <i class="{{ $icons[trim($type->nama)] ?? 'bi bi-building' }} fs-3 text-success mb-2"></i>
                            <span class="text-small">{{ $type->nama }}</span>
                        </a>
                    </div>
                @endforeach
            </div>

            @php
                $activeSliders = $sliders->where('is_active', true);
                $countActive = $activeSliders->count();
            @endphp

            <div class="swiper mySwiper mt-4" data-aos="fade-up" data-aos-delay="500">
                <div class="swiper-wrapper mb-3">
                    @foreach ($activeSliders as $slider)
                        <div class="swiper-slide position-relative">

                            @php
                                $imagePath =
                                    $slider->image_path &&
                                    file_exists(storage_path('app/public/' . $slider->image_path))
                                        ? asset('storage/' . $slider->image_path)
                                        : asset('images/no-image.jpg');
                            @endphp

                            @if ($slider->link_url)
                                <a href="{{ $slider->link_url }}">
                                    <img src="{{ $imagePath }}" alt="{{ $slider->title ?? 'Slider Image' }}"
                                        class="img-fluid w-100">
                                </a>
                            @else
                                <img src="{{ $imagePath }}" alt="{{ $slider->title ?? 'Slider Image' }}"
                                    class="img-fluid w-100">
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<section id="featured-properties" class="featured-properties section propertiTerbaru">
    <div class="container section-title" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <h2>Properti Terbaru</h2>
            </div>
        </div>

        <p class="text-left">Temukan pilihan properti terbaru yang siap huni dan sesuai kebutuhan Anda.
            Kami hadirkan properti dengan fasilitas unggulan dan lokasi strategis untuk menunjang gaya hidup modern
            Anda.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper newestPropertiSwiper">
            <div class="swiper-wrapper">
                @foreach ($latestProperties as $property)
                    <div class="swiper-slide">
                        <div class="properties-sidebar">
                            <div class="sidebar-property-card" data-aos="fade-left" data-aos-delay="300">
                                <div class="sidebar-property-image">
                                    <img src="{{ $property->primary_image_url }}" alt="{{ $property->judul }}"
                                        class="img-fluid">
                                    @if ($property->featured == 1)
                                        <span class="status-badge featured">Unggulan</span>
                                    @endif
                                </div>
                                <div class="sidebar-property-content">
                                    <h4>
                                        <a href="{{ route('property.show', $property->id) }}">
                                            {{ $property->judul }}
                                        </a> -
                                        <span
                                            class="status-badge featured small">{{ $property->jenisProperti->nama ?? '-' }}</span>
                                    </h4>
                                    <div class="sidebar-location">
                                        <i class="bi bi-pin-map"></i>
                                        <span>{{ $property->alamat_lengkap }}, {{ $property->kabupaten }},
                                            {{ $property->provinsi }}</span>
                                    </div>
                                    <div class="sidebar-specs">
                                        @if ($property->jenisProperti->nama == 'Tanah')
                                            <span><i class="bi bi-rulers"></i>
                                                LT: {{ number_format($property->luas_tanah ?? 0) }} M<sup>2</sup>
                                            </span>
                                        @else
                                            <span><i class="bi bi-house"></i> KT: {{ $property->jumlah_kamat_tidur }}
                                                BR</span>
                                            <span><i class="bi bi-droplet"></i> KM:
                                                {{ $property->jumlah_kamar_mandi }} BA</span>
                                            <span><i class="bi bi-rulers"></i>
                                                LB: {{ number_format($property->luas_bangunan ?? 0) }} M<sup>2</sup>
                                            </span>
                                            <span><i class="bi bi-rulers"></i>
                                                LT: {{ number_format($property->luas_tanah ?? 0) }} M<sup>2</sup>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="sidebar-price-row">
                                        <div class="sidebar-price">Rp
                                            {{ number_format($property->harga, 0, ',', '.') }}</div>
                                        <a href="{{ route('property.show', $property->id) }}"
                                            class="sidebar-btn">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section id="recent-blog-posts" class="recent-blog-posts section beritaTerbaru">
    <div class="container section-title" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <h2>Berita Terbaru</h2>
            </div>
        </div>
        <p class="text-left">Temukan berita terbaru seputar properti di wilayah timur Indonesia.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper recentSwiper">
            <div class="swiper-wrapper">
                @foreach ($beritaHome as $berita)
                    <div class="swiper-slide">
                        <article class="recent-post">
                            <div class="recent-img">
                                @php
                                    $gambar =
                                        $berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar))
                                            ? asset('storage/' . $berita->gambar)
                                            : asset('themes/frontend/assets/img/default.png');
                                @endphp
                                <img src="{{ $gambar }}" alt="{{ $berita->judul }}" class="img-fluid"
                                    loading="lazy">
                            </div>
                            <div class="recent-content">
                                <h3 class="recent-title">
                                    <a href="{{ route('berita.detail', $berita->slug) }}">{{ $berita->judul }}</a>
                                </h3>
                                <span
                                    class="recent-description mb-3">{{ strip_tags($berita->deskripsi_terbatas) }}</span>
                                <div class="recent-meta mt-3">
                                    <span class="author">By {{ $berita->user->name ?? 'Admin' }}</span>
                                    <span class="date">{{ $berita->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section id="featured-services" class="featured-services section kenapaPilihKami">
    <div class="container section-title" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <h2>Kenapa Animaproperty?</h2>
            </div>
        </div>
        <p class="text-left">
            Animaproperty adalah platform terpercaya untuk menemukan, menjual, dan memasarkan properti di wilayah timur
            Indonesia.
        </p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper kenapaPilihKamiSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Beli Properti Aman & Mudah</a></h3>
                            <p>Temukan hunian impian Anda dengan proses pembelian yang cepat, aman, dan transparan
                                bersama Animaproperty.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-key"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Mitra Properti Terbaik</a></h3>
                            <p>Jadikan Animaproperty sebagai mitra terpercaya untuk membeli, menjual, atau menyewa
                                properti sesuai kebutuhan Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Jual Properti Cepat</a></h3>
                            <p>Pasarkan properti Anda dengan strategi efektif dan jangkauan luas untuk mendapatkan
                                pembeli potensial lebih cepat.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-house-heart"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Sewa Properti Nyaman</a></h3>
                            <p>Temukan pilihan sewa rumah, apartemen, atau ruko dengan harga terbaik dan lokasi
                                strategis sesuai kebutuhan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


<!-- Section Testimoni -->
<section id="testimonials" class="testimonials section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni</h2>
        <p>Pendapat dan pengalaman nyata dari klien kami yang telah menemukan properti impian mereka bersama kami.
            Kepercayaan mereka adalah bukti kualitas layanan kami yang profesional, aman, dan memuaskan.</p>
    </div>

    <div class="container">
        <div class="swiper testimonialSwiper">
            <div class="swiper-wrapper">
                @forelse ($testimonis as $index => $testimoni)
                    <div class="swiper-slide">
                        <div class="testimonial-card {{ $index == 1 ? 'featured' : '' }}" data-aos="zoom-in"
                            data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="testimonial-body">
                                <i class="bi bi-chat-quote-fill quote-icon"></i>
                                <p>“{{ $testimoni->pesan }}”</p>
                                <h6 class="mt-3 mb-0 fw-bold">{{ $testimoni->nama }}</h6>
                                @if ($testimoni->jabatan)
                                    <small class="text-muted">{{ $testimoni->jabatan }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="testimonial-card" data-aos="zoom-in" data-aos-delay="100">
                            <div class="testimonial-body text-center">
                                <i class="bi bi-chat-quote-fill quote-icon"></i>
                                <p class="text-muted fst-italic">Belum ada testimoni yang tersedia saat ini.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


@endsection
