@extends('frontend.layouts.app')
@section('content')
@section('title', $title)

<style>
    .search-wrapper {
        background: #fff;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .field-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
        display: block;
    }
    .search-field .form-control, .search-field .form-select {
        border-radius: 8px;
        padding: 0.75rem;
        border: 1px solid #eee;
    }
    .properties .search-bar .search-wrapper .search-field .search-btn {
        background: linear-gradient(135deg, var(--accent-color), color-mix(in srgb, var(--accent-color), #0066cc 20%));
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-weight: 600;
        font-size: 14px;
        color: var(--contrast-color);
        transition: all 0.3s ease;
    }
</style>

<section id="sewa-properties" class="properties section mt-5">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('sewa.index') }}" method="GET">
            <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
                <div class="search-wrapper">
                    <div class="row g-3">
                        {{-- Lokasi --}}
                        <div class="col-lg-3 col-md-6">
                            <div class="search-field">
                                <label class="field-label">Lokasi</label>
                                <select name="lokasi" class="form-select">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($kecamatanList as $city)
                                        <option value="{{ $city->kode }}"
                                            {{ request('lokasi') == $city->kode ? 'selected' : '' }}>
                                            {{ $city->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Tipe Properti --}}
                        <div class="col-lg-2 col-md-6">
                            <div class="search-field">
                                <label class="field-label">Jenis Properti</label>
                                <select name="tipe" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach ($TipeSewa as $type)
                                        <option value="{{ $type->slug }}"
                                            {{ request('tipe') == $type->slug ? 'selected' : '' }}>
                                            {{ $type->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Check-in --}}
                        <div class="col-lg-2 col-md-6">
                            <div class="search-field">
                                <label class="field-label">Check-in</label>
                                <input type="date" name="checkin" class="form-control" value="{{ request('checkin') }}">
                            </div>
                        </div>

                        {{-- Check-out --}}
                        <div class="col-lg-2 col-md-6">
                            <div class="search-field">
                                <label class="field-label">Check-out</label>
                                <input type="date" name="checkout" class="form-control" value="{{ request('checkout') }}">
                            </div>
                        </div>

                        {{-- Guest & Room --}}
                        <div class="col-lg-3 col-md-6">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="search-field">
                                        <label class="field-label">Tamu</label>
                                        <select name="guests" class="form-select">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>{{ $i }} Orang</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="search-field">
                                        <label class="field-label">Kamar</label>
                                        <select name="rooms" class="form-select">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ request('rooms') == $i ? 'selected' : '' }}>{{ $i }} Kamar</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Button Cari --}}
                        <div class="col-12 mt-4">
                            <div class="search-field">
                                <button type="submit" class="search-btn">
                                    <i class="bi bi-search me-2"></i> Cari Properti
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="results-info">
                        <h5>{{ $totalResults }} Properti Ditemukan</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="properties-container">
            <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
                <div class="row g-4">
                    @forelse ($properties as $property)
                        <div class="col-lg-4 col-md-6">
                            <div class="property-item">
                                <a href="{{ route('sewa.show', $property->slug) }}" class="property-link">
                                    <div class="property-image-wrapper">
                                        @php
                                            $imageUrl = null;
                                            if ($property->gbr_primary_properti) {
                                                $imageUrl = asset('storage/' . $property->gbr_primary_properti);
                                            } elseif ($property->images->isNotEmpty()) {
                                                $imageUrl = asset('storage/' . $property->images->first()->path);
                                            } else {
                                                $imageUrl = asset('themes/frontend/assets/img/default.png');
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $property->judul }}" class="img-fluid">
                                        <div class="property-status">
                                            <span class="status-badge sale">{{ $property->penawaran }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="property-details">
                                    <a href="{{ route('sewa.show', $property->slug) }}" class="property-link">
                                        <h4 class="property-title">{{ $property->judul }}</h4>
                                        <div class="property-header">
                                            <span class="property-price">Rp {{ number_format($property->harga, 0, ',', '.') }}</span>
                                            <div class="property-type">{{ $property->jenisProperti->nama ?? '-' }}</div>
                                        </div>
                                        @if($property->tersedia_dari)
                                            <div class="mb-2 text-success small">
                                                <i class="bi bi-calendar-check me-1"></i> 
                                                Tersedia: {{ \Carbon\Carbon::parse($property->tersedia_dari)->translatedFormat('d M Y') }}
                                            </div>
                                        @endif
                                        <div class="property-specs">
                                            <div class="spec-item"><i class="bi bi-door-open"></i> <span>{{ $property->jumlah_kamar }} Room</span></div>
                                            <div class="spec-item"><i class="bi bi-people"></i> <span>Max {{ $property->kapasitas_tamu }} Orang</span></div>
                                            <div class="spec-item"><i class="bi bi-arrows-angle-expand"></i> <span>{{ $property->luas_tanah }} m²</span></div>
                                        </div>
                                    </a>
                                    
                                    @php $carouselId = 'carouselProperty' . $property->id; @endphp
                                    <div id="{{ $carouselId }}" class="carousel slide" data-bs-interval="false">
                                        <div class="carousel-inner">
                                            @foreach ($property->agens as $i => $agen)
                                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                    <div class="property-agent-info d-flex justify-content-between align-items-center">
                                                        <div class="agent-avatar-info d-flex align-items-center">
                                                            <div class="agent-avatar">
                                                                @if ($agen->pas_foto)
                                                                    <img src="{{ asset('storage/' . $agen->pas_foto) }}" alt="{{ $agen->nama_lengkap }}">
                                                                @else
                                                                    <i class="bi bi-person-circle fs-3 text-secondary"></i>
                                                                @endif
                                                            </div>
                                                            <div class="agent-details ms-2">
                                                                <strong class="d-block">{{ $agen->nama_lengkap }}</strong>
                                                                <small class="text-muted">{{ $agen->no_hp }}</small>
                                                            </div>
                                                        </div>
                                                        <div class="agent-contact">
                                                            <a href="https://wa.me/{{ $agen->no_hp }}?text={{ urlencode('Halo, saya tertarik dengan properti ini: ' . $property->judul) }}" class="contact-btn text-success" target="_blank">
                                                                <i class="bi bi-whatsapp fs-4"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="empty-results">
                                <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                                <h3>Properti tidak ditemukan</h3>
                                <p class="text-muted">Coba ubah filter pencarian Anda</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
            {{ $properties->links() }}
        </nav>
    </div>
</section>

@endsection
