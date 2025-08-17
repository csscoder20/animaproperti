@extends('frontend.layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@section('content')
@section('title', $title)
<section id="agent-profile" class="agent-profile section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="hero-content text-center" data-aos="zoom-in" data-aos-delay="200">
                    <h2 class="fw-bold text-info mb-4">Formulir Registrasi Agen Properti</h2>
                    <div class="alert alert-info" role="alert">
                        <p>Silakan lengkapi data yang diminta di bawah dengan data yang benar.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="form-agen" method="POST" action="{{ route('agen.submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h6 class="fw-bold">Data Diri</h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mt-2">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="nama_lengkap" required>
                            </div>

                            <div class="col-lg-4 mt-3">
                                <label class="form-label d-block">Jenis Kelamin<sup class="text-danger">*</sup></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                        value="Laki-laki" required>
                                    <label class="form-check-label" for="male">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="Perempuan">
                                    <label class="form-check-label" for="female">Perempuan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3">
                                <label for="birthCity" class="form-label">Kota Kelahiran<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="birthCity" name="birth_city" required>
                            </div>
                            <div class="col-lg-4 mt-3">
                                <label for="birthDate" class="form-label">Tanggal Lahir<sup
                                        class="text-danger">*</sup></label>
                                <input type="date" class="form-control" id="birthDate" name="birth_date" required>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h6 class="fw-bold">Informasi Kontak</h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mt-3">
                                <label for="phone" class="form-label">Nomor HP/WA<sup
                                        class="text-danger">*</sup></label>
                                <input type="tel" class="form-control" id="phone" name="no_hp" required>
                            </div>
                            <div class="col-lg-4 mt-3">
                                <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-lg-4 mt-3">
                                <label for="socialMedia" class="form-label">Media Sosial<sup
                                        class="text-danger">*</sup></label>
                                <select class="form-select" id="socialMedia" name="social_media" required>
                                    <option value="">-- Pilih Media Sosial --</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="twitter">Twitter</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="linkedin">LinkedIn</option>
                                    <option value="tiktok">TikTok</option>
                                </select>
                            </div>

                            <div class="col-lg-4 mt-3 d-none" id="socialIdGroup">
                                <label for="socialId" class="form-label">ID Medsos<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="socialId" name="social_media_id"
                                    placeholder="Masukkan username/ID diwali @" value="@" required>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h6 class="fw-bold">Alamat Tinggal</h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 mt-3">
                                <label for="alamat" class="form-label">Alamat Lengkap<sup
                                        class="text-danger">*</sup></label>
                                <input class="form-control" id="alamat" name="alamat_lengkap" required>
                            </div>

                            <div class="col-lg-4 mt-3">
                                <label for="zip" class="form-label">Kode Pos<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="zip" name="kode_pos" required>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h6 class="fw-bold">Riwayat Pendidikan</h6>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-4 mt-3">
                                    <label for="pendidikan" class="form-label">Pendidikan Terakhir<sup
                                            class="text-danger">*</sup></label>
                                    <select class="form-select" id="pendidikan" name="pendidikan" required>
                                        <option selected value="">Pilih...</option>
                                        <option>SMA</option>
                                        <option>Diploma</option>
                                        <option>Sarjana</option>
                                        <option>Magister</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label for="namaSekolah" class="form-label">Nama Sekolah/Instansi<sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="namaSekolah" name="nama_sekolah"
                                        required>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label for="tahunLulus" class="form-label">Tahun Lulus<sup
                                            class="text-danger">*</sup></label>
                                    <select class="form-select" id="tahunLulus" name="tahun_lulus" required>
                                        <option value="">-- Pilih Tahun Keluar --</option>
                                        @for ($i = now()->year; $i >= 1970; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label for="nilai_ipk" class="form-label">Nilai<sup
                                            class="text-danger">*</sup></label>
                                    <input type="number" step="0.01" min="0" max="100"
                                        class="form-control" id="nilai_ipk" name="nilai_ipk" required>
                                </div>

                                <div class="col-lg-4 mt-3">
                                    <label for="fileSertifikat" class="form-label">Upload Sertifikat
                                        (opsional)</label>
                                    <input type="file" class="form-control" id="fileSertifikat"
                                        accept=".pdf,.jpg,.jpeg,.png" name="sertifikat_kompetensi">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h6 class="fw-bold">Pengalaman Kerja</h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <label for="namaPerusahaan" class="form-label">Nama Perusahaan<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="namaPerusahaan"
                                    name="nama_perusahaan" required>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label for="tahunmasuk" class="form-label">Tahun Masuk<sup
                                        class="text-danger">*</sup></label>
                                <select class="form-select" id="tahunmasuk" name="tahun_masuk" required>
                                    <option value="">-- Pilih Tahun Masuk --</option>
                                    @for ($i = now()->year; $i >= 1970; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                            <div class="col-lg-3 mt-3">
                                <label for="tahunkeluar" class="form-label">Tahun Keluar<sup
                                        class="text-danger">*</sup></label>
                                <select class="form-select" id="tahunkeluar" name="tahun_keluar" required>
                                    <option value="">-- Pilih Tahun Keluar --</option>
                                    @for ($i = now()->year; $i >= 1970; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label for="alasankeluar" class="form-label">Alasan Keluar<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="alasankeluar" name="alasan_keluar"
                                    required>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <h6 class="fw-bold">Dokumen</h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 mt-3">
                                <label for="foto" class="form-label">Pas Foto<sup
                                        class="text-danger">*</sup></label>
                                <input type="file" class="form-control" id="foto" accept="image/*"
                                    class="text-danger" name="pas_foto" required>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label for="ktp" class="form-label">KTP<sup class="text-danger">*</sup></label>
                                <input type="file" class="form-control" id="ktp" accept="image/*"
                                    name="ktp" required>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label for="cv" class="form-label">CV<sup class="text-danger">*</sup></label>
                                <input type="file" class="form-control" id="cv" accept="image/*"
                                    name="cv" required>
                            </div>

                            <div class="col-lg-3 mt-3">
                                <label for="kartu_nama" class="form-label">Kartu Nama (Opsional)</label>
                                <input type="file" class="form-control" id="kartu_nama" name="kartu_nama"
                                    accept="image/*">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="declaration"
                                        name="perjanjian" required>
                                    <label class="form-check-label" for="declaration">
                                        Saya menyatakan bahwa data yang saya isi adalah benar dan dapat
                                        dipertanggungjawabkan.<sup class="text-danger">*</sup>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 mt-3">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success btnKirimLaporan w-auto"
                                onclick="onFinish()">
                                Kirim Data
                            </button>
                        </div>

                        <div class="row mt-3">
                            <p>
                                <sup class="text-danger">*</sup> = Wajib diisi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const smInput = document.getElementById('social_media_id');
        if (smInput) {
            smInput.addEventListener('blur', function() {
                if (this.value && !this.value.startsWith('@')) {
                    this.value = '@' + this.value;
                }
            });
        }

        $('#socialMedia').on('change', function() {
            const selected = $(this).val();
            if (selected) {
                $('#socialIdGroup').removeClass('d-none');
            } else {
                $('#socialIdGroup').addClass('d-none');
                $('#socialId').val('');
            }
        });

    });
</script>
