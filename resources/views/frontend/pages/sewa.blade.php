@extends('frontend.layouts.app')
@section('content')
@section('title', $title)



<section id="sewa-properties" class="properties section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('sewa.index') }}" method="GET">
            <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="search-wrapper">
                            <div class="row g-3">
                                {{-- Keyword Search (Lokasi / Nama Kost / Apartemen) --}}
                                <div class="col-lg-4 col-md-12">
                                    <div class="search-field">
                                        <label class="field-label">Pencarian</label>
                                        <input type="text" name="keyword" class="form-control"
                                            placeholder="Cari nama kost, apartemen, atau lokasi (Kecamatan/Kota)..."
                                            value="{{ request('keyword') }}">
                                    </div>
                                </div>

                                {{-- Date Range Picker --}}
                                <div class="col-lg-4 col-md-12">
                                    <div class="search-field">
                                        <label class="field-label">Tanggal Sewa</label>
                                        <input type="text" id="datepicker" class="form-control" placeholder="Pilih Tanggal Check-in - Check-out" readonly>
                                        <input type="hidden" name="checkin" id="checkin" value="{{ request('checkin') }}">
                                        <input type="hidden" name="checkout" id="checkout" value="{{ request('checkout') }}">
                                    </div>
                                </div>

                                {{-- Guest & Room Dropdown --}}
                                <div class="col-lg-4 col-md-12">
                                    <div class="search-field">
                                        <label class="field-label">Tamu & Kamar</label>
                                        <div class="dropdown">
                                            <input type="text" id="guestRoomDisplay" class="form-control"
                                                placeholder="1 Dewasa, 0 Anak, 1 Kamar" readonly data-bs-toggle="dropdown"
                                                aria-expanded="false" style="background-color: #fff; cursor: pointer;">
                                            <ul class="dropdown-menu p-3 border-0 shadow" aria-labelledby="guestRoomDisplay"
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
                                                        <span id="adultCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">1</span>
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
                                                        <span id="childCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">0</span>
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
                                                        <span id="roomCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">1</span>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary rounded-circle"
                                                            onclick="updateCounter('room', 1)"
                                                            style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">+</button>
                                                    </div>
                                                </li>

                                                {{-- Done Button --}}
                                                <li>
                                                    <button type="button" class="btn btn-primary w-100 rounded-pill" onclick="document.getElementById('guestRoomDisplay').click()">Selesai</button>
                                                </li>
                                            </ul>
                                        </div>

                                        {{-- Hidden Inputs for Form Submission --}}
                                        <input type="hidden" name="guests" id="totalGuests"
                                            value="{{ request('guests', 1) }}">
                                        <input type="hidden" name="rooms" id="totalRooms"
                                            value="{{ request('rooms', 1) }}">
                                        {{-- Store detailed state for UI consistency on reload --}}
                                        <input type="hidden" name="adults" id="inputAdults" value="{{ request('adults', 1) }}">
                                        <input type="hidden" name="children" id="inputChildren" value="{{ request('children', 0) }}">
                                    </div>
                                </div>

                                {{-- Button Cari --}}
                                <div class="col-12 mt-3 text-start">
                                    <div class="search-field">
                                        <label class="field-label d-none d-lg-block">&nbsp;</label>
                                        <button type="submit" class="btn btn-custom-accent w-auto">
                                            <i class="bi bi-search me-2"></i> Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Features Section --}}
        <div class="features-section mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item d-flex align-items-center bg-white p-3 rounded shadow-sm border h-100">
                        <div class="feature-icon me-3">
                            <i class="bi bi-calendar-check fs-2 text-primary"></i>
                        </div>
                        <div class="feature-text">
                            <h6 class="mb-1 fw-bold">Mudah Refund & Reschedule</h6>
                            <p class="mb-0 text-muted small">Batalkan atau ubah jadwal sewa Anda dengan mudah dan fleksibel.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item d-flex align-items-center bg-white p-3 rounded shadow-sm border h-100">
                        <div class="feature-icon me-3">
                            <i class="bi bi-shield-check fs-2 text-primary"></i>
                        </div>
                        <div class="feature-text">
                            <h6 class="mb-1 fw-bold">Transaksi Aman & Mudah</h6>
                            <p class="mb-0 text-muted small">Nikmati kemudahan bertransaksi dengan jaminan keamanan pembayaran.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item d-flex align-items-center bg-white p-3 rounded shadow-sm border h-100">
                        <div class="feature-icon me-3">
                            <i class="bi bi-headset fs-2 text-primary"></i>
                        </div>
                        <div class="feature-text">
                            <h6 class="mb-1 fw-bold">Layanan Pelanggan 24/7</h6>
                            <p class="mb-0 text-muted small">Tim kami siap membantu kebutuhan Anda kapan saja, di mana saja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    
                                    <div class="property-footer mt-3">
                                        <a href="{{ route('sewa.show', $property->slug) }}" class="btn btn-primary w-100 rounded-pill btn-custom-accent">
                                            Lihat Detail
                                        </a>
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



    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const picker = new easepick.create({
                element: document.getElementById('datepicker'),
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
                calendars: 2,
                grid: 2,
                zIndex: 10,
                format: 'D MMM YYYY',
                setup(picker) {
                    picker.on('select', (e) => {
                        const {
                            start,
                            end
                        } = e.detail;
                        document.getElementById('checkin').value = start ? start.format('YYYY-MM-DD') :
                            '';
                        document.getElementById('checkout').value = end ? end.format('YYYY-MM-DD') :
                            '';
                    });
                },
            });

            // Pre-fill dates if exist
            const checkinVal = document.getElementById('checkin').value;
            const checkoutVal = document.getElementById('checkout').value;

            if (checkinVal && checkoutVal) {
                const start = new Date(checkinVal);
                const end = new Date(checkoutVal);
                picker.setDateRange(start, end);
            }

            // Guest & Room Counter Logic
            let counts = {
                adult: parseInt(document.getElementById('inputAdults').value) || 1,
                child: parseInt(document.getElementById('inputChildren').value) || 0,
                room: parseInt(document.getElementById('totalRooms').value) || 1
            };

            function updateDisplay() {
                document.getElementById('adultCount').innerText = counts.adult;
                document.getElementById('childCount').innerText = counts.child;
                document.getElementById('roomCount').innerText = counts.room;

                document.getElementById('inputAdults').value = counts.adult;
                document.getElementById('inputChildren').value = counts.child;
                document.getElementById('totalRooms').value = counts.room;
                document.getElementById('totalGuests').value = counts.adult + counts.child;

                let displayText = `${counts.adult} Dewasa, ${counts.child} Anak, ${counts.room} Kamar`;
                document.getElementById('guestRoomDisplay').value = displayText;

                updateChildrenAgeInputs();
            }

            function updateChildrenAgeInputs() {
                const container = document.getElementById('childrenAgeInputs');
                const section = document.getElementById('childrenAgeSection');
                
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

            window.updateCounter = function(type, change) {
                if (type === 'adult') {
                    if (counts.adult + change >= 1) counts.adult += change;
                } else if (type === 'child') {
                    if (counts.child + change >= 0) counts.child += change;
                } else if (type === 'room') {
                    if (counts.room + change >= 1) counts.room += change;
                }
                updateDisplay();
            };

            window.convertMonthToYear = function(input, index) {
                const months = parseInt(input.value) || 0;
                const years = (months / 12).toFixed(1);
                const display = document.getElementById(`age-conversion-${index}`);
                display.innerText = `${years} Tahun`;
            };

            // Initialize display
            updateDisplay();

            // Prevent dropdown from closing when clicking inside
            document.querySelectorAll('.dropdown-menu').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
@endsection
