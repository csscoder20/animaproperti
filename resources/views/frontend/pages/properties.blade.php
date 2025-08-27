@extends('frontend.layouts.app')
@section('content')
@section('title', $title)

<section id="properties" class="properties section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('properties.index') }}" method="GET">
            <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="search-wrapper">
                            <div class="row g-3">
                                {{-- Lokasi --}}
                                <div class="col-lg-3 col-md-6">
                                    <div class="search-field">
                                        <label for="search-location" class="field-label">Kota</label>
                                        <select id="search-location" name="lokasi" class="form-select">
                                            <option value="">Semua Kota</option>
                                            @foreach ($kecamatanList as $city)
                                                <option value="{{ $city->kode }}"
                                                    {{ request('lokasi') == $city->kode ? 'selected' : '' }}>
                                                    {{ $city->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Tipe --}}
                                <div class="col-lg-2 col-md-6">
                                    <div class="search-field">
                                        <label>Tipe</label>
                                        <select name="tipe" class="form-select">
                                            <option value="">Semua</option>
                                            @foreach ($Tipepropertis as $type)
                                                <option value="{{ $type->slug }}"
                                                    {{ request('tipe') == $type->slug ? 'selected' : '' }}>
                                                    {{ $type->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Harga --}}
                                <div class="col-lg-2 col-md-6">
                                    <div class="search-field">
                                        <label>Harga</label>
                                        <select name="harga" class="form-select">
                                            <option value="">Semua</option>
                                            <option value="<100" {{ request('harga') == '<100' ? 'selected' : '' }}>
                                                &lt; 100 Juta</option>
                                            <option value="100-500"
                                                {{ request('harga') == '100-500' ? 'selected' : '' }}>100 Juta - 500
                                                Juta</option>
                                            <option value="500-1000"
                                                {{ request('harga') == '500-1000' ? 'selected' : '' }}>500 Juta - 1 M
                                            </option>
                                            <option value=">1000" {{ request('harga') == '>1000' ? 'selected' : '' }}>
                                                &gt; 1 M</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kamar --}}
                                <div class="col-lg-3 col-md-6">
                                    <div class="search-field">
                                        <label>Kamar</label>
                                        <div class="bedroom-quick">
                                            <button type="button"
                                                class="bed-btn {{ request('kamar') == 'any' || !request('kamar') ? 'active' : '' }}"
                                                data-beds="any">Semua</button>
                                            <button type="button"
                                                class="bed-btn {{ request('kamar') == '1' ? 'active' : '' }}"
                                                data-beds="1">1</button>
                                            <button type="button"
                                                class="bed-btn {{ request('kamar') == '2' ? 'active' : '' }}"
                                                data-beds="2">2</button>
                                            <button type="button"
                                                class="bed-btn {{ request('kamar') == '3' ? 'active' : '' }}"
                                                data-beds="3">3</button>
                                            <button type="button"
                                                class="bed-btn {{ request('kamar') == '4' ? 'active' : '' }}"
                                                data-beds="4">4+</button>
                                        </div>
                                        <input type="hidden" name="kamar" id="kamar-value"
                                            value="{{ request('kamar') ?? 'any' }}">
                                    </div>
                                </div>

                                {{-- Agen --}}
                                <div class="col-lg-2 col-md-6">
                                    <div class="search-field">
                                        <label>Agen</label>
                                        <select name="agen_id" class="form-select">
                                            <option value="">Semua Agen</option>
                                            @foreach ($agenList as $agen)
                                                <option value="{{ $agen->id }}"
                                                    {{ request('agen_id') == $agen->id ? 'selected' : '' }}>
                                                    {{ $agen->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Tombol Cari --}}
                                <div class="col-lg-2 col-md-12">
                                    <div class="search-field">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary w-100 search-btn">
                                            <i class="bi bi-search"></i> Cari
                                        </button>
                                    </div>
                                </div>
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
                        <h5>{{ $totalResults }} Properti</h5>
                        <p class="text-muted">
                            @php
                                $tipeNama = $selectedType
                                    ? \App\Models\JenisProperti::where('slug', $selectedType)->value('nama')
                                    : null;
                                $agenNama = $selectedAgen ? \App\Models\Agen::find($selectedAgen)?->nama_lengkap : null;
                            @endphp

                            @if ($tipeNama && $agenNama)
                                Menampilkan properti tipe <strong>{{ $tipeNama }}</strong> oleh
                                <strong>{{ $agenNama }}</strong>
                            @elseif ($tipeNama)
                                Menampilkan properti untuk tipe <strong>{{ $tipeNama }}</strong>
                            @elseif ($agenNama)
                                Menampilkan properti oleh <strong>{{ $agenNama }}</strong>
                            @else
                                Menampilkan semua properti di berbagai daerah
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="properties-container">
            <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
                <div class="row g-4">
                    @foreach ($properties as $property)
                        <div class="col-lg-4 col-md-6">
                            <div class="property-item">
                                <a href="{{ route('property.show', $property) }}" class="property-link">
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
                                            @if ($property->featured == 1)
                                                <span class="status-badge featured">Unggulan</span>
                                            @endif

                                            <span class="status-badge sale">
                                                {{ $property->penawaran }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="property-details"><a href="{{ route('property.show', $property) }}"
                                        class="property-link">
                                        <h4 class="property-title">{{ $property->judul }}</h4>
                                        <div class="property-header">
                                            <span class="property-price">Rp
                                                {{ number_format($property->harga, 0, ',', '.') }}</span>
                                            <div class="property-type">
                                                {{ $property->jenisProperti->nama ?? '-' }}</div>
                                        </div>
                                        <p class="property-address">
                                            {{ $property->penawaran }} di {{ $property->alamat_lengkap }} sebuah
                                            {{ $property->jenisProperti->nama ?? '-' }}
                                        </p>
                                        <div class="property-specs">
                                            @if ($property->jenisProperti->nama == 'Tanah')
                                                <div class="spec-item">
                                                    <i class="bi bi-arrows-angle-expand"></i>
                                                    <span>LT: {{ $property->luas_tanah }} m²</span>
                                                </div>
                                            @else
                                                <div class="spec-item">
                                                    <i class="bi bi-house-door"></i>
                                                    <span>{{ $property->jumlah_kamar_tidur }} KT</span>
                                                </div>
                                                <div class="spec-item">
                                                    <i class="bi bi-droplet"></i>
                                                    <span>{{ $property->jumlah_kamar_mandi }} KM</span>
                                                </div>
                                                <div class="spec-item">
                                                    <i class="bi bi-arrows-angle-expand"></i>
                                                    <span>LT: {{ $property->luas_tanah }} m²</span>
                                                </div>
                                                <div class="spec-item">
                                                    <i class="bi bi-arrows-angle-expand"></i>
                                                    <span>LB: {{ $property->luas_bangunan }} m²</span>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                    @php
                                        $carouselId = 'carouselProperty' . $property->id;
                                    @endphp

                                    <div id="{{ $carouselId }}" class="carousel slide" data-bs-interval="false">
                                        <div class="carousel-inner">
                                            @foreach ($property->agens as $i => $agen)
                                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                    <div
                                                        class="property-agent-info d-flex {{ $property->agens->count() > 1 ? 'justify-content-center' : 'justify-content-between' }}">
                                                        <a class="property-link d-flex justify-content-between">
                                                            <div
                                                                class="agent-avatar d-flex justify-content-between align-items-center">
                                                                @if ($agen->pas_foto)
                                                                    <img src="{{ asset('storage/' . $agen->pas_foto) }}"
                                                                        alt="{{ $agen->nama_lengkap }}">
                                                                @else
                                                                    <i
                                                                        class="bi bi-person-circle fs-3 text-secondary"></i>
                                                                @endif
                                                            </div>
                                                            <div class="agent-details px-2">
                                                                <strong>{{ $agen->nama_lengkap ?? 'Nama Agen Tidak Tersedia' }}</strong>
                                                                <span>{{ $agen->no_hp ?? 'No. WA tidak tersedia' }}</span><br>
                                                            </div>
                                                        </a>
                                                        <div class="agent-contact">
                                                            <a href="https://wa.me/{{ $agen->no_hp ?? '628114617733' }}?text={{ urlencode('Halo, saya tertarik dengan properti ini: ' . $property->judul . '. Apakah masih tersedia?') }}"
                                                                class="contact-btn" target="_blank">
                                                                <i class="bi bi-whatsapp"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($property->agens->count() > 1)
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
            <div class="row justify-content-between align-items-center">
                {{ $properties->links() }}
            </div>
        </nav>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const bedButtons = document.querySelectorAll(".bed-btn");
        const kamarInput = document.getElementById("kamar-value");

        bedButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                bedButtons.forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                kamarInput.value = this.dataset.beds;
            });
        });
    });
</script>

@endsection
