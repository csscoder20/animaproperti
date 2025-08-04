    <footer id="footer" class="footer accent-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="{{ '/' }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('themes/frontend/assets/img/android-chrome-512x512.png') }}"
                            alt="Logo Website">
                        <span class="sitename">{{ $settings['site_name'] ?? 'ANIMA PROPERTI' }}</span>
                    </a>
                    <p>{{ $settings['site_description'] ?? '' }}</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="footer-links col-lg-3 col-md-6 col-sm-6 footer-contact text-center text-md-start">
                    <h4>Link Terkait</h4>
                    <ul>
                        <li><a href="#">Sarat dan Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="footer-links col-lg-3 col-md-6 col-sm-6 footer-contact text-center text-md-start">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="#">Penjualan</a></li>
                        <li><a href="#">Iklan</a></li>
                        <li><a href="#">Lelang</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Kontak Kami</h4>
                    <p>{{ $settings['address'] ?? 'Ruko Saphire No. 49 Jl. Mutiara Boulevard Bulurokeng - Makassar' }},
                        {{ $settings['postal_code'] ?? '90241' }}</p>
                    <p><strong>Phone:</strong> <span>{{ $settings['phone'] ?? '+62 811-4617-733' }}</span></p>
                    <p><strong>Email:</strong> <span>{{ $settings['email'] ?? 'mayakesuma558@gmail.com' }}</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $settings['site_name'] ?? 'ANIMA PROPERTI' }} |
                </strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://wicom.co.id/">Wicom Computer</a>
            </div>
        </div>

    </footer>
