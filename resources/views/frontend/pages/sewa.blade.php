@extends('frontend.layouts.app')
@section('content')
@section('title', $title)



<section id="sewa-properties" class="properties section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form id="searchForm" action="{{ route('sewa.index') }}" method="GET">
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
                                                placeholder="0 Dewasa, 0 Anak, 0 Kamar" readonly data-bs-toggle="dropdown"
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
                                                        <span id="adultCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">0</span>
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
                                                        <span id="roomCount" class="mx-3 fw-bold" style="min-width: 20px; text-align: center;">0</span>
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
                                            value="{{ request('guests', 0) }}">
                                        <input type="hidden" name="rooms" id="totalRooms"
                                            value="{{ request('rooms', 0) }}">
                                        {{-- Store detailed state for UI consistency on reload --}}
                                        <input type="hidden" name="adults" id="inputAdults" value="{{ request('adults', 0) }}">
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

        {{-- Search Results Section --}}
        @if(isset($isSearch) && $isSearch && isset($properties) && $properties->count() > 0)
            <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
                {{-- Sidebar: Booking Summary --}}
                {{-- Sidebar: Booking Summary --}}
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm p-4 mb-4 sticky-top rounded-4" style="top: 2rem; z-index: 1;">
                        <h5 class="fw-bold mb-4 text-dark">Booking Summary</h5>
                        
                        {{-- Check-in --}}
                        <div class="mb-4">
                            <label class="small text-muted text-uppercase fw-bold mb-2">Check-in</label>
                            @if(request('checkin'))
                                <div class="d-flex align-items-center border-start border-4 border-danger ps-3">
                                    <div class="display-5 fw-bold me-3 lh-1">{{ \Carbon\Carbon::parse(request('checkin'))->format('d') }}</div>
                                    <div class="lh-sm">
                                        <div class="fw-bold small">{{ \Carbon\Carbon::parse(request('checkin'))->translatedFormat('F Y') }}</div>
                                        <div class="small text-muted">{{ \Carbon\Carbon::parse(request('checkin'))->translatedFormat('l') }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="text-muted fst-italic ps-3 border-start border-4 border-light">-</div>
                            @endif
                        </div>

                        {{-- Check-out --}}
                        <div class="mb-4">
                            <label class="small text-muted text-uppercase fw-bold mb-2">Check-out</label>
                            @if(request('checkout'))
                                <div class="d-flex align-items-center border-start border-4 border-danger ps-3">
                                    <div class="display-5 fw-bold me-3 lh-1">{{ \Carbon\Carbon::parse(request('checkout'))->format('d') }}</div>
                                    <div class="lh-sm">
                                        <div class="fw-bold small">{{ \Carbon\Carbon::parse(request('checkout'))->translatedFormat('F Y') }}</div>
                                        <div class="small text-muted">{{ \Carbon\Carbon::parse(request('checkout'))->translatedFormat('l') }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="text-muted fst-italic ps-3 border-start border-4 border-light">-</div>
                            @endif
                        </div>
                        
                        <hr class="my-3 opacity-25">
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Durasi</span>
                            <span class="fw-bold">
                                @if(request('checkin') && request('checkout'))
                                    {{ \Carbon\Carbon::parse(request('checkin'))->diffInDays(\Carbon\Carbon::parse(request('checkout'))) }} Malam
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tamu</span>
                            <span class="fw-bold">{{ request('guests', 0) }} Orang</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Kamar</span>
                            <span class="fw-bold">{{ request('rooms', 0) }} Kamar</span>
                        </div>
                    </div>
                </div>

                {{-- Results List --}}
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Select Room</h4>
                        <span class="text-muted small">{{ $totalResults }} Results Found</span>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @foreach ($properties as $property)
                            <div class="card border mb-3 shadow-sm overflow-hidden">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        {{-- Image --}}
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
                                        <div style="height: 100%; min-height: 200px;">
                                            <img src="{{ $imageUrl }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="{{ $property->judul }}">
                                            @if($property->penawaran)
                                                <div class="position-absolute top-0 start-0 m-2">
                                                    <span class="badge bg-primary">{{ $property->penawaran }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="mb-2">
                                                    <h5 class="card-title fw-bold mb-1">{{ $property->judul }}</h5>
                                                    <p class="card-text text-muted small mb-2">
                                                    {{ $property->jenisProperti->nama ?? '' }} &bull; 
                                                    </p>
                                                </div>
                                                
                                                <div class="row g-2">
                                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                                        @if ($property->fasilitas->count() > 0)
                                                            @foreach ($property->fasilitas as $fasilitas)
                                                                <div class="d-flex align-items-center text-muted small me-2">
                                                                    <i class="bi {{ $fasilitas->icon ?? 'bi-check-circle' }} me-1 text-primary"></i>
                                                                    <span>{{ $fasilitas->nama }}</span>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="text-muted small fst-italic">No facilities data available.</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div class="text-start me-3">
                                                    <h4 class="fw-bold mb-0 text-primary">Rp {{ number_format($property->harga, 0, ',', '.') }}</h4>
                                                    <small class="text-muted d-block">Per Malam</small>
                                                </div>
                                                <a href="{{ route('sewa.show', array_merge(['slug' => $property->slug], request()->query())) }}" class="btn btn-outline-primary px-4 rounded-pill btn-custom-accent w-auto">Pilih</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav class="pagination-wrapper mt-4">
                        {{ $properties->links() }}
                    </nav>
                </div>
            </div>
        @elseif(isset($isSearch) && $isSearch)
            <div class="col-12 text-center py-5 mb-5">
                <div class="empty-results">
                    <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                    <h3>Properti tidak ditemukan</h3>
                    <p class="text-muted">Coba ubah filter pencarian Anda</p>
                </div>
            </div>
        @endif



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


        {{-- Slider Section --}}
        @if(isset($activeSliders) && $activeSliders->count() > 0)
            <div class="swiper mySwiper mt-4 mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper mb-3">
                    @foreach ($activeSliders as $slider)
                        <div class="swiper-slide position-relative">

                            @php
                                $imagePath =
                                    $slider->image_path &&
                                    file_exists(storage_path('app/public/' . $slider->image_path))
                                        ? asset('storage/' . $slider->image_path)
                                        : asset('images/no-image.jpg');
                            @endphp

                            @if ($slider->link_url)
                                <a href="{{ $slider->link_url }}">
                                    <img src="{{ $imagePath }}" alt="{{ $slider->title ?? 'Slider Image' }}"
                                        class="img-fluid w-100 rounded">
                                </a>
                            @else
                                <img src="{{ $imagePath }}" alt="{{ $slider->title ?? 'Slider Image' }}"
                                    class="img-fluid w-100 rounded">
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        @endif



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
                adult: parseInt(document.getElementById('inputAdults').value) || 0,
                child: parseInt(document.getElementById('inputChildren').value) || 0,
                room: parseInt(document.getElementById('totalRooms').value) || 0
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
                    if (counts.adult + change >= 0) counts.adult += change;
                } else if (type === 'child') {
                    if (counts.child + change >= 0) counts.child += change;
                } else if (type === 'room') {
                    if (counts.room + change >= 0) counts.room += change;
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

            // Swiper Initialization
            @if(isset($activeSliders) && $activeSliders->count() > 0)
                var slideCount = {{ $activeSliders->count() }};
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: slideCount === 1 ? 1 : 1,
                    spaceBetween: 10,
                    breakpoints: slideCount === 1 ? {} : {
                        768: {
                            slidesPerView: 1.5,
                            spaceBetween: 20
                        },
                        992: {
                            slidesPerView: 1.5,
                            spaceBetween: 20
                        },
                    },
                    freeMode: true,
                    grabCursor: true,
                    pagination: {
                        el: ".mySwiper .swiper-pagination",
                        clickable: true
                    }
                });
            @endif
            // Form Validation (Validation for required fields)
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const keyword = this.querySelector('input[name="keyword"]').value;
                    const checkin = document.getElementById('checkin').value;
                    const checkout = document.getElementById('checkout').value;
                    const rooms = parseInt(document.getElementById('totalRooms').value) || 0;
                    const guests = parseInt(document.getElementById('totalGuests').value) || 0;

                    let errors = [];

                    if (!keyword.trim()) errors.push("Lokasi harus diisi");
                    if (!checkin || !checkout) errors.push("Tanggal sewa harus dipilih");
                    if (rooms <= 0) errors.push("Jumlah kamar minimal 1");
                    if (guests <= 0) errors.push("Jumlah tamu minimal 1");

                    if (errors.length > 0) {
                        e.preventDefault();
                        
                        // Check if Swal is defined, otherwise fallback to alert
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Lengkapi Data',
                                html: '<ul style="text-align: left; margin-left: 1rem;">' + errors.map(err => `<li>${err}</li>`).join('') + '</ul>',
                                confirmButtonColor: '#0d6efd', // Bootstrap primary
                                confirmButtonText: 'OK'
                            });
                        } else {
                            alert("Mohon lengkapi data pencarian:\n- " + errors.join("\n- "));
                        }
                    }
                });
            }
        });

    </script>
@endsection
