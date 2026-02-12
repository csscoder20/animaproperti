@extends('frontend.layouts.app')
@section('title', $title)
@section('content')

<section id="booking-section" class="section">
    <div class="container" data-aos="fade-up">
        
        <div class="page-title bg-transparent py-3 mb-4">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ '/sewa' }}">Sewa</a></li>
                    <li><a href="{{ route('sewa.show', $property->slug) }}">Detail Properti</a></li>
                    <li class="current">Booking</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <!-- Property Summary -->
            <div class="col-lg-4 order-lg-2">
                <div class="card border-0 shadow-sm mb-4">
                    <img src="{{ $property->primary_image_url }}" class="card-img-top" alt="{{ $property->judul }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $property->judul }}</h5>
                        <p class="text-primary fw-bold mb-1">Rp {{ number_format($property->harga, 0, ',', '.') }} <span class="text-muted small">/ kamar /hari</span></p>
                        <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1"></i> {{ $alamatLengkap }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="col-lg-8 order-lg-1">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="fw-bold mb-4">Formulir Pemesanan</h3>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="bookingForm" action="{{ route('sewa.booking.confirm', $property->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="agent_name" id="agent_name">
                        <input type="hidden" name="agent_phone" id="agent_phone">
                        <div class="row g-3">
                            <div class="col-12">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Data Diri</h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Contoh: Budi Santoso">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">No. WhatsApp Anda</label>
                                <input type="tel" class="form-control" name="customer_phone" value="{{ old('customer_phone') }}" required placeholder="Contoh: 08123456789">
                            </div>

                            <div class="col-12 mt-4">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Detail Sewa</h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Check-in</label>
                                <input type="datetime-local" class="form-control" id="checkin" name="checkin" value="{{ old('checkin') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Check-out</label>
                                <input type="datetime-local" class="form-control" id="checkout" name="checkout" value="{{ old('checkout') }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jumlah Kamar</label>
                                <input type="number" class="form-control" id="rooms" name="rooms" min="1" value="{{ old('rooms', 1) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jumlah Tamu</label>
                                <input type="number" class="form-control" id="guests" name="guests" min="1" value="{{ old('guests', 1) }}" required>
                            </div>

                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold mb-3">Pilih Agen untuk Pemesanan:</label>
                                <div class="swiper agent-booking-slider pb-5">
                                    <div class="swiper-wrapper">
                                        @forelse($agents as $index => $agen)
                                            <div class="swiper-slide">
                                                <div class="card h-100 border-0 shadow-sm agent-card-item">
                                                    <div class="card-body text-center p-4">
                                                        <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; background: #f0f0f0;">
                                                            @if($agen->pas_foto)
                                                                <img src="{{ asset('storage/' . $agen->pas_foto) }}" alt="{{ $agen->nama_lengkap }}" class="w-100 h-100 object-fit-cover">
                                                            @else
                                                                <i class="bi bi-person text-secondary d-flex justify-content-center align-items-center h-100 fs-1"></i>
                                                            @endif
                                                        </div>
                                                        <h6 class="fw-bold mb-1">{{ $agen->nama_lengkap }}</h6>
                                                        <p class="text-muted small mb-3">Agen Properti</p>
                                                        <button type="button" class="btn btn-whatsapp btn-success btn-sm text-white w-100 rounded-pill" onclick="selectAgent('{{ $agen->no_hp }}', '{{ $agen->nama_lengkap }}')">
                                                            <i class="bi bi-whatsapp me-2"></i> Pesan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="alert alert-warning">Belum ada agen yang tersedia.</div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const maxRooms = {{ $property->jumlah_kamar }};
    const maxGuestsPerRoom = {{ $property->kapasitas_tamu }};

    window.addEventListener('pageshow', function(event) {
        Swal.close();
    });

    function selectAgent(phone, agentName) {
        if (!phone) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nomor agen tidak valid.',
            });
            return;
        }

        if (!document.getElementById('bookingForm').reportValidity()) {
            return;
        }

        // Validate Form
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;
        const rooms = parseInt(document.getElementById('rooms').value) || 0;
        const guests = parseInt(document.getElementById('guests').value) || 0;

        if (!checkin || !checkout) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Mohon isi tanggal Check-in dan Check-out.',
            });
            return;
        }

        if (rooms <= 0 || guests <= 0) {
             Swal.fire({
                icon: 'warning',
                title: 'Data Tidak Valid',
                text: 'Jumlah kamar dan tamu harus minimal 1.',
            });
            return;
        }

        // Validation: Availability
        if (rooms > maxRooms) {
            Swal.fire({
                icon: 'error',
                title: 'Kamar Tidak Cukup',
                text: `Maaf, hanya tersedia ${maxRooms} kamar untuk properti ini.`,
            });
            return;
        }

        // Validation: Capacity
        const maxGuestsAllowed = rooms * maxGuestsPerRoom;
        if (guests > maxGuestsAllowed) {
             Swal.fire({
                icon: 'error',
                title: 'Melebihi Kapasitas',
                text: `Maaf, kapasitas maksimal untuk ${rooms} kamar adalah ${maxGuestsAllowed} tamu (${maxGuestsPerRoom} orang/kamar).`,
            });
            return;
        }

        // Clean phone number
        phone = phone.replace(/\D/g, '');
        if (phone.startsWith('0')) {
            phone = '62' + phone.substring(1);
        }

        // Set Hidden Values and Submit
        try {
            document.getElementById('agent_name').value = agentName;
            document.getElementById('agent_phone').value = phone;
            
            // Show Loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            document.getElementById('bookingForm').submit();
        } catch (e) {
            console.error(e);
            Swal.fire('Error', 'Terjadi kesalahan: ' + e.message, 'error');
        }
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
    
    // Set min date to today (Local Time)
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('checkin').min = now.toISOString().slice(0, 16);

    document.getElementById('checkin').addEventListener('change', function() {
        document.getElementById('checkout').min = this.value;
    });
    // Initialize Swiper for Agents
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.agent-booking-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    });
</script>

@endsection
