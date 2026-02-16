@extends('frontend.layouts.app')
@section('title', $title)
@section('content')

<section id="confirmation-section" class="section">
    <div class="container" data-aos="fade-up">

        <div class="page-title bg-transparent py-3 mb-4">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ '/sewa' }}">Sewa</a></li>
                    <li><a href="{{ route('sewa.show', $property->slug) }}">Detail Properti</a></li>

                    <li class="current">Konfirmasi</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-bottom">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-journal-check me-2 text-primary"></i> Konfirmasi Pesanan</h4>
                    </div>
                    <div class="card-body p-5">
                        
                        {{-- 1. Detail Properti (Read-Only) --}}
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <img src="{{ $property->primary_image_url }}" class="img-fluid rounded shadow-sm" alt="{{ $property->judul }}">
                            </div>
                            <div class="col-md-8">
                                <h5 class="fw-bold">{{ $property->judul }}</h5>
                                <p class="text-muted small mb-2"><i class="bi bi-geo-alt me-1"></i> {{ $property->kecamatan }}, {{ $property->kabupaten }}</p>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Check-in</small>
                                        <span class="fw-bold">{{ \Carbon\Carbon::parse($bookingData['checkin'])->translatedFormat('d M Y') }}</span>
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($bookingData['checkin'])->format('H:i') }} WIB</small>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Check-out</small>
                                        <span class="fw-bold">{{ \Carbon\Carbon::parse($bookingData['checkout'])->translatedFormat('d M Y') }}</span>
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($bookingData['checkout'])->format('H:i') }} WIB</small>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Kamar</small>
                                        <strong class="fs-5">{{ $bookingData['rooms'] }}</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Tamu</small>
                                        <strong class="fs-5">{{ $bookingData['guests'] }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="bookingConfirmForm" action="{{ route('sewa.booking.process', $property->slug) }}" method="POST" target="_blank">
                            @csrf
                            {{-- Specific Data from Previous Step --}}
                            <input type="hidden" name="checkin" value="{{ $bookingData['checkin'] }}">
                            <input type="hidden" name="checkout" value="{{ $bookingData['checkout'] }}">
                            <input type="hidden" name="rooms" value="{{ $bookingData['rooms'] }}">
                            <input type="hidden" name="guests" value="{{ $bookingData['guests'] }}">
                            <input type="hidden" name="duration" value="{{ $bookingData['duration'] }}">
                            <input type="hidden" name="total_price" value="{{ $bookingData['total_price'] }}">
                            <input type="hidden" name="tipe_kamar_id" value="{{ $bookingData['tipe_kamar_id'] ?? '' }}">
                            
                            {{-- Agent Data (Hidden) --}}
                            <input type="hidden" name="agent_name" id="agent_name">
                            <input type="hidden" name="agent_phone" id="agent_phone">

                            {{-- 2. Data Pemesan --}}
                            <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Data Pemesan</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="customer_name" required placeholder="Contoh: Budi Santoso">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">No. WhatsApp</label>
                                    <input type="tel" class="form-control" name="customer_phone" required placeholder="Contoh: 08123456789">
                                </div>
                            </div>

                            {{-- 3. Metode Pembayaran --}}
                            <h5 class="fw-bold border-bottom pb-2 mb-3">Metode Pembayaran</h5>
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

                            {{-- 4. Pilih Agen --}}
                            <h5 class="fw-bold border-bottom pb-2 mb-3">Pilih Agen</h5>
                            <div class="mb-4">
                                <div class="row g-3" style="max-height: 300px; overflow-y: auto;">
                                    @forelse($agents as $index => $agen)
                                        <div class="col-md-6">
                                            <div id="agent-card-{{ $index }}" class="card border agent-card-item cursor-pointer h-100" onclick="selectAgent('{{ $agen->no_hp }}', '{{ $agen->nama_lengkap }}', 'agent-card-{{ $index }}')" style="cursor: pointer; transition: all 0.2s ease;">
                                                <div class="card-body p-3 d-flex align-items-center">
                                                    <div class="avatar me-3" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; background: #f0f0f0; flex-shrink: 0;">
                                                        @if($agen->pas_foto)
                                                            <img src="{{ asset('storage/' . $agen->pas_foto) }}" alt="{{ $agen->nama_lengkap }}" class="w-100 h-100 object-fit-cover">
                                                        @else
                                                            <i class="bi bi-person text-secondary d-flex justify-content-center align-items-center h-100 fs-4"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-0">{{ $agen->nama_lengkap }}</h6>
                                                        <p class="text-muted small mb-0">Agen Properti</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-warning">Belum ada agen tersedia.</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- 5. Booking Summary (Total) --}}
                            <div class="booking-summary bg-light p-4 rounded mb-4">
                                <h5 class="fw-bold border-bottom pb-2 mb-3">Rincian Biaya</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Harga per Kamar (per Malam)</span>
                                    @php
                                        $pricePerNight = $property->harga_sewa_per_malam ?? $property->harga;
                                    @endphp
                                    <span>Rp {{ number_format($pricePerNight, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Jumlah Kamar</span>
                                    <span>x {{ $bookingData['rooms'] }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Durasi Sewa</span>
                                    <span>x {{ $bookingData['duration'] }} Malam</span>
                                </div>
                                <div class="d-flex justify-content-between border-top pt-3 mt-2">
                                    <span class="fw-bold fs-5">Total Bayar</span>
                                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($bookingData['total_price'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 fw-bold">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                                
                                <button type="button" class="btn btn-success px-5 py-3 fw-bold shadow-sm btn-custom-accent" onclick="submitFinalBooking()">
                                    <i class="bi bi-whatsapp me-2"></i> Proses Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    let selectedAgentPhone = '';
    let selectedAgentName = '';

    function selectAgent(phone, agentName, elementId) {
        // Clean phone number
        let cleanPhone = phone.replace(/\D/g, '');
        if (cleanPhone.startsWith('0')) {
            cleanPhone = '62' + cleanPhone.substring(1);
        }

        selectedAgentPhone = cleanPhone;
        selectedAgentName = agentName;

        // Visual selection
        document.querySelectorAll('.agent-card-item').forEach(el => {
            el.classList.remove('border-primary', 'bg-light');
            el.classList.add('border');
        });

        const selectedEl = document.getElementById(elementId);
        if (selectedEl) {
            selectedEl.classList.remove('border');
            selectedEl.classList.add('border-primary', 'bg-light');
        }

        // Update Hidden Inputs
        document.getElementById('agent_name').value = selectedAgentName;
        document.getElementById('agent_phone').value = selectedAgentPhone;
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
