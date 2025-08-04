@extends('frontend.layouts.app')
@section('content')
@section('title', $title)

<section id="hero" class="hero section pb-0">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="hero-wrapper">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                        <div class="content-header">
                            <span class="hero-label">
                                <i class="bi bi-house-heart"></i>
                                Hunian Impian Anda
                            </span>
                            <h1>Temukan Sekarang!</h1>
                        </div>
                        <div class="search-container" data-aos="fade-up" data-aos-delay="300">
                            <div class="search-header">
                                <h3>Cari Properti</h3>
                                <p>Temukan Ribuan Daftar Terverifikasi</p>
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
                                                            <p>{{ $agen->no_hp ?? 'No. HP tidak tersedia' }}</p>
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
                                                <i class="bi bi-arrow-left-circle-fill fs-5 text-success"></i>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                                <i class="bi bi-arrow-right-circle-fill fs-5 text-success"></i>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

<section id="featured-services" class="featured-services section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-info">
                        <h3>Properti by Wilayah</h3>
                        <p>Temukan properti terdekat di wilayah Anda</p>
                        <div class="row">
                            @foreach ($kecamatanList->chunk(ceil($kecamatanList->count() / 4)) as $chunk)
                                <div class="col-lg-3 col-sm-6">
                                    <ul class="service-highlights">
                                        @foreach ($chunk as $city)
                                            <li>
                                                <i class="bi bi-check-circle-fill"></i>
                                                <a href="{{ route('properties.index', ['lokasi' => $city->kode]) }}">
                                                    {{ $city->nama }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="400">
                <div class="service-card">
                    <div class="service-info">
                        <h3>Ragam Properti</h3>
                        <p>Temukan berbagai jenis properti sesuai kebutuhan dan anggaran Anda dengan cepat dan efisien.
                        </p>
                        <div class="row">
                            @foreach ($propertyTypes->chunk(ceil($propertyTypes->count() / 3)) as $chunk)
                                <div class="col-lg-4 col-sm-6">
                                    <ul class="service-highlights">
                                        @foreach ($chunk as $type)
                                            <li>
                                                <i class="bi bi-check-circle-fill"></i>
                                                <a href="{{ route('properties.index', ['tipe' => $type->slug]) }}">
                                                    {{ $type->nama }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
        <div class="row gy-5">
            @foreach ($latestProperties as $property)
                <div class="col-lg-6">
                    <div class="property-card-horizontal" data-aos="zoom-in" data-aos-delay="200">
                        <div class="property-image-horizontal">
                            <img src="{{ $property->primary_image_url }}" alt="{{ $property->judul }}"
                                class="img-fluid">
                            @if ($property->featured)
                                <div class="property-badge-horizontal featured">Featured</div>
                            @endif
                        </div>
                        <div class="property-content-horizontal">
                            <h3><a href="{{ route('property.show', $property->id) }}">{{ $property->judul }}</a></h3>
                            <div class="property-location-horizontal">
                                <i class="bi bi-pin-map"></i>
                                <span>{{ $property->alamat_lengkap }}, {{ $property->kabupaten }},
                                    {{ $property->provinsi }}</span>
                            </div>
                            <div class="property-features">
                                <span class="feature"><i class="bi bi-house"></i>KT:
                                    {{ $property->jumlah_kamat_tidur }}
                                </span>
                                <span class="feature"><i class="bi bi-droplet"></i>KM:
                                    {{ $property->jumlah_kamar_mandi }}
                                </span>
                                <span class="feature"><i class="bi bi-rulers"></i>
                                    LB: {{ number_format($property->luas_bangunan) }} m<sup>2</sup></span>
                                <span class="feature"><i class="bi bi-rulers"></i>
                                    LT: {{ number_format($property->luas_tanah) }} m<sup>2</sup></span>
                            </div>
                            <p>{{ Str::limit($property->description, 120) }}</p>
                            <div class="property-footer-horizontal">
                                <div class="property-price-horizontal">Rp
                                    {{ number_format($property->harga, 0, ',', '.') }}</div>
                                <a href="{{ route('property.show', $property->id) }}"
                                    class="btn-view-horizontal">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="featured-properties" class="featured-properties section propertiDisewakan">
    <div class="container section-title" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <h2>Properti Disewakan</h2>
            </div>
        </div>

        <p class="text-left">Temukan pilihan properti disewakan yang siap huni dan sesuai kebutuhan Anda.
            Kami hadirkan properti dengan fasilitas unggulan dan lokasi strategis untuk menunjang gaya hidup modern
            Anda.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
            @foreach ($rentProperties as $property)
                <div class="col-lg-4">
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
                                    </a>
                                </h4>
                                <div class="sidebar-location">
                                    <i class="bi bi-pin-map"></i>
                                    <span>{{ $property->alamat_lengkap }}, {{ $property->kabupaten }},
                                        {{ $property->provinsi }}</span>
                                </div>
                                <div class="sidebar-specs">
                                    <span><i class="bi bi-house"></i> KT: {{ $property->jumlah_kamat_tidur }}
                                        BR</span>
                                    <span><i class="bi bi-droplet"></i> KM: {{ $property->jumlah_kamar_mandi }}
                                        BA</span>
                                    <span><i class="bi bi-rulers"></i>
                                        LB: {{ number_format($property->luas_bangunan ?? 0) }}
                                        M<sup>2</sup></span>
                                    <span><i class="bi bi-rulers"></i>
                                        LT: {{ number_format($property->luas_tanah ?? 0) }}
                                        M<sup>2</sup></span>
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
    </div>
</section>

<section id="featured-properties" class="featured-properties section propertiDijual">
    <div class="container section-title" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <h2>Properti Dijual</h2>
            </div>
        </div>
        <p class="text-left">Temukan pilihan properti dijual yang siap huni dan sesuai kebutuhan Anda.
            Kami hadirkan properti dengan fasilitas unggulan dan lokasi strategis untuk menunjang gaya hidup modern
            Anda.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
            @foreach ($sellProperties as $property)
                <div class="col-lg-4">
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
                                    </a>
                                </h4>
                                <div class="sidebar-location">
                                    <i class="bi bi-pin-map"></i>
                                    <span>{{ $property->alamat_lengkap }}, {{ $property->kabupaten }},
                                        {{ $property->provinsi }}</span>
                                </div>
                                <div class="sidebar-specs">
                                    <span><i class="bi bi-house"></i> KT: {{ $property->jumlah_kamat_tidur }}
                                        BR</span>
                                    <span><i class="bi bi-droplet"></i> KM: {{ $property->jumlah_kamar_mandi }}
                                        BA</span>
                                    <span><i class="bi bi-rulers"></i>
                                        LB: {{ number_format($property->luas_bangunan ?? 0) }}
                                        M<sup>2</sup></span>
                                    <span><i class="bi bi-rulers"></i>
                                        LT: {{ number_format($property->luas_tanah ?? 0) }}
                                        M<sup>2</sup></span>
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
    </div>
</section>

<section id="testimonials" class="testimonials section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni</h2>
        <p>Pendapat dan pengalaman nyata dari klien kami yang telah menemukan properti impian mereka bersama kami.
            Kepercayaan mereka adalah bukti kualitas layanan kami yang profesional, aman, dan memuaskan.</p>
    </div>
    <div class="container">
        <div class="testimonial-grid">
            <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="100">
                <div class="testimonial-card">
                    <div class="testimonial-body">
                        <i class="bi bi-chat-quote-fill quote-icon"></i>
                        <p>“Saya sangat terbantu dengan layanan profesional tim ini. Dalam waktu singkat, saya berhasil
                            menemukan rumah impian saya di lokasi yang strategis.”</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-item featured" data-aos="zoom-in" data-aos-delay="200">
                <div class="testimonial-card">
                    <div class="testimonial-body">
                        <i class="bi bi-chat-quote-fill quote-icon"></i>
                        <p>“Proses pembelian berjalan mulus dan transparan. Saya merasa aman dan nyaman selama seluruh
                            prosesnya. Sangat direkomendasikan!”</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="300">
                <div class="testimonial-card">
                    <div class="testimonial-body">
                        <i class="bi bi-chat-quote-fill quote-icon"></i>
                        <p>“Agen sangat responsif dan informatif. Mereka memberikan banyak opsi properti sesuai
                            kebutuhan saya. Pelayanan terbaik yang pernah saya dapatkan.”</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="400">
                <div class="testimonial-card">
                    <div class="testimonial-body">
                        <i class="bi bi-chat-quote-fill quote-icon"></i>
                        <p>“Berbagai pilihan properti yang ditawarkan sangat lengkap dan terpercaya. Terima kasih telah
                            membantu saya berinvestasi dengan tepat.”</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
