@extends('frontend.layouts.app')
@section('content')
@section('title', $title)

<section id="contact-2" class="contact-2 section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4 mb-5" data-aos="fade-up" data-aos-delay="300">
            <div class="col-md-4">
                <div class="contact-info-card">
                    <div class="icon-box">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>Alamat</h4>
                        <p>{{ $settings['address'] ?? 'Alamat belum tersedia' }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-info-card">
                    <div class="icon-box">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div class="info-content">
                        <h4>Phone &amp; Email</h4>
                        <p>{{ $settings['phone'] ?? 'Telepon belum tersedia' }}</p>
                        <p>{{ $settings['email'] ?? 'Email belum tersedia' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card">
                    <div class="icon-box">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div class="info-content">
                        <h4>WhatsApp</h4>
                        @if (!empty($settings['phone']))
                            <div class="info-content mt-2">
                                <p>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone']) }}"
                                        target="_blank">
                                        {{ $settings['phone'] }}
                                    </a>
                                </p>
                            </div>
                        @else
                            <p>WhatsApp belum tersedia</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4 mb-5" data-aos="fade-up" data-aos-delay="300">
            @if (!empty($settings['latitude']) && !empty($settings['longitude']))
                <iframe
                    src="https://www.google.com/maps?q={{ $settings['latitude'] }},{{ $settings['longitude'] }}&z=12&output=embed"
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
                <div class="alert alert-warning text-center">
                    Belum ada data untuk peta.
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
