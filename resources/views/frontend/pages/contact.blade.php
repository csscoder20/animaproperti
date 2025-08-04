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
                        <h4>{{ $kontak->judul ?? 'Location' }}</h4>
                        <p>{{ $kontak->alamat ?? 'Alamat belum tersedia' }} </p>
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
                        <p>{{ $kontak->telepon ?? 'Telepon belum tersedia' }}</p>
                        <p>{{ $kontak->email ?? 'Email belum tersedia' }}</p>
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
                        @if ($kontak && $kontak->whatsapp)
                            <div class="info-content mt-2">
                                <p>
                                    <a href="https://wa.me/{{ $kontak->whatsapp }}" target="_blank">
                                        {{ $kontak->whatsapp }}
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
            @if ($kontak && $kontak->latitude && $kontak->longitude)
                <iframe
                    src="https://www.google.com/maps?q={{ $kontak->latitude }},{{ $kontak->longitude }}&z=12&output=embed"
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
