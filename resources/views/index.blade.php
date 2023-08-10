<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/app_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Hadir</title>
</head>
<body>
    <div class="page">
        <nav>
            <div class="nav-line"></div>
            <div class="nav-label">
                Daftar Hadir
            </div>
            <div class="nav-link">
                <a href="">Beranda</a>
                <a href="">Konsep</a>
                <a href="">Fitur</a>
                <a href="">Harga</a>
                <a href="">Testimoni</a>
            </div>
            <div class="nav-extension">
                <div class="btn">
                    Masuk
                </div>
                <div class="btn on extra-btn">
                    <i class="fa-solid fa-phone"></i>
                    Hubungi Sales
                </div>
            </div>
        </nav>
        <div class="banner">
            <div class="background-layer"></div>
            <div class="main-layer">
                <div class="banner-desc">
                    <h5>Aplikasi Presensi Segudang Fitur</h5>
                    <p>Daftar Hadir merupakan aplikasi presensi berbasis website yang terintegrasi dengan berbagai integrasi fitur seperti Whatsapp API hingga paket aplikasi mobile sebagai penunjang aplikasi website utama</p>
                    <div class="banner-list">
                        <div class="banner-list-content">
                            <div class="check">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="info">Berbasis website yang ringan dan memiliki banyak fitur</div>
                        </div>
                        <div class="banner-list-content">
                            <div class="check">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="info">Pengaturan fitur hingga antarmuka yang sangat dinamis</div>
                        </div>
                        <div class="banner-list-content">
                            <div class="check">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="info">Mengurangi kesalahan input presensi manual</div>
                        </div>
                    </div>
                    <div class="btn big extra-btn">
                        Fitur lainnya
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </div>
                </div>
                <div class="banner-image">
                    <img src="{{ asset('assets/banner-landing.png') }}" draggable="false"/>
                </div>
                <svg class="layer-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#f3f4f5" fill-opacity="1" d="M0,0L48,16C96,32,192,64,288,74.7C384,85,480,75,576,96C672,117,768,171,864,170.7C960,171,1056,117,1152,106.7C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="page" style="z-index: 100; background: linear-gradient(to bottom, #f3f4f5, rgb(255, 255, 255))">
        <div class="k-concept">Konsep</div>
        <div class="show-screen">
            <div class="concept-tagline">
                MULTI-<span style="color: rgba(255, 255, 255, .6)">PLATFORM</span>. MULTI-ROLE. <span style="color: rgba(255, 255, 255, .6)">SIMPLE TO USE</span>.
            </div>
            <div class="main-screen">
                <div class="screen-slide">
                    <i class="fa-solid fa-globe"></i>
                    <div class="slide-desc">
                        <h5>Berbasis Website</h5>
                        <p>Pengelolaan berbasis website dengan konfigurasi dinamis, cepat dan integrasi fitur yang luas. Semua pengelolaan admin dan basis data terkait presensi sepenuhnya berada dalam peranan website sehingga tercapai efisiensi penyimpanan.</p>
                    </div>
                </div>
                <div class="screen-slide">
                    <i class="fa-solid fa-layer-group"></i>
                    <div class="slide-desc">
                        <h5>Kontrol Data Berlapis</h5>
                        <p>Aplikasi ini menggunakan sistem multi-peran pengelola dan atasan. Setiap perubahan data oleh pengelola akan memerlukan persetujuan atasan, dan setiap perubahan yang terjadi dapat dilacak dalam beberapa lapisan permanen dan sementara.</p>
                    </div>
                </div>
                <div class="screen-slide">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <div class="slide-desc">
                        <h5>Aplikasi Mobile</h5>
                        <p>Aplikasi mobile sebagai aplikasi utama bagi pengguna untuk berinteraksi dengan statistik, data, dan pengelola aplikasi.</p>
                    </div>
                </div>
                <div class="screen-slide">
                    <i class="fa-solid fa-fingerprint"></i>
                    <div class="slide-desc">
                        <h5>Perangkat Fingerprint</h5>
                        <p>Perangkat fingerprint sebagai alat input presensi utama dalam sistem dengan keunggulan kemudahan konfigurasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <header class="feature-header">
            <h5>Fitur Unggulan</h5>
            <p>Beberapa fitur unggulan dan integrasi yang termasuk dalam aplikasi ini</p>
        </header>
        <div class="feature-container">
            <div class="feature-box">
                <i class="fa-solid fa-users-gear"></i>
                <h5>Multi-level Admin</h5>
                <p>Aplikasi ini menggunakan konsep pengelolaan data dengan beberapa tingkatan admin dengan aksesibilitas yang berbeda.</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-code-branch"></i>
                <h5>Multi-Platform</h5>
                <p>Aplikasi ini menyediakan platform website sebagai sistem pengelola data dan aplikasi mobile sebagai penunjang aplikasi bagi pengguna.</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-file-circle-check"></i>
                <h5>Sistem Approval Data</h5>
                <p>Mengutamakan keamanan dan terstruktur nya setiap pengelolaan data dengan sistem persetujuan pengelolaan data dari pengelola oleh atasan.</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-gears"></i>
                <h5>Konfigurasi Dinamis</h5>
                <p>Demi pengalaman pengguna yang optimal, aplikasi ini dibekali dengan konfigurasi yang dinamis bagi pengguna.</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-boxes-stacked"></i>
                <h5>Penyimpanan Terstruktur</h5>
                <p>Setiap data presensi yang dikelola, disimpan dengan sistem master data dan rekap berupa laporan</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <h5>Pelacak Aktivitas</h5>
                <p>Setiap aktivitas yang dilakukan pengelola atau atasan, terpantau dalam 2 sistem pelacakan (Change Log dan Approval)</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-user-gear"></i>
                <h5>Data Pegawai yang Lengkap</h5>
                <p>Menyediakan pengelolaan data pegawai hingga dalam pengelolaan gaji dan cuti</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-business-time"></i>
                <h5>Lembur dan Gaji</h5>
                <p>Menyediakan fitur optional yang dapat mengelola perubahan pendapatan pegawai berdasarkan aktivitas lembur</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-clipboard-list"></i>
                <h5>Shift & Non-Shift</h5>
                <p>2 Jenis jadwal kerja yang dapat dikelola dengan sangat dinamis oleh pengguna</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-ranking-star"></i>
                <h5>Berbagai Statistik</h5>
                <p>Memiliki lebih dari 3 bentuk implementasi data dalam grafik atau statistik</p>
            </div>
            <div class="feature-box">
                <i class="fa-solid fa-comments"></i>
                <h5>Integrasi Live-Chat</h5>
                <p>Memiliki integrasi Live-Chat dengan fitur chat yang sangat lengkap untuk penunjang keterhubungan pengelola dan pengguna aplikasi mobile</p>
            </div>
            <svg class="feature-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f3f4f5" fill-opacity="1" d="M0,0L48,16C96,32,192,64,288,74.7C384,85,480,75,576,96C672,117,768,171,864,170.7C960,171,1056,117,1152,106.7C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    <div class="page price-page" style="background: linear-gradient(to bottom, #f3f4f5, rgb(255, 255, 255))">
        <div class="price-pop-up"></div>
    </div>
</body>
</html>