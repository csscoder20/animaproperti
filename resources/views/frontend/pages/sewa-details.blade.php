@extends('frontend.layouts.app')
@section('title', $title)

@push('styles')
<style>
.pricing-section {
  background: linear-gradient( 135deg, var(--accent-color), color-mix(in srgb, var(--accent-color), #6a11cb 30%) );
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
.property-gallery-slider .swiper-pagination-bullets {
    bottom: 0 !important;
}

/* Room Type Selection Styles */
.tipekamar-card-item {
    transition: all 0.3s ease;
    border-radius: 12px;
}
.tipekamar-card-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.tipekamar-card-item.selected {
    border-color: #198754 !important;
    background-color: #f8fffb;
}
.room-thumb-container {
    position: relative;
    width: 200px;
    height: 150px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
}
.room-zoom-icon {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(255,255,255,0.8);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    font-size: 1rem;
    z-index: 2;
}
.room-specs-icon {
    width: 24px;
    text-align: center;
    color: #888;
    margin-right: 8px;
}
.tipekamar-select-btn {
    min-width: 100px;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.tipekamar-select-btn.selected {
    background-color: #198754 !important;
    border-color: #198754 !important;
    color: #fff !important;
}
</style>
@endpush

@section('content')
    <section id="property-details" class="property-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
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
                <div class="col-lg-7">                
                    @php
                        $checkin = \Carbon\Carbon::parse(request('checkin', now()->format('Y-m-d\TH:i')));
                        $checkout = \Carbon\Carbon::parse(request('checkout', now()->addDay()->format('Y-m-d\TH:i')));
                        $rooms = (int) request('rooms', 1);
                        $guests = (int) request('guests', 1);
                        $duration = $checkin->diffInDays($checkout) ?: 1; // Minimum 1 day
                        $pricePerNight = $property->harga_sewa_per_malam ?? $property->harga;
                        $totalPrice = $rooms * $pricePerNight * $duration;
                    @endphp

                    <div class="booking-form-container mb-5" data-aos="fade-up" data-aos-delay="400">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white p-4 border-bottom">
                                <h4 class="mb-0 fw-bold"><i class="bi bi-journal-check me-2 text-primary"></i> Lengkapi Data Pemesanan</h4>
                            </div>
                            <div class="card-body p-4">
                                <form id="bookingConfirmForm" action="{{ route('sewa.booking.summary', $property->slug) }}" method="POST">
                                    @csrf
                                    {{-- Hidden Inputs --}}
                                    @if(request()->filled('checkin'))
                                        {{-- Hidden Inputs when coming from search --}}
                                        <input type="hidden" name="checkin" value="{{ $checkin->format('Y-m-d\TH:i') }}">
                                        <input type="hidden" name="checkout" value="{{ $checkout->format('Y-m-d\TH:i') }}">
                                        <input type="hidden" name="rooms" value="{{ $rooms }}">
                                        <input type="hidden" name="guests" value="{{ $guests }}">
                                        <input type="hidden" name="duration" value="{{ $duration }}">
                                    @else
                                        {{-- Visible Inputs when direct booking --}}
                                        <h5 class="fw-bold border-bottom pb-2 mb-3">Detail Pesanan</h5>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold small">Tanggal Sewa</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3 text-primary"></i></span>
                                                    <input type="text" id="details-datepicker" class="form-control border-start-0" placeholder="Pilih Tanggal Check-in - Check-out" readonly style="background-color: #fff; cursor: pointer;">
                                                </div>
                                                <input type="hidden" name="checkin" id="input-checkin" value="{{ now()->format('Y-m-d') }}">
                                                <input type="hidden" name="checkout" id="input-checkout" value="{{ now()->addDay()->format('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold small">Tamu & Kamar</label>
                                                <div class="dropdown">
                                                    <input type="text" id="detailsGuestRoomDisplay" class="form-control"
                                                        placeholder="1 Dewasa, 0 Anak, 1 Kamar" readonly data-bs-toggle="dropdown"
                                                        aria-expanded="false" style="background-color: #fff; cursor: pointer;">
                                                    <ul class="dropdown-menu p-3 border-0 shadow" aria-labelledby="detailsGuestRoomDisplay"
                                                        style="width: 100%; min-width: 300px; border-radius: 12px; margin-top: 10px;">
                                                        
                                                        {{-- Adult --}}
                                                        <li class="d-flex justify-content-between align-items-center mb-3">
                                                            <div>
                                                                <h6 class="mb-0 fw-bold">Dewasa</h6>
                                                                <small class="text-muted">Usia 13+</small>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-secondary rounded-circle"
                                                                    onclick="updateCounter('adult', -1)"
                                                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">-</button>
                                                                <span id="detailsAdultCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">1</span>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-primary rounded-circle"
                                                                    onclick="updateCounter('adult', 1)"
                                                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">+</button>
                                                            </div>
                                                        </li>
        
                                                        {{-- Children --}}
                                                        <li class="d-flex justify-content-between align-items-center mb-3">
                                                            <div>
                                                                <h6 class="mb-0 fw-bold">Anak</h6>
                                                                <small class="text-muted">Usia 0-12</small>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-secondary rounded-circle"
                                                                    onclick="updateCounter('child', -1)"
                                                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">-</button>
                                                                <span id="detailsChildCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">0</span>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-primary rounded-circle"
                                                                    onclick="updateCounter('child', 1)"
                                                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">+</button>
                                                            </div>
                                                        </li>
        
                                                        {{-- Result Children Age Section --}}
                                                        <li id="childrenAgeSection" class="mb-3" style="display: none;">
                                                            <div class="p-0">
                                                                <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">Masukkan Umur Anak</h6>
                                                                <small class="text-muted d-block mb-3" style="font-size: 0.8rem; line-height: 1.2;">
                                                                    Mengetahui umur anak akan membantu kami menemukan properti yang cocok
                                                                </small>
                                                                <div id="childrenAgeInputs" class="row g-2">
                                                                    {{-- Dynamic inputs will appear here --}}
                                                                </div>
                                                            </div>
                                                        </li>
        
                                                        {{-- Room --}}
                                                        <li class="d-flex justify-content-between align-items-center mb-4">
                                                            <div>
                                                                <h6 class="mb-0 fw-bold">Kamar</h6>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-secondary rounded-circle"
                                                                    onclick="updateCounter('room', -1)"
                                                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">-</button>
                                                                <span id="detailsRoomCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">1</span>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-primary rounded-circle"
                                                                    onclick="updateCounter('room', 1)"
                                                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">+</button>
                                                            </div>
                                                        </li>
        
                                                        {{-- Done Button --}}
                                                        <li>
                                                            <button type="button" class="btn btn-primary w-100 rounded-pill" onclick="document.getElementById('detailsGuestRoomDisplay').click()">Selesai</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            {{-- Hidden Inputs for Form --}}
                                            <input type="hidden" name="rooms" id="input-rooms" value="1">
                                            <input type="hidden" name="guests" id="input-guests" value="1">
                                            <input type="hidden" name="adults" id="input-adults" value="1">
                                            <input type="hidden" name="children" id="input-children" value="0">
                                            
                                            <input type="hidden" name="duration" id="input-duration" value="1">
                                        </div>
                                    @endif
                                    
                                    <input type="hidden" name="total_price" id="input-total-price" value="{{ $totalPrice }}">
                                    <input type="hidden" name="agent_name" id="agent_name">
                                    <input type="hidden" name="agent_phone" id="agent_phone">
                                    <input type="hidden" name="tipe_kamar_id" id="tipe_kamar_id">

                                    {{-- Data Kontak --}}
                                    <h5 class="fw-bold border-bottom pb-2 mb-3">Data Kontak Pemesan</h5>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="customer_name" required placeholder="Contoh: Budi Santoso">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">No. WhatsApp</label>
                                            <input type="tel" class="form-control" name="customer_phone" required placeholder="Contoh: 08123456789">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">NIK (Sesuai KTP)</label>
                                            <input type="text" class="form-control" name="nik" required placeholder="Masukkan 16 digit NIK">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">Alamat Email</label>
                                            <input type="email" class="form-control" name="email" required placeholder="Contoh: budi@email.com">
                                        </div>
                                    </div>

                                    @if($property->disewa_per_kamar && $property->tipeKamars->count() > 0)
                                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Pilih Tipe Kamar</h5>
                                        <div class="d-flex flex-column gap-3 mb-4">
                                            @foreach($property->tipeKamars as $tipe)
                                                @php
                                                    $imagePath = $tipe->gambar 
                                                        ? asset('storage/' . $tipe->gambar) 
                                                        : asset('themes/frontend/assets/img/default-room.jpg');
                                                @endphp
                                                <div class="card border tipekamar-card-item {{ $tipe->jumlah_kamar <= 0 ? 'bg-light text-muted' : '' }}" id="tipe-card-{{ $tipe->id }}" style="{{ $tipe->jumlah_kamar <= 0 ? 'opacity: 0.7;' : '' }}">
                                                    <div class="card-body p-3">
                                                        <div class="d-flex flex-column flex-md-row gap-3">
                                                            {{-- Room Image with Lightbox --}}
                                                            <div class="room-thumb-container">
                                                                <img src="{{ $imagePath }}" alt="{{ $tipe->nama }}" class="w-100 h-100 object-fit-cover">
                                                                <a href="{{ $imagePath }}" class="glightbox room-zoom-icon" data-gallery="room-gallery-{{ $tipe->id }}">
                                                                    <i class="bi bi-search"></i>
                                                                </a>
                                                            </div>

                                                            {{-- Room Details --}}
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                                    <h5 class="fw-bold mb-0 text-dark">{{ $tipe->nama }}</h5>
                                                                    <div class="text-end">
                                                                        <h5 class="fw-bold mb-0 {{ $tipe->jumlah_kamar > 0 ? 'text-success' : 'text-danger' }}">
                                                                            Rp {{ number_format($tipe->harga_per_malam, 0, ',', '.') }}
                                                                        </h5>
                                                                        @if($tipe->jumlah_kamar > 0)
                                                                            <small class="text-muted">Room Total</small>
                                                                        @else
                                                                            <span class="badge bg-danger">Habis Terpesan</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <p class="text-muted small mb-2"><i class="bi bi-building me-1"></i> Animaproperti · <a href="#" class="text-primary text-decoration-none small">More Info</a></p>
                                                                    
                                                                    <div class="row g-2">
                                                                        <div class="col-sm-6">
                                                                            <div class="d-flex align-items-center mb-1 small">
                                                                                <i class="bi bi-people room-specs-icon"></i>
                                                                                <span>Max {{ $tipe->kapasitas_dewasa }} Dewasa, {{ $tipe->kapasitas_anak }} Anak</span>
                                                                            </div>
                                                                            <div class="d-flex align-items-center small">
                                                                                <i class="bi bi-arrows-fullscreen room-specs-icon" style="font-size: 0.8rem;"></i>
                                                                                <span>{{ $tipe->luas_kamar ?? '-' }} m²</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="d-flex align-items-center small">
                                                                                <i class="bi bi-briefcase room-specs-icon"></i>
                                                                                <span>{{ $tipe->tipe_bed ?? '-' }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

 <div class="text-end">
                                                                    @if($tipe->jumlah_kamar > 0)
                                                                        <button type="button" 
                                                                            class="btn btn-outline-success tipekamar-select-btn" 
                                                                            id="btn-select-{{ $tipe->id }}" 
                                                                            onclick="selectTipeKamar(this, '{{ $tipe->id }}', {{ $tipe->harga_per_malam }}, '{{ $tipe->nama }}')">
                                                                            Select
                                                                        </button>
                                                                    @else
                                                                        <button type="button" 
                                                                            class="btn btn-secondary disabled" 
                                                                            id="btn-select-{{ $tipe->id }}" 
                                                                            disabled>
                                                                            Habis
                                                                        </button>
                                                                    @endif
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Metode Pembayaran --}}
                                    <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Metode Pembayaran</h5>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold small">Pilih Metode Pembayaran</label>
                                        <select class="form-select" name="payment_method" required>
                                            <option value="" selected disabled>-- Pilih Metode Pembayaran --</option>
                                            <option value="Transfer Bank (BCA)">Transfer Bank (BCA)</option>
                                            <option value="Transfer Bank (BRI)">Transfer Bank (BRI)</option>
                                            <option value="Transfer Bank (Mandiri)">Transfer Bank (Mandiri)</option>
                                            <option value="E-Wallet (OVO)">E-Wallet (OVO)</option>
                                            <option value="E-Wallet (GoPay)">E-Wallet (GoPay)</option>
                                            <option value="E-Wallet (Dana)">E-Wallet (Dana)</option>
                                            <option value="Bayar di Tempat (Cash)">Bayar di Tempat (Cash)</option>
                                        </select>
                                    </div>

                                    {{-- Pilih Agen --}}
                                    <h5 class="fw-bold border-bottom pb-2 mb-3">Pilih Agen</h5>
                                    <div class="mb-4">
                                        <div class="row g-3" style="max-height: 300px; overflow-y: auto;">
                                            @forelse($property->agens as $index => $agen)
                                                <div class="col-md-6">
                                                    <div id="agent-card-{{ $index }}" 
                                                         class="card border agent-card-item cursor-pointer h-100" 
                                                         data-phone="{{ $agen->no_hp }}"
                                                         data-name="{{ $agen->nama_lengkap }}"
                                                         onclick="selectAgent(this)"
                                                         style="cursor: pointer; transition: all 0.2s ease;">
                                                        <div class="card-body p-2 d-flex align-items-center">
                                                            <div class="avatar me-3" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #f0f0f0; flex-shrink: 0;">
                                                                @if($agen->pas_foto)
                                                                    <img src="{{ asset('storage/' . $agen->pas_foto) }}" alt="{{ $agen->nama_lengkap }}" class="w-100 h-100 object-fit-cover">
                                                                @else
                                                                    <i class="bi bi-person text-secondary d-flex justify-content-center align-items-center h-100 fs-5"></i>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <h6 class="fw-bold mb-0 small">{{ $agen->nama_lengkap }}</h6>
                                                                <p class="text-muted extra-small mb-0" style="font-size: 0.75rem;">Agen Properti</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <div class="alert alert-warning small">Belum ada agen tersedia.</div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success w-auto fw-bold btn-custom-accent " onclick="submitFinalBooking()">
                                        <i class="bi bi-whatsapp me-2"></i> Proses Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="sticky-sidebar">
                        <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="350">
                            <div class="card-body p-4">
                                <div class="swiper property-gallery-slider mb-4 rounded overflow-hidden">
                                    <div class="swiper-wrapper">
                                        @if($property->gbr_primary_properti)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $property->gbr_primary_properti) }}" alt="{{ $property->judul }}" class="w-100">
                                            </div>
                                        @endif
                                        @foreach($property->images as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $property->judul }}" class="w-100">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>

                                <div class="property-header mb-3">
                                    <h1 class="fw-bold fs-4 mb-2">{{ $property->judul ?? '-' }}</h1>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $alamatLengkap }}
                                    </p>
                                   
                                </div>

                                <hr>

                                <div class="facilities-section mt-3">
                                    <h5 class="fw-bold fs-6 mb-3">Fasilitas</h5>
                                    <div class="d-flex flex-wrap gap-2 mt-3 mb-4">
                                        @php
                                            $allFacilities = $property->fasilitas->merge($property->tipeKamars->pluck('fasilitas')->flatten())->unique('id');
                                        @endphp

                                        @if ($allFacilities->count() > 0)
                                            @foreach ($allFacilities as $fasilitas)
                                                <div class="d-flex align-items-center text-muted small me-2 mb-2">
                                                    <i class="bi {{ $fasilitas->icon ?? 'bi-check-circle' }} me-1 text-primary"></i>
                                                    <span>{{ $fasilitas->nama }}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-muted small fst-italic">Currently no facilities data available.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Booking Summary --}}
                        <div class="alert alert-light border mb-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i> Ringkasan Pesanan</h6>
                            <div class="row g-3 small">
                                <div class="col-md-6">
                                    <span class="text-muted d-block">Tanggal:</span>
                                        <span class="fw-bold" id="summary-dates">{{ $checkin->translatedFormat('d M Y') }} - {{ $checkout->translatedFormat('d M Y') }}</span>
                                        <span class="ms-1" id="summary-duration">({{ $duration }} Malam)</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-muted d-block">Unit:</span>
                                        <span class="fw-bold" id="summary-unit">{{ $rooms }} Kamar, {{ $guests }} Tamu</span>
                                        <small class="d-block text-primary fw-bold" id="summary-room-type"></small>
                                    </div>
                                    <div class="col-12 border-top pt-2 mt-2" id="total-price-section" @if($property->disewa_per_kamar) style="display: none;" @endif>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold">Total Biaya:</span>
                                            <span class="fw-bold text-primary fs-5" id="summary-total-price">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    @if($property->disewa_per_kamar)
                                    <div id="select-room-warning" class="col-12 border-top pt-2 mt-2 text-center">
                                        <small class="text-muted fst-italic">Silakan pilih tipe kamar untuk melihat total biaya</small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @php
                            $agens = $property->agens;
                        @endphp
                    </div>
                </div>
            </div>
            <div class="location-section mt-5" data-aos="fade-up" data-aos-delay="700">
            </div>
        </div>

    </section>



    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script>
        let basePrice = {{ $pricePerNight }};
        let currentRoomPrice = null;
        let selectedRoomName = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Check if details-datepicker exists (direct booking mode)
            const datepickerEl = document.getElementById('details-datepicker');
            if (datepickerEl) {
                const picker = new easepick.create({
                    element: datepickerEl,
                    css: [
                        'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
                    ],
                    plugins: ['RangePlugin', 'LockPlugin'],
                    RangePlugin: {
                        tooltipNumber(num) {
                            return num - 1;
                        },
                        locale: {
                            one: 'night',
                            other: 'nights',
                        },
                    },
                    LockPlugin: {
                        minDate: new Date(),
                    },
                    calendars: 1,
                    grid: 1,
                    zIndex: 10,
                    format: 'D MMM YYYY',
                    setup(picker) {
                        picker.on('select', (e) => {
                            const {
                                start,
                                end
                            } = e.detail;
                            document.getElementById('input-checkin').value = start ? start.format('YYYY-MM-DD') : '';
                            document.getElementById('input-checkout').value = end ? end.format('YYYY-MM-DD') : '';
                            
                            calculateBooking(); // Recalculate duration and price
                        });
                    },
                });

                // Pre-fill dates from hidden inputs
                const checkinVal = document.getElementById('input-checkin').value;
                const checkoutVal = document.getElementById('input-checkout').value;

                if (checkinVal && checkoutVal) {
                    const start = new Date(checkinVal);
                    const end = new Date(checkoutVal);
                    picker.setDateRange(start, end);
                }
            }

            var gallerySwiper = new Swiper('.property-gallery-slider', {
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            const lightbox = GLightbox({
                selector: '.glightbox'
            });

            // Initial calculation if inputs exist
            if(document.getElementById('input-checkin')) {
                updateDisplay(); // Initialize dropdown display and hidden inputs
                calculateBooking();
            }

            // Prevent dropdown from closing when clicking inside
            document.querySelectorAll('.dropdown-menu').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });

        // Guest & Room Counter Logic
        let counts = {
            adult: 1,
            child: 0,
            room: 1
        };

        function updateDisplay() {
            // Update UI Counters
            const adultCountEl = document.getElementById('detailsAdultCount');
            const childCountEl = document.getElementById('detailsChildCount');
            const roomCountEl = document.getElementById('detailsRoomCount');

            if(adultCountEl) adultCountEl.innerText = counts.adult;
            if(childCountEl) childCountEl.innerText = counts.child;
            if(roomCountEl) roomCountEl.innerText = counts.room;

            // Update Hidden Inputs
            const inputAdults = document.getElementById('input-adults');
            const inputChildren = document.getElementById('input-children');
            const inputRooms = document.getElementById('input-rooms');
            const inputGuests = document.getElementById('input-guests');

            if(inputAdults) inputAdults.value = counts.adult;
            if(inputChildren) inputChildren.value = counts.child;
            if(inputRooms) inputRooms.value = counts.room;
            if(inputGuests) inputGuests.value = counts.adult + counts.child;

            // Update Dropdown Button Text
            let displayText = `${counts.adult} Dewasa, ${counts.child} Anak, ${counts.room} Kamar`;
            const displayEl = document.getElementById('detailsGuestRoomDisplay');
            if(displayEl) displayEl.value = displayText;

            updateChildrenAgeInputs();
            calculateBooking(); // Recalculate price when counts change
        }

        function updateChildrenAgeInputs() {
            const container = document.getElementById('childrenAgeInputs');
            const section = document.getElementById('childrenAgeSection');
            
            if (!container || !section) return;

            if (counts.child > 0) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
                container.innerHTML = '';
                return;
            }

            const currentInputs = container.querySelectorAll('.child-age-group');
            const currentCount = currentInputs.length;
            const targetCount = counts.child;

            if (targetCount > currentCount) {
                // Add inputs
                for (let i = currentCount; i < targetCount; i++) {
                    const col = document.createElement('div');
                    col.className = 'col-6 child-age-group';
                    col.innerHTML = `
                        <label class="form-label small text-muted mb-1">Anak ${i + 1} (Bulan)</label>
                        <input type="number" name="child_ages[]" class="form-control form-control-sm" min="0" placeholder="Bulan" style="border-radius: 8px;" oninput="convertMonthToYear(this, ${i})">
                        <small id="age-conversion-${i}" class="text-primary" style="font-size: 0.75rem; display: block; margin-top: 2px;">0 Tahun</small>
                    `;
                    container.appendChild(col);
                }
            } else if (targetCount < currentCount) {
                // Remove inputs
                for (let i = currentCount - 1; i >= targetCount; i--) {
                    currentInputs[i].remove();
                }
            }
        }

        function updateCounter(type, change) {
            if (type === 'adult') {
                if (counts.adult + change >= 1) counts.adult += change; // Min 1 adult
            } else if (type === 'child') {
                if (counts.child + change >= 0) counts.child += change;
            } else if (type === 'room') {
                if (counts.room + change >= 1) counts.room += change; // Min 1 room
            }
            updateDisplay();
        }

        function convertMonthToYear(input, index) {
            const months = parseInt(input.value) || 0;
            const years = (months / 12).toFixed(1);
            const display = document.getElementById(`age-conversion-${index}`);
            if(display) display.innerText = `${years} Tahun`;
        }

        function getBookingState() {
            // Check if we have editable inputs
            const checkinInput = document.getElementById('input-checkin');
            const checkoutInput = document.getElementById('input-checkout');
            const roomsInput = document.getElementById('input-rooms');
            const guestsInput = document.getElementById('input-guests');

            if (checkinInput) {
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);
                
                // Calculate duration in days
                const oneDay = 24 * 60 * 60 * 1000;
                let duration = Math.round(Math.abs((checkout - checkin) / oneDay));
                if (isNaN(duration) || duration < 1) duration = 1;

                return {
                    rooms: parseInt(roomsInput.value) || 1,
                    guests: parseInt(guestsInput.value) || 1,
                    duration: duration,
                    checkinDate: checkin,
                    checkoutDate: checkout
                };
            } else {
                // Return fixed values from PHP if no inputs (search mode)
                return {
                    rooms: {{ $rooms }},
                    guests: {{ $guests }},
                    duration: {{ $duration }},
                    checkinDate: new Date('{{ $checkin }}'),
                    checkoutDate: new Date('{{ $checkout }}')
                };
            }
        }

        function calculateBooking() {
            const state = getBookingState();
            
            // Update hidden duration input if it exists
            const durationInput = document.getElementById('input-duration');
            if (durationInput) durationInput.value = state.duration;

            // Update Summary Text
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            // Ensure dates are valid before formatting
            if (!isNaN(state.checkinDate) && !isNaN(state.checkoutDate)) {
                 const dateText = `${state.checkinDate.toLocaleDateString('id-ID', options)} - ${state.checkoutDate.toLocaleDateString('id-ID', options)}`;
                 const summaryDates = document.getElementById('summary-dates');
                 if(summaryDates) summaryDates.innerText = dateText;
            }
           
            const summaryDuration = document.getElementById('summary-duration');
            if(summaryDuration) summaryDuration.innerText = `(${state.duration} Malam)`;
            
            const summaryUnit = document.getElementById('summary-unit');
            if(summaryUnit) summaryUnit.innerText = `${state.rooms} Kamar, ${state.guests} Tamu`;

            // Calculate Total Price
            // Use currentRoomPrice if set, otherwise basePrice
            const price = currentRoomPrice !== null ? currentRoomPrice : basePrice;
            const totalPrice = price * state.rooms * state.duration;

            // Update Price Display
            const summaryTotalPrice = document.getElementById('summary-total-price');
            if(summaryTotalPrice) summaryTotalPrice.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);

            // Update Hidden Total Price Input
            const inputTotalPrice = document.getElementById('input-total-price');
            if(inputTotalPrice) inputTotalPrice.value = totalPrice;
            
             // Also update the form total_price hidden input if it's different (it shouldn't be, IDs match)
             document.querySelector('input[name="total_price"]').value = totalPrice;
        }

        function selectAgent(element) {
            // Get data from attributes
            const phone = element.getAttribute('data-phone');
            const name = element.getAttribute('data-name');
            
            // Clean phone number
            let cleanPhone = phone.replace(/\D/g, '');
            if (cleanPhone.startsWith('0')) {
                cleanPhone = '62' + cleanPhone.substring(1);
            }

            // Update Hidden Inputs
            document.getElementById('agent_name').value = name;
            document.getElementById('agent_phone').value = cleanPhone;

            // Visual Feedback
            document.querySelectorAll('.agent-card-item').forEach(c => {
                c.classList.remove('border-primary', 'bg-light');
                c.classList.add('border');
            });
            
            element.classList.remove('border');
            element.classList.add('border-primary', 'bg-light');
        }

        function selectTipeKamar(btn, id, price, name) {
             document.getElementById('tipe_kamar_id').value = id;
             
             // Update global state
             currentRoomPrice = price;
             selectedRoomName = name;

             // Update visual cards
             document.querySelectorAll('.tipekamar-card-item').forEach(c => {
                c.classList.remove('selected');
            });
            const card = document.getElementById('tipe-card-' + id);
            if(card) card.classList.add('selected');

            // Update visual buttons
            document.querySelectorAll('.tipekamar-select-btn').forEach(b => {
                b.classList.remove('selected');
                b.innerHTML = 'Select';
            });
            btn.classList.add('selected');
            btn.innerHTML = 'Select <i class="bi bi-check-lg ms-1"></i>';

            // Update Sidebar Summary Room Type Name
            const summaryRoomType = document.getElementById('summary-room-type');
            if(summaryRoomType) summaryRoomType.innerText = name;
            
            // Show total price section and hide warning if rented per room
            const priceSection = document.getElementById('total-price-section');
            const warningSection = document.getElementById('select-room-warning');
            if (priceSection) priceSection.style.display = 'block';
            if (warningSection) warningSection.style.display = 'none';

            // Recalculate totals
            calculateBooking();
        }

        function submitFinalBooking() {
            const form = document.getElementById('bookingConfirmForm');
            
            if (!form.reportValidity()) {
                return;
            }

            if (!document.getElementById('agent_name').value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Agen Belum Dipilih',
                    text: 'Silakan pilih agen terlebih dahulu untuk melanjutkan.',
                });
                return;
            }

            // Validate Tipe Kamar if applicable
            const tipekamarInput = document.getElementById('tipe_kamar_id');
            if (document.querySelector('.tipekamar-card-item') && !tipekamarInput.value) {
                 Swal.fire({
                    icon: 'warning',
                    title: 'Tipe Kamar Belum Dipilih',
                    text: 'Silakan pilih tipe kamar terlebih dahulu.',
                });
                return;
            }

            Swal.fire({
                title: 'Memproses Pesanan...',
                text: 'Mohon tunggu, Anda akan diarahkan ke WhatsApp.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Short delay to show loading, then submit
            setTimeout(() => {
                form.submit();
                // Close sweetalert after a few seconds (assuming new tab opens)
                 setTimeout(() => {
                    Swal.close();
                }, 3000);
            }, 1000);
        }
    </script>
@endpush

@endsection
