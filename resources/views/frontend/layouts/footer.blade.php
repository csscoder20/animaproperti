    <footer id="footer" class="footer accent-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-12 footer-about">
                    <a href="{{ '/' }}" class="logo d-flex align-items-center">
                        <img class="rounded"
                            src="{{ $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('themes/frontend/assets/img/android-chrome-512x512.png') }}"
                            alt="Logo">
                        <span class="sitename">{{ $settings['site_name'] ?? 'ANIMA PROPERTI' }}</span>
                    </a>
                    <p>{{ $settings['site_description'] ?? '' }}</p>
                    <p class="mb-1">
                        <strong>Alamat:</strong>
                        <span>{{ $settings['address'] ?? 'Ruko Saphire No. 49 Jl. Mutiara Boulevard Bulurokeng - Makassar' }},
                            {{ $settings['postal_code'] ?? '90241' }}</span>
                    </p>
                    <p class="mb-1"><strong>Telepon:</strong>
                        <span>{{ $settings['phone'] ?? '+62 811-4617-733' }}</span>
                    </p>
                    <p class="mb-1"><strong>Email:</strong>
                        <span>{{ $settings['email'] ?? 'mayakesuma558@gmail.com' }}</span>
                    </p>

                    <div class="social-links d-flex mt-4">
                        <a href="{{ $settings['facebook'] ?? '#' }}" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $settings['instagram'] ?? '#' }}" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a href="{{ $settings['tiktok'] ?? '#' }}" target="_blank"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <div class="footer-links col-lg-6 footer-contact text-md-start">
                    <h4>Link Terkait</h4>
                    <ul>
                        <li>
                            <a href="{{ route('terms.show', ['kategori' => 'syarat-ketentuan']) ?? '#' }}">
                                Syarat dan Ketentuan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms.show', ['kategori' => 'kebijakan-privasi']) ?? '#' }}">
                                Kebijakan Privasi
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>{{ $settings['copyright'] ?? 'ANIMA PROPERTI' }}</p>
            <div class="credits">
                Designed by <a href="https://wicom.co.id/">{{ $settings['design_by'] ?? 'ANIMA PROPERTI' }}</a>
            </div>
        </div>

    </footer>
