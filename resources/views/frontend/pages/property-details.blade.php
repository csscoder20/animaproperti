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
                                    <li><a href="{{ '/properti' }}">Properti</a></li>
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
                            <i class="bi bi-house-door me-2"></i>
                            <strong>KT:</strong> {{ $property->jumlah_kamar_tidur ?? '-' }}
                            <i class="bi bi-droplet me-2"></i>
                            <strong>KM:</strong> {{ $property->jumlah_kamar_mandi ?? '-' }}
                            <i class="bi bi-aspect-ratio me-2"></i>
                            <strong>LB:</strong> {{ $property->luas_bangunan ?? '-' }} m<sup>2</sup>
                            <i class="bi bi-bounding-box me-2"></i>
                            <strong>LT:</strong> {{ $property->luas_tanah ?? '-' }} m<sup>2</sup>
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
                                        <i class="bi bi-arrow-left-circle-fill fs-5 text-success"></i>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#agentCarousel"
                                        data-bs-slide="next">
                                        <i class="bi bi-arrow-right-circle-fill fs-5 text-success"></i>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="calculator-card mb-4" data-aos="fade-up" data-aos-delay="550">
                            <h4 class="fw-bold">Simulasi Kredit</h4>
                            <hr>
                            <div class="calculator-content">
                                <div class="cost-item">
                                    <span class="cost-label">Harga Properti</span>
                                    <span class="cost-value">Rp {{ number_format($property->harga, 0, ',', '.') }}</span>
                                </div>
                                <div class="cost-item">
                                    <label for="uangMuka" class="form-label">Uang Muka: <span
                                            id="uangMukaVal">20%</span></label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="range" class="form-range" id="uangMuka" min="0"
                                            max="50" step="1" value="20">
                                        <input type="number" class="form-control" id="uangMukaInput" min="0"
                                            max="50" step="1" value="20" style="width:80px;">
                                    </div>
                                </div>

                                <div class="text-warning mt-1 text-small" id="infoKurang" style="display: none;">
                                    Uang muka di bawah 20% akan memerlukan syarat tertentu dari pihak bank.
                                </div>
                                <div class="text-success mt-1 text-small" id="infoCukup" style="display: none;">
                                    Persentase uang muka 20% adalah jumlah minimum yang disarankan.
                                </div>

                                <div class="cost-item">
                                    <label for="masaKredit" class="form-label">Masa Kredit: <span id="masaKreditVal">15
                                            tahun</span></label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="range" class="form-range" id="masaKredit" min="3"
                                            max="30" step="1" value="15">
                                        <input type="number" class="form-control" id="masaKreditInput" min="3"
                                            max="30" step="1" value="15" style="width:80px;">
                                    </div>
                                </div>

                                <div class="cost-item">
                                    <label for="sukuBunga" class="form-label">Suku Bunga: <span
                                            id="sukuBungaVal">10%</span></label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="range" class="form-range" id="sukuBunga" min="1"
                                            max="20" step="0.1" value="10">
                                        <input type="number" class="form-control" id="sukuBungaInput" min="1"
                                            max="20" step="0.1" value="10" style="width:80px;">
                                    </div>
                                </div>

                                <div class="total-cost mt-3">
                                    <span class="total-label">Estimasi Cicilan Bulanan</span>
                                    <span class="total-value" id="hasilSimulasi">Rp 0/bulan</span>
                                </div>
                                <div class="small mt-2">
                                    *Hasil perhitungan di atas merupakan estimasi dan dapat berbeda dengan perhitungan bank.
                                </div>
                            </div>
                        </div>

                        <div class="similar-properties calculator-card" data-aos="fade-up" data-aos-delay="650">
                            <h4>Properti Rekomendasi</h4>
                            <hr>
                            @foreach ($recommendedProperties as $item)
                                <div class="similar-property-item mb-3 d-flex">
                                    <img src="{{ $item->primary_image_url }}" class="img-fluid me-3"
                                        style="width: 120px; height: auto;" alt="{{ $item->judul }}">
                                    <div class="similar-info">
                                        <h6>{{ $item->judul }}</h6>
                                        <p class="similar-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        <p class="similar-specs">
                                            • {{ $item->jumlah_kamar_tidur ?? 0 }} KT
                                            • {{ $item->jumlah_kamar_mandi ?? 0 }} KM
                                            • LB {{ $item->luas_bangunan ?? '-' }} m<sup>2</sup>
                                            • LT {{ $item->luas_tanah ?? '-' }} m<sup>2</sup>
                                        </p>
                                        <a href="{{ route('property.show', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary mt-1 detailProperty">Lihat Detail</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="location-section mt-5" data-aos="fade-up" data-aos-delay="700">
            </div>
        </div>

    </section>

    <script>
        const propertyPrice = {{ $property->harga }};
        const uangMuka = document.getElementById('uangMuka');
        const uangMukaInput = document.getElementById('uangMukaInput');
        const uangMukaVal = document.getElementById('uangMukaVal');
        const infoKurang = document.getElementById('infoKurang');
        const infoCukup = document.getElementById('infoCukup');
        const masaKredit = document.getElementById('masaKredit');
        const masaKreditInput = document.getElementById('masaKreditInput');
        const masaKreditVal = document.getElementById('masaKreditVal');
        const sukuBunga = document.getElementById('sukuBunga');
        const sukuBungaInput = document.getElementById('sukuBungaInput');
        const sukuBungaVal = document.getElementById('sukuBungaVal');
        const hasilSimulasi = document.getElementById('hasilSimulasi');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        function hitungSimulasi() {
            const dp = parseFloat(uangMuka.value);
            const tahun = parseInt(masaKredit.value);
            const bunga = parseFloat(sukuBunga.value);

            // Update label
            uangMukaVal.textContent = dp + '%';
            masaKreditVal.textContent = tahun + ' tahun';
            sukuBungaVal.textContent = bunga + '%';

            // Tampilkan info dp
            if (dp < 20) {
                infoKurang.style.display = 'block';
                infoCukup.style.display = 'none';
            } else {
                infoKurang.style.display = 'none';
                infoCukup.style.display = 'block';
            }

            // Hitung cicilan
            const uangMukaNominal = (dp / 100) * propertyPrice;
            const pinjaman = propertyPrice - uangMukaNominal;
            const r = (bunga / 100) / 12;
            const n = tahun * 12;

            const cicilan = (pinjaman * r * Math.pow(1 + r, n)) / (Math.pow(1 + r, n) - 1);
            hasilSimulasi.textContent = formatRupiah(cicilan) + '/bulan';
        }

        // Sync slider <-> input number
        function syncInputs(slider, input) {
            slider.addEventListener('input', () => {
                input.value = slider.value;
                hitungSimulasi();
            });
            input.addEventListener('input', () => {
                slider.value = input.value;
                hitungSimulasi();
            });
        }

        syncInputs(uangMuka, uangMukaInput);
        syncInputs(masaKredit, masaKreditInput);
        syncInputs(sukuBunga, sukuBungaInput);

        // Inisialisasi awal
        hitungSimulasi();
    </script>

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
