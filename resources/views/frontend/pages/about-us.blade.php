@extends('frontend.layouts.app')
@section('title', $title)
@section('content')

    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content text-center" data-aos="zoom-in" data-aos-delay="200">
                        <h2>{{ $settings['site_title'] ?? 'Animaproperty' }}</h2>
                        <p class="hero-description">{!! $settings['site_description'] ?? '' !!}</p>
                    </div>

                    <div class="dual-image-layout" data-aos="fade-up" data-aos-delay="300">
                        <div class="row g-4 align-items-center justify-content-center">
                            <div class="col-lg-6">
                                <div class="primary-image-wrap">
                                    <img src="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('themes/frontend/assets/img/default.png') }}"
                                        alt="{{ $settings['site_title'] ?? 'Animaproperty' }}" class="img-fluid">

                                    <div class="floating-badge" data-aos="zoom-in" data-aos-delay="400">
                                        <div class="badge-content">
                                            <i class="bi bi-award"></i>
                                            <span>Top Rated Agency</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="features-showcase" data-aos="fade-up" data-aos-delay="350">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box" data-aos="flip-up" data-aos-delay="400">
                            <div class="feature-icon">
                                <i class="bi bi-house-door"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Visi</h4>
                                <p>{!! $data['visi'] ?? '' !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="feature-box" data-aos="flip-up" data-aos-delay="450">
                            <div class="feature-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Misi</h4>
                                <p>{!! $data['misi'] ?? '' !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="metrics-section" data-aos="fade-up" data-aos-delay="400">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="metrics-wrapper">
                            <div class="row text-center">
                                <div class="col-lg-3 col-6">
                                    <div class="metric-item" data-aos="zoom-in" data-aos-delay="450">
                                        <div class="metric-icon">
                                            <i class="bi bi-trophy"></i>
                                        </div>
                                        <div class="metric-value">
                                            <span data-purecounter-start="0"
                                                data-purecounter-end="{{ $data['property_sold'] ?? 0 }}"
                                                data-purecounter-duration="2" class="purecounter"></span>+
                                        </div>
                                        <div class="metric-label">Properti Terjual</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="metric-item" data-aos="zoom-in" data-aos-delay="500">
                                        <div class="metric-icon">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="metric-value">
                                            <span data-purecounter-start="0"
                                                data-purecounter-end="{{ $data['happy_clients'] ?? 0 }}"
                                                data-purecounter-duration="2" class="purecounter"></span>+
                                        </div>
                                        <div class="metric-label">Klien Puas</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="metric-item" data-aos="zoom-in" data-aos-delay="550">
                                        <div class="metric-icon">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="metric-value">
                                            <span data-purecounter-start="0"
                                                data-purecounter-end="{{ $data['years_of_experience'] ?? 0 }}"
                                                data-purecounter-duration="2" class="purecounter"></span>
                                        </div>
                                        <div class="metric-label">Tahun Pengalaman</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="metric-item" data-aos="zoom-in" data-aos-delay="600">
                                        <div class="metric-icon">
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="metric-value">{{ $data['rating'] ?? 0 }}</div>
                                        <div class="metric-label">Rata-Rata Rating</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cta-section" data-aos="fade-up" data-aos-delay="500">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h3>Siap Menemukan Properti Impian Anda?</h3>
                        <p>Siapa yang tidak ingin memiliki rumah idaman tanpa harus menghadapi kerepotan? Temukan properti
                            terbaik yang sesuai dengan kebutuhan dan anggaran Anda bersama kami.</p>
                        <div class="action-buttons">
                            <a href="{{ 'kontak-kami' }}" class="btn btn-primary">Kontak Sekarang</a>
                            <a href="{{ 'properti' }}" class="btn btn-secondary">Lihat Properti</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
