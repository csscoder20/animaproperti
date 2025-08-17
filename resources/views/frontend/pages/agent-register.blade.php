@extends('frontend.layouts.app')
@section('content')
@section('title', $title)
<section id="agent-profile" class="agent-profile section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="hero-content text-center" data-aos="zoom-in" data-aos-delay="200">
                    <h2 class="fw-bold text-info mb-4">Registrasi Agen Properti</h2>
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Selamat Datang!</h4>
                        <p>Ini adalah halaman resmi rekrutmen Anima Karya Properti Makassar.
                            Kami mengundang Anda yang memiliki semangat tinggi, komunikasi yang baik, serta minat dalam
                            dunia penjualan dan properti untuk bergabung bersama tim kami sebagai Agen Properti. Sebagai
                            agen properti, Anda akan berperan penting dalam membantu klien dalam proses jual, beli, dan
                            sewa
                            properti, serta menjadi perwakilan profesional dari brand kami di lapangan. Silakan isi
                            formulir
                            lamaran di bawah ini dengan lengkap dan benar. Pastikan Anda melampirkan CV dan dokumen
                            pendukung yang diperlukan.</p>

                        <a href="{{ '/formulir-registrasi-agen' }}" class="btn btn-success">Registrasi Sekarang!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
