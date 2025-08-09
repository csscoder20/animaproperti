@extends('frontend.layouts.app')
@section('content')
@section('title', $title)

<section id="blog-hero" class="blog-hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
            <div class="col-lg-8">
                @if ($featuredPosts->count())
                    @if ($featuredPosts->count() > 1)
                        <div id="featuredCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($featuredPosts as $key => $featured)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ $featured->gambar ? asset('storage/' . $featured->gambar) : asset('themes/frontend/assets/img/default.png') }}"
                                            class="d-block w-100 img-fluid" alt="{{ $featured->judul }}">

                                        <div
                                            class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-3 rounded">
                                            <div class="post-meta mb-2 text-light small">
                                                <i class="bi bi-calendar"></i>
                                                {{ $featured->created_at->format('d M Y') }}
                                                <i class="bi bi-person"></i> {{ $featured->user->name ?? 'Admin' }}
                                                <i class="bi bi-eye"></i> {{ number_format($featured->lihat) }}
                                            </div>
                                            <h5 class="post-title">
                                                <a href="{{ route('berita.detail', $featured->slug) }}"
                                                    class="text-white text-decoration-none">
                                                    {{ $featured->judul }}
                                                </a>
                                            </h5>
                                            <p class="post-excerpt">
                                                {{ Str::limit(strip_tags($featured->deskripsi), 120) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel"
                                data-bs-slide="prev">
                                <i class="bi bi-chevron-left fs-5 text-success"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel"
                                data-bs-slide="next">
                                <i class="bi bi-chevron-right fs-5 text-success"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @elseif ($featuredPosts->count() === 1)
                        @php $featured = $featuredPosts->first(); @endphp
                        <article class="featured-post position-relative mb-4" data-aos="fade-up">
                            <img src="{{ $featured->gambar ? asset('storage/' . $featured->gambar) : asset('themes/frontend/assets/img/default.png') }}"
                                alt="{{ $featured->judul }}" class="img-fluid">

                            <div class="post-overlay">
                                <div class="post-content">
                                    <div class="post-meta">
                                        <i class="bi bi-calendar"></i> <span
                                            class="date">{{ $featured->created_at->format('d M Y') }}</span>
                                        <i class="bi bi-person"></i> <a
                                            href="#">{{ $featured->user->name ?? 'Admin' }}</a>
                                        <i class="bi bi-eye"></i> {{ number_format($featured->lihat) }}
                                    </div>
                                    <h2 class="post-title">
                                        <a
                                            href="{{ route('berita.detail', $featured->slug) }}">{{ $featured->judul }}</a>
                                    </h2>
                                    <p class="post-excerpt">{{ Str::limit(strip_tags($featured->deskripsi), 120) }}</p>
                                </div>
                            </div>
                        </article>
                    @endif

                    <div class="row g-4">
                        @foreach ($posts as $item)
                            <div class="col-md-6">
                                <article class="secondary-post" data-aos="fade-up">
                                    <div class="post-image">
                                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('themes/frontend/assets/img/default.png') }}"
                                            alt="{{ $item->judul }}" class="img-fluid">
                                    </div>
                                    <div class="post-content">
                                        <div class="post-meta gap-3">
                                            <span><i class="bi bi-calendar"></i>
                                                {{ $item->created_at->format('d M Y') }}</span>
                                            <span><i class="bi bi-person"></i>{{ $item->user->name ?? 'Admin' }}</span>
                                            <span><i class="bi bi-eye"></i> {{ number_format($item->lihat) }}</span>
                                        </div>
                                        <h3 class="post-title">
                                            <a
                                                href="{{ route('berita.detail', $item->slug) }}">{{ $item->judul }}</a>
                                        </h3>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Tidak ada berita untuk ditampilkan.</p>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="news-tabs" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="bg-success border-0 text-light p-2">Berita Terbaru</h4>
                    @forelse ($latestBerita as $berita)
                        <article class="tab-post mb-1">
                            <div class="row g-0 align-items-center">
                                <div class="col-4">
                                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('themes/frontend/assets/img/default.png') }}"
                                        alt="{{ $berita->judul }}" class="img-fluid"
                                        style="object-fit: cover; width: 100%; height: 70px;">
                                </div>
                                <div class="col-8">
                                    <div class="post-content ps-2">
                                        <h4 class="post-title mb-1">
                                            <a href="{{ route('berita.detail', $berita->slug) }}">
                                                {{ Str::limit($berita->judul, 60) }}
                                            </a>
                                        </h4>
                                        <div class="post-author text-muted small">
                                            <span><i class="bi bi-calendar"></i>
                                                {{ $berita->created_at->format('d M Y') }}</span>
                                            <span><i
                                                    class="bi bi-person"></i>{{ $berita->user->name ?? 'Admin' }}</span>
                                            <span><i class="bi bi-eye"></i> {{ number_format($berita->lihat) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="text-muted">Tidak ada berita terbaru.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <section id="pagination-2" class="pagination-2 section">
            <div class="container">
                <nav class="d-flex justify-content-start" aria-label="Page navigation">
                    <ul>
                        @if ($posts->onFirstPage())
                            <li class="disabled">
                                <span aria-hidden="true"><i class="bi bi-arrow-left"></i> <span
                                        class="d-none d-sm-inline">Previous</span></span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $posts->previousPageUrl() }}" aria-label="Previous page">
                                    <i class="bi bi-arrow-left"></i>
                                    <span class="d-none d-sm-inline">Previous</span>
                                </a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $posts->lastPage(); $i++)
                            @if ($i == $posts->currentPage())
                                <li><a class="active" href="#">{{ $i }}</a></li>
                            @else
                                <li><a href="{{ $posts->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor

                        @if ($posts->hasMorePages())
                            <li>
                                <a href="{{ $posts->nextPageUrl() }}" aria-label="Next page">
                                    <span class="d-none d-sm-inline">Next</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="disabled">
                                <span aria-hidden="true"><span class="d-none d-sm-inline">Next</span> <i
                                        class="bi bi-arrow-right"></i></span>
                            </li>
                        @endif
                    </ul>

                </nav>
            </div>

        </section>

    </div>
</section>
@endsection
