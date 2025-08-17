@extends('frontend.layouts.app')

@section('title', $title)

@section('content')
    <section id="terms-of-service" class="terms-of-service section">
        <div class="container" data-aos="fade-up">
            <!-- Page Header -->
            <div class="tos-header text-center" data-aos="fade-up">
                <span class="last-updated">Last Updated: {{ $data->updated_at->format('F d, Y') }}</span>
                <h2>{{ $data->judul }}</h2>
            </div>

            <!-- Content -->
            <div class="tos-content" data-aos="fade-up" data-aos-delay="200">
                {!! $data->isi !!}
            </div>
        </div>
    </section>
@endsection
