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
                                    <input type="hidden" name="checkin" value="{{ $checkin->format('Y-m-d\TH:i') }}">
                                    <input type="hidden" name="checkout" value="{{ $checkout->format('Y-m-d\TH:i') }}">
                                    <input type="hidden" name="rooms" value="{{ $rooms }}">
                                    <input type="hidden" name="guests" value="{{ $guests }}">
                                    <input type="hidden" name="duration" value="{{ $duration }}">
                                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                    <input type="hidden" name="agent_name" id="agent_name">
                                    <input type="hidden" name="agent_phone" id="agent_phone">

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
                                    </div>

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

                                    <button type="button" class="btn btn-success w-auto py-2 fw-bold btn-custom-accent " onclick="submitFinalBooking()">
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
                                        @if ($property->fasilitas->count() > 0)
                                            @foreach ($property->fasilitas as $fasilitas)
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
                                        <span class="fw-bold">{{ $checkin->translatedFormat('d M Y') }} - {{ $checkout->translatedFormat('d M Y') }}</span>
                                        <span class="ms-1">({{ $duration }} Malam)</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-muted d-block">Unit:</span>
                                        <span class="fw-bold">{{ $rooms }} Kamar, {{ $guests }} Tamu</span>
                                    </div>
                                    <div class="col-12 border-top pt-2 mt-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold">Total Biaya:</span>
                                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Agent Selection Logic (Event Delegation not needed with onclick)
        });

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
