@extends('frontend.layouts.app')
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@section('content')
@section('title', $title)
<style>
    div#smartwizard {
        border: 2px solid #ecf0f6;
        padding: 10px;
    }

    .btnKirimLaporan {
        display: none;
    }
</style>
<section id="agent-profile" class="agent-profile section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="hero-content text-center" data-aos="zoom-in" data-aos-delay="200">
                    <h2 class="fw-bold text-info">Form Registrasi Agen Properti</h2>
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
            <div id="smartwizard">
                <ul class="nav nav-progress">
                    <li class="nav-item">
                        <a class="nav-link" href="#step-1">
                            <div class="num">1</div>
                            Identitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-2">
                            <span class="num">2</span>
                            Alamat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-3">
                            <span class="num">3</span>
                            Pendidikan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#step-4">
                            <span class="num">4</span>
                            Pekerjaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#step-5">
                            <span class="num">5</span>
                            Dokumen
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        <div class="row">
                            <div class="col-lg-4 mt-4">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="nama_lengkap" required>
                            </div>

                            <div class="col-lg-4 mt-4">
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
                            <div class="col-lg-4 mt-4">
                                <label for="birthCity" class="form-label">Kota Kelahiran<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="birthCity" name="birth_city" required>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="birthDate" class="form-label">Tanggal Lahir<sup
                                        class="text-danger">*</sup></label>
                                <input type="date" class="form-control" id="birthDate" name="birth_date" required>
                            </div>

                            <div class="col-lg-4 mt-4">
                                <label for="phone" class="form-label">Nomor HP/WA<sup
                                        class="text-danger">*</sup></label>
                                <input type="tel" class="form-control" id="phone" name="no_hp" required>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="email" class="form-label">Email<sup
                                        class="text-danger">*</sup></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-lg-4 mt-4">
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

                            <div class="col-lg-4 mt-4 d-none" id="socialIdGroup">
                                <label for="socialId" class="form-label">ID Medsos<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="socialId" name="social_media_id"
                                    placeholder="Masukkan username/ID diwali @" value="@" required>
                            </div>
                        </div>
                    </div>

                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <label for="alamat" class="form-label">Alamat Lengkap<sup
                                        class="text-danger">*</sup></label>
                                <textarea class="form-control" id="alamat" name="alamat_lengkap" rows="3" required></textarea>
                            </div>

                            <div class="col-lg-4 mt-4">
                                <label for="zip" class="form-label">Kode Pos<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="zip" name="kode_pos" required>
                            </div>
                        </div>

                    </div>

                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                        <div class="row">
                            <div class="col-lg-4 mt-4">
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
                            <div class="col-lg-4 mt-4">
                                <label for="namaSekolah" class="form-label">Nama Sekolah/Instansi<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="namaSekolah" name="nama_sekolah"
                                    required>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="tahunLulus" class="form-label">Tahun Lulus<sup
                                        class="text-danger">*</sup></label>
                                <select class="form-select" id="tahunLulus" name="tahun_lulus" required>
                                    <option value="">-- Pilih Tahun Keluar --</option>
                                    @for ($i = now()->year; $i >= 1970; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="nilai_ipk" class="form-label">Nilai<sup
                                        class="text-danger">*</sup></label>
                                <input type="number" step="0.01" min="0" max="100"
                                    class="form-control" id="nilai_ipk" name="nilai_ipk" required>
                            </div>

                            <div class="col-lg-4 mt-4">
                                <label for="fileSertifikat" class="form-label">Upload Sertifikat (opsional)</label>
                                <input type="file" class="form-control" id="fileSertifikat"
                                    accept=".pdf,.jpg,.jpeg,.png" name="sertifikat_kompetensi">
                            </div>
                        </div>
                    </div>

                    <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                        <div class="row">
                            <div class="col-lg-4 mt-4">
                                <label for="namaPerusahaan" class="form-label">Nama Perusahaan<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="namaPerusahaan"
                                    name="nama_perusahaan" required>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="tahunmasuk" class="form-label">Tahun Masuk<sup
                                        class="text-danger">*</sup></label>
                                <select class="form-select" id="tahunmasuk" name="tahun_masuk" required>
                                    <option value="">-- Pilih Tahun Masuk --</option>
                                    @for ($i = now()->year; $i >= 1970; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="tahunkeluar" class="form-label">Tahun Keluar<sup
                                        class="text-danger">*</sup></label>
                                <select class="form-select" id="tahunkeluar" name="tahun_keluar" required>
                                    <option value="">-- Pilih Tahun Keluar --</option>
                                    @for ($i = now()->year; $i >= 1970; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <label for="alasankeluar" class="form-label">Alasan Keluar<sup
                                        class="text-danger">*</sup></label>
                                <textarea type="text" class="form-control" id="alasankeluar" name="alasan_keluar" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                        <div class="row">
                            <div class="col-lg-4 mt-4">
                                <label for="foto" class="form-label">Pas Foto<sup
                                        class="text-danger">*</sup></label>
                                <input type="file" class="form-control" id="foto" accept="image/*"
                                    class="text-danger" name="pas_foto" required>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="ktp" class="form-label">KTP<sup class="text-danger">*</sup></label>
                                <input type="file" class="form-control" id="ktp" accept="image/*"
                                    name="ktp" required>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <label for="cv" class="form-label">CV<sup class="text-danger">*</sup></label>
                                <input type="file" class="form-control" id="cv" accept="image/*"
                                    name="cv" required>
                            </div>

                            <div class="col-lg-4 mt-4">
                                <label for="kartu_nama" class="form-label">Kartu Nama (Opsional)</label>
                                <input type="file" class="form-control" id="kartu_nama" name="kartu_nama"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-4">
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
                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-3">
            <p>
                <sup class="text-danger">*</sup> = Wajib diisi
            </p>
        </div>
    </div>
</section>

@endsection

<script>
    $(document).ready(function() {
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            autoAdjustHeight: true,
            enableUrlHash: false,
            transition: {
                animation: 'fade'
            },
            toolbar: {
                showNextButton: true,
                showPreviousButton: true,
                extraHtml: `<button type="submit" class="btn btn-success btnKirimLaporan" onclick="onFinish()">Kirim Lamaran</button>`
            },
            anchor: {
                enableNavigation: true,
                enableNavigationAlways: false,
                enableDoneState: true,
                markPreviousStepsAsDone: true,
                unDoneOnBackNavigation: false,
                enableDoneStateNavigation: true
            },
            keyboard: {
                keyNavigation: false,
            },
            lang: {
                next: 'Selanjutnya',
                previous: 'Sebelumnya'
            }
        });


        // Tampilkan kolom ID Medsos saat dropdown dipilih
        $('#socialMedia').on('change', function() {
            const selected = $(this).val();
            if (selected) {
                $('#socialIdGroup').removeClass('d-none');
            } else {
                $('#socialIdGroup').addClass('d-none');
                $('#socialId').val('');
            }
        });

        $('#smartwizard').on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            const totalSteps = $('#smartwizard ul.nav .nav-item').length;

            if (stepIndex === totalSteps - 1) {
                // Di step terakhir
                $('.sw-btn-next').hide(); // sembunyikan tombol Next
                $('.btnKirimLaporan').show(); // tampilkan tombol Kirim Lamaran
            } else {
                $('.sw-btn-next').show(); // tampilkan tombol Next
                $('.btnKirimLaporan').hide(); // sembunyikan tombol Kirim Lamaran
            }
        });


        // Validasi form saat pindah step (versi SmartWizard 6)
        $('#smartwizard').on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex,
            stepDirection) {
            if (stepDirection === 'forward') {
                let currentStep = $('.tab-pane').eq(currentStepIndex);
                let inputs = currentStep.find('input, select, textarea');
                let isValid = true;

                inputs.each(function() {
                    if (!this.checkValidity()) {
                        this.reportValidity();
                        isValid = false;
                        return false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            }
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek elemen social_media_id sebelum pasang event listener
        const smInput = document.getElementById('social_media_id');
        if (smInput) {
            smInput.addEventListener('blur', function() {
                if (this.value && !this.value.startsWith('@')) {
                    this.value = '@' + this.value;
                }
            });
        }

        // Elemen-elemen wilayah
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        // Jika semua elemen ada, pasang event listener
        if (provinsiSelect && kabupatenSelect && kecamatanSelect && kelurahanSelect) {
            function resetSelect(select, placeholder = '-- Pilih --') {
                select.innerHTML = `<option value="">${placeholder}</option>`;
            }

            function loadWilayah(kodeInduk, targetSelect, placeholder) {
                resetSelect(targetSelect, 'Memuat...');
                fetch(`/api/wilayah/${kodeInduk}`)
                    .then(res => res.json())
                    .then(data => {
                        resetSelect(targetSelect, placeholder);
                        data.forEach(item => {
                            const opt = document.createElement('option');
                            opt.value = item.kode;
                            opt.textContent = item.nama;
                            targetSelect.appendChild(opt);
                        });
                    })
                    .catch(err => {
                        resetSelect(targetSelect, 'Gagal memuat');
                        console.error(err);
                    });
            }

            provinsiSelect.addEventListener('change', function() {
                const kode = this.value;
                if (kode) {
                    loadWilayah(kode, kabupatenSelect, '-- Pilih Kabupaten --');
                } else {
                    resetSelect(kabupatenSelect, '-- Pilih Kabupaten --');
                }
                resetSelect(kecamatanSelect, '-- Pilih Kecamatan --');
                resetSelect(kelurahanSelect, '-- Pilih Kelurahan --');
            });

            kabupatenSelect.addEventListener('change', function() {
                const kode = this.value;
                if (kode) {
                    loadWilayah(kode, kecamatanSelect, '-- Pilih Kecamatan --');
                } else {
                    resetSelect(kecamatanSelect, '-- Pilih Kecamatan --');
                }
                resetSelect(kelurahanSelect, '-- Pilih Kelurahan --');
            });

            kecamatanSelect.addEventListener('change', function() {
                const kode = this.value;
                if (kode) {
                    loadWilayah(kode, kelurahanSelect, '-- Pilih Kelurahan --');
                } else {
                    resetSelect(kelurahanSelect, '-- Pilih Kelurahan --');
                }
            });
        }
    });
</script>
