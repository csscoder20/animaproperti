@extends('frontend.layouts.app')
@section('title', $title)
@section('content')

<section id="summary-section" class="section">
    <div class="container" data-aos="fade-up">

        <div class="page-title bg-transparent py-3 mb-4">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ '/sewa' }}">Sewa</a></li>
                    <li><a href="{{ route('sewa.show', $property->slug) }}">Detail Properti</a></li>
                    <li class="current">Ringkasan Pesanan</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-bottom">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-receipt me-2 text-primary"></i> Ringkasan Pesanan</h4>
                    </div>
                    <div class="card-body p-3 p-md-5">
                        
                        {{-- 1. Detail Properti --}}
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="{{ $property->primary_image_url }}" class="img-fluid rounded shadow-sm mb-3" alt="{{ $property->judul }}">
                                
                                {{-- Fasilitas Kamar --}}
                                @if($property->fasilitas->count() > 0)
                                    <div class="facilities-section">
                                        <small class="text-muted d-block mb-2 fw-semibold"><i class="bi bi-stars me-1"></i>Fasilitas Kamar</small>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($property->fasilitas as $fasilitas)
                                                <span class="badge bg-light text-dark border" style="font-weight: 500; padding: 5px 10px; font-size: 0.85rem;">
                                                    <i class="bi {{ $fasilitas->icon ?? 'bi-check-circle' }} me-1 text-primary"></i>
                                                    {{ $fasilitas->nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h5 class="fw-bold fs-6 fs-md-5">{{ $property->judul }}</h5>
                                <p class="text-muted small mb-2" style="word-break: break-word;"><i class="bi bi-geo-alt me-1"></i> {{ $alamatLengkap }}</p>
                                <hr>
                                <div class="row g-2 g-md-3">
                                    <div class="col-6">
                                        <div class="date-box p-2 p-md-3 rounded" style="border: 2px solid #4CAF50; background: linear-gradient(135deg, rgba(76, 175, 80, 0.05) 0%, rgba(76, 175, 80, 0.1) 100%);">
                                            <small class="text-muted d-block mb-1" style="font-size: 0.7rem;"><i class="bi bi-calendar-check me-1"></i>Check-in</small>
                                            <span class="fw-bold d-block" style="color: #2E7D32; font-size: 0.85rem;">{{ $checkin->translatedFormat('d M Y') }}</span>
                                            <small class="text-muted" style="font-size: 0.7rem;">{{ $checkin->format('H:i') }} WIB</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="date-box p-2 p-md-3 rounded" style="border: 2px solid #FF5722; background: linear-gradient(135deg, rgba(255, 87, 34, 0.05) 0%, rgba(255, 87, 34, 0.1) 100%);">
                                            <small class="text-muted d-block mb-1" style="font-size: 0.7rem;"><i class="bi bi-calendar-x me-1"></i>Check-out</small>
                                            <span class="fw-bold d-block" style="color: #D84315; font-size: 0.85rem;">{{ $checkout->translatedFormat('d M Y') }}</span>
                                            <small class="text-muted" style="font-size: 0.7rem;">{{ $checkout->format('H:i') }} WIB</small>
                                        </div>
                                    </div>
                                    @if(isset($tipeKamar))
                                        <div class="col-12 mt-3">
                                            <div class="p-2 border rounded bg-light">
                                                <small class="text-muted d-block">Tipe Kamar</small>
                                                <strong class="text-primary">{{ $tipeKamar->nama }}</strong>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-6">
                                        <small class="text-muted d-block">Kamar</small>
                                        <strong class="fs-5">{{ $request->rooms }}</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Tamu</small>
                                        <strong class="fs-5">{{ $request->guests }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. Data Pemesan --}}
                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4"><i class="bi bi-person-circle me-2 text-primary"></i>Data Pemesan</h5>
                        <div class="customer-data-card p-3 p-md-4 rounded mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="bi bi-person-fill fs-5" style="color: #fff;"></i>
                                        </div>
                                        <div style="overflow: hidden;">
                                            <small class="d-block" style="color: rgba(255,255,255,0.8); font-size: 0.7rem;">Nama Lengkap</small>
                                            <span class="fw-bold d-block" style="color: #fff; font-size: 0.95rem; word-break: break-word;">{{ $request->customer_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="bi bi-whatsapp fs-5" style="color: #fff;"></i>
                                        </div>
                                        <div style="overflow: hidden;">
                                            <small class="d-block" style="color: rgba(255,255,255,0.8); font-size: 0.7rem;">No. WhatsApp</small>
                                            <span class="fw-bold d-block" style="color: #fff; font-size: 0.95rem; word-break: break-all;">{{ $request->customer_phone }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="bi bi-card-text fs-5" style="color: #fff;"></i>
                                        </div>
                                        <div style="overflow: hidden;">
                                            <small class="d-block" style="color: rgba(255,255,255,0.8); font-size: 0.7rem;">NIK</small>
                                            <span class="fw-bold d-block" style="color: #fff; font-size: 0.95rem; word-break: break-all;">{{ $request->nik }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="bi bi-envelope fs-5" style="color: #fff;"></i>
                                        </div>
                                        <div style="overflow: hidden;">
                                            <small class="d-block" style="color: rgba(255,255,255,0.8); font-size: 0.7rem;">Email</small>
                                            <span class="fw-bold d-block" style="color: #fff; font-size: 0.95rem; word-break: break-all;">{{ $request->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. Metode Pembayaran --}}
                        <h5 class="fw-bold border-bottom pb-2 mb-3"><i class="bi bi-credit-card me-2 text-primary"></i>Metode Pembayaran</h5>
                        <div class="mb-4">
                            <div class="alert alert-success border-success d-flex align-items-center mb-0" style="border-width: 2px; border-left-width: 5px;">
                                <i class="bi bi-bank2 fs-4 me-3 text-success"></i>
                                <div>
                                    <small class="d-block text-muted mb-1">Metode Pembayaran</small>
                                    <span class="fw-bold fs-5 text-success">{{ $request->payment_method }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- 4. Agen yang Dipilih --}}
                        <h5 class="fw-bold border-bottom pb-2 mb-3">Agen yang Dipilih</h5>
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; background: #f0f0f0; flex-shrink: 0;">
                                    @if($agent->pas_foto)
                                        <img src="{{ asset('storage/' . $agent->pas_foto) }}" alt="{{ $agent->nama_lengkap }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <i class="bi bi-person text-secondary d-flex justify-content-center align-items-center h-100 fs-4"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $agent->nama_lengkap }}</h6>
                                    <p class="text-muted small mb-0">Agen Properti</p>
                                </div>
                            </div>
                        </div>

                        {{-- 5. Rincian Biaya --}}
                        <div class="booking-summary bg-light p-3 p-md-4 rounded mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3 fs-6">Rincian Biaya</h5>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.9rem;">
                                <span>Harga per Kamar (per Malam)</span>
                                @php
                                    $pricePerNight = $property->harga_sewa_per_malam ?? $property->harga;
                                @endphp
                                <span class="text-end">Rp {{ number_format($pricePerNight, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.9rem;">
                                <span>Jumlah Kamar</span>
                                <span>x {{ $request->rooms }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.9rem;">
                                <span>Durasi Sewa</span>
                                <span>x {{ $duration }} Malam</span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-3 mt-2">
                                <span class="fw-bold fs-6">Total Bayar</span>
                                <span class="fw-bold fs-6 text-primary text-end" style="word-break: break-all;">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Form to Process Booking --}}
                        <form id="finalBookingForm" action="{{ route('sewa.booking.process', $property->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" name="customer_name" value="{{ $request->customer_name }}">
                            <input type="hidden" name="customer_phone" value="{{ $request->customer_phone }}">
                            <input type="hidden" name="nik" value="{{ $request->nik }}">
                            <input type="hidden" name="email" value="{{ $request->email }}">
                            <input type="hidden" name="agent_phone" value="{{ $request->agent_phone }}">
                            <input type="hidden" name="agent_name" value="{{ $request->agent_name }}">
                            <input type="hidden" name="checkin" value="{{ $request->checkin }}">
                            <input type="hidden" name="checkout" value="{{ $request->checkout }}">
                            <input type="hidden" name="rooms" value="{{ $request->rooms }}">
                            <input type="hidden" name="guests" value="{{ $request->guests }}">
                            <input type="hidden" name="duration" value="{{ $duration }}">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                            <input type="hidden" name="payment_method" value="{{ $request->payment_method }}">
                            <input type="hidden" name="tipe_kamar_id" value="{{ $request->tipe_kamar_id }}">
                            
                            
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch gap-2 gap-sm-3 mt-4">
                                <a href="javascript:history.back()" class="btn btn-outline-secondary py-2 fw-bold" style="flex: 1;">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                                
                                <button type="button" class="btn btn-success py-2 fw-bold shadow-sm btn-custom-accent" style="flex: 1;" onclick="submitFinalBooking()">
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
    function submitFinalBooking() {
        const form = document.getElementById('finalBookingForm');
        
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
            setTimeout(() => {
                Swal.close();
            }, 3000);
        }, 1000);
    }
</script>
@endpush
