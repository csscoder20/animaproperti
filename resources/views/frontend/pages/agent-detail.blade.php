@extends('frontend.layouts.app')
@section('content')
@section('title', $title)
<section id="agent-profile" class="agent-profile section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center mb-5">
            <div class="col-lg-4" data-aos="fade-right" data-aos-delay="150">
                <div class="agent-photo-wrapper">
                    <img src="{{ $agen->pas_foto ? asset('storage/' . $agen->pas_foto) : asset('themes/frontend/assets/img/default.png') }}"
                        alt="{{ $agen->nama_lengkap }}" class="img-fluid agent-photo">
                    <div class="agent-badge">
                        <i class="bi bi-star-fill"></i>
                        <span>Top {{ $settings['agent_title'] ?? '' }} </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
                <div class="agent-info mt-4">
                    <h1 class="agent-name">{{ $agen->nama_lengkap }}</h1>
                    <p class="agent-title">{{ $agen->company_name ?? 'Agen Properti' }}</p>
                    <p class="agent-tagline">
                        "{{ $agen->deskripsi ?? 'Kami siap membantu Anda menemukan properti terbaik.' }}"</p>

                    <div class="contact-info-hero">
                        <div class="contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>{{ $agen->no_hp }}</span>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span>{{ $agen->email }}</span>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>{{ $agen->kabupaten }}</span>
                        </div>
                    </div>

                    <div class="hero-actions">
                        @if ($agen->propertis_count > 0)
                            <a href="{{ route('properties.index', ['agen_id' => $agen->id]) }}" class="btn btn-outline">
                                Lihat Properti
                            </a>
                        @endif

                        <a href="https://wa.me/{{ $settings->phone ?? '628114617733' }}?text={{ urlencode('Halo, saya tertarik dengan properti Anda, apakah masih tersedia?') }}"
                            class="btn btn-primary" target="_blank">Kontak Sekarang</a>

                        @if ($agen->kartu_nama)
                            <a href="{{ asset('storage/' . $agen->kartu_nama) }}" download class="btn btn-outline">
                                Unduh Kartu Nama
                            </a>
                        @else
                            <a href="#" onclick="alert('Kartu nama belum tersedia.')"
                                class="btn btn-outline disabled">
                                Kartu Nama Tidak Tersedia
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="150">
                <div class="stats-section" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="mb-5 text-center">Kategori Properti</h4>
                    <div class="row text-center">
                        @forelse ($kategoriProperti as $kategori)
                            @php
                                $nama = strtolower($kategori['nama']);
                                $jumlah = $kategori['jumlah'];

                                $icons = [
                                    'rumah' => 'bi-house-door',
                                    'perumahan' => 'bi-houses',
                                    'cluster' => 'bi-building',
                                    'apartemen' => 'bi-building-check',
                                    'tanah' => 'bi-globe-americas',
                                    'ruko' => 'bi-shop',
                                    'villa' => 'bi-tree',
                                    'kost' => 'bi-person-lines-fill',
                                    'gudang' => 'bi-box-seam',
                                    'kantor' => 'bi-briefcase',
                                ];

                                $iconClass = $icons[$nama] ?? 'bi-building';
                            @endphp
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="stat-item">
                                    <div class="stat-icon mb-2">
                                        <i class="bi {{ $iconClass }} fs-2"></i>
                                    </div>
                                    <div class="stat-number">{{ $jumlah }}</div>
                                    <div class="stat-label">{{ $kategori['nama'] }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center text-muted">Belum ada data kategori properti.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
