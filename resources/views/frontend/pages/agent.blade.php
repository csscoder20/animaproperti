@extends('frontend.layouts.app')
@section('content')
@section('title', $title)

<section id="agents" class="agents section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            @forelse ($agens as $agen)
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="agent-card">
                        <div class="agent-image">
                            @if ($agen->pas_foto)
                                <img src="{{ asset('storage/' . $agen->pas_foto) }}" alt="{{ $agen->nama_lengkap }}"
                                    class="img-fluid">
                            @else
                                <div class="no-image-icon d-flex justify-content-center align-items-center"
                                    style="height: 200px; background-color: #f0f0f0;">
                                    <i class="bi bi-person-badge" style="font-size: 4rem; color: #999;"></i>
                                </div>
                            @endif

                            <div class="badge-overlay">
                                <span class="top-seller-badge"><i class="bi bi-patch-check-fill"></i> Verified</span>
                            </div>
                        </div>

                        <div class="agent-info">
                            <h4>{{ $agen->nama_lengkap }}</h4>
                            <span class="role">{{ $agen->company_name ?? 'Agen Properti' }}</span>
                            @php
                                $socialMap = [
                                    'instagram' => 'instagram',
                                    'facebook' => 'facebook',
                                    'twitter' => 'twitter-x',
                                    'tiktok' => 'tiktok',
                                    'linkedin' => 'linkedin',
                                    'youtube' => 'youtube',
                                    'whatsapp' => 'whatsapp',
                                ];

                                $socialBaseUrls = [
                                    'instagram' => 'https://instagram.com/',
                                    'facebook' => 'https://facebook.com/',
                                    'twitter' => 'https://twitter.com/',
                                    'tiktok' => 'https://tiktok.com/@',
                                    'linkedin' => 'https://linkedin.com/in/',
                                    'youtube' => 'https://youtube.com/',
                                    'whatsapp' => 'https://wa.me/',
                                ];

                                $socialType = strtolower($agen->social_media);
                                $icon = $socialMap[$socialType] ?? 'question-circle';
                                $socialUrl =
                                    isset($socialBaseUrls[$socialType]) && $agen->social_media_id
                                        ? $socialBaseUrls[$socialType] . ltrim($agen->social_media_id, '@')
                                        : null;
                            @endphp

                            <div class="contact-links">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agen->no_hp) }}"
                                    target="_blank">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="mailto:{{ $agen->email }}"><i class="bi bi-envelope"></i></a>
                                @if ($socialUrl)
                                    <a href="{{ $socialUrl }}" target="_blank">
                                        <i class="bi bi-{{ $icon }}"></i>
                                    </a>
                                @endif
                            </div>

                            <a href="{{ route('agen.show', $agen->id) }}" class="view-listings-btn">
                                Detail Agen
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Belum ada data agen untuk ditampilkan.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

@endsection
