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
                    <li><a href="{{ route('sewa.booking', $property->slug) }}">Booking</a></li>
                    <li class="current">Konfirmasi</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-header bg-success text-white p-4">
                        <h4 class="mb-0 fw-bold text-white"><i class="bi bi-cart-check me-2 text-white"></i> Detail Pesanan</h4>
                    </div>
                    <div class="card-body p-5">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <img src="{{ $property->primary_image_url }}" class="img-fluid rounded shadow-sm" alt="{{ $property->judul }}">
                            </div>
                            <div class="col-md-8">
                                <h4 class="fw-bold">{{ $property->judul }}</h4>
                                <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> {{ $property->kecamatan }}, {{ $property->kabupaten }}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block">Check-in</small>
                                        <strong class="fs-5 d-block">{{ \Carbon\Carbon::parse($bookingData['checkin'])->translatedFormat('d M Y') }}</strong>
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                            <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($bookingData['checkin'])->format('H:i') }} WIB
                                        </span>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block">Check-out</small>
                                        <strong class="fs-5 d-block">{{ \Carbon\Carbon::parse($bookingData['checkout'])->translatedFormat('d M Y') }}</strong>
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                            <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($bookingData['checkout'])->format('H:i') }} WIB
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Jumlah Kamar</small>
                                        <strong>{{ $bookingData['rooms'] }} Kamar</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Jumlah Tamu</small>
                                        <strong>{{ $bookingData['guests'] }} Orang</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary bg-light p-4 rounded mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">Rincian Pembayaran</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Harga per Kamar (per Malam)</span>
                                <span>Rp {{ number_format($property->harga, 0, ',', '.') }}</span>
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
                                <span class="fw-bold fs-5">Total Harga</span>
                                <span class="fw-bold fs-5 text-primary">Rp {{ number_format($bookingData['total_price'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="javascript:history.back()" class="btn btn-outline-secondary px-4">Kembali</a>
                            
                            <form action="{{ route('sewa.booking.process', $property->slug) }}" method="POST" target="_blank">
                                @csrf
                                <input type="hidden" name="customer_name" value="{{ $bookingData['customer_name'] }}">
                                <input type="hidden" name="customer_phone" value="{{ $bookingData['customer_phone'] }}">
                                <input type="hidden" name="agent_name" value="{{ $bookingData['agent_name'] }}">
                                <input type="hidden" name="agent_phone" value="{{ $bookingData['agent_phone'] }}">
                                <input type="hidden" name="checkin" value="{{ $bookingData['checkin'] }}">
                                <input type="hidden" name="checkout" value="{{ $bookingData['checkout'] }}">
                                <input type="hidden" name="rooms" value="{{ $bookingData['rooms'] }}">
                                <input type="hidden" name="guests" value="{{ $bookingData['guests'] }}">
                                <input type="hidden" name="duration" value="{{ $bookingData['duration'] }}">
                                <input type="hidden" name="total_price" value="{{ $bookingData['total_price'] }}">

                                <button type="submit" class="btn btn-success px-5 py-3 fw-bold shadow-sm btn-custom-accent">
                                    <i class="bi bi-whatsapp me-2"></i> Proses Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
