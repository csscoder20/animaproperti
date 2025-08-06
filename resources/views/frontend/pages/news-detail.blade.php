@extends('frontend.layouts.app')
{{-- <style>
    i.bi {
        margin-left: 17px;
    }
</style> --}}
@section('content')
@section('title', $title)

<section id="blog-hero" class="blog-hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
            <div class="col-lg-8">
                <img src="{{ $data->gambar ? asset('storage/' . $data->gambar) : asset('themes/frontend/assets/img/default.png') }}"
                    class="d-block w-100 img-fluid" alt="{{ $data->judul }}">
                <h2 class="my-3">{{ $data->judul }}</h2>
                <p class="text-muted">
                    <span><i class="bi bi-calendar"></i>
                        {{ $data->created_at->format('d M Y') }}</span>
                    <span><i class="bi bi-person"></i>{{ $data->user->name ?? 'Admin' }}</span>
                    <span><i class="bi bi-eye"></i> {{ number_format($data->lihat) }}</span>
                </p>
                <div>{!! $data->deskripsi !!}</div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-box">
                    <h4 class="bg-success border-0 text-light p-2 mb-4">Berita Lainnya</h4>
                    @foreach ($otherPosts as $post)
                        <div class="mb-3 d-flex">
                            <img src="{{ $post->gambar ? asset('storage/' . $post->gambar) : asset('themes/frontend/assets/img/default.png') }}"
                                alt="{{ $post->judul }}" class="me-3 rounded"
                                style="width: 80px; height: 60px; object-fit: cover;">
                            <div>
                                <a href="{{ route('berita.detail', $post->slug) }}"
                                    class="fw-bold text-dark">{{ \Illuminate\Support\Str::limit($post->judul, 20) }}</a>
                                <p class="text-small">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->deskripsi), 30) }}</p>
                                <p class="text-muted small mb-0">
                                    <span><i class="bi bi-calendar"></i>
                                        {{ $post->created_at->format('d M Y') }}</span>
                                    <span><i class="bi bi-person"></i>{{ $post->user->name ?? 'Admin' }}</span>
                                    <span><i class="bi bi-eye"></i> {{ number_format($post->lihat) }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
