<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/app_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Daftar Hadir</title>
    @livewireStyles
</head>
@php
    $theme = Auth::user()->dashboardUi[0]->theme;
    $blob = Auth::user()->dashboardUi[0]->blob;
    $shadow = Auth::user()->dashboardUi[0]->shadow;
    $filter = Auth::user()->dashboardUi[0]->filter;
    $transition = Auth::user()->dashboardUi[0]->transition;
@endphp
<body class="{{ $theme }} @if($blob == false){{ 'no-blob' }}@endif @if($shadow == false){{ 'no-shadow' }}@endif @if($filter == false){{ 'no-filter' }}@endif @if($transition == false){{ 'no-transition' }}@endif">
    <div class="page db-page">
        <header class="db-header">
            <div class="db-header-label">
                <i class="fa-solid fa-user-tie"></i>
                <h5>Daftar Hadir</h5>
            </div>
            <div class="db-header-content">
                <div class="page-info">
                    <h5>{{ $page }}</h5>
                    <p>{{ $pageDesc }}</p>
                </div>
                <div class="page-search">
                    <input id="search-page" type="text" placeholder="Cari menu laman disini" autocomplete="off">
                    <button class="btn on btn-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="related-search">
                        <a href="" class="related-row">
                            <p class="related-title">Page Manager <span>/ Page Design</span></p>
                            <p>Desain laman aplikasi presensi mobile disini</p>
                        </a>
                        <a href="" class="related-row">
                            <p class="related-title">Page Manager <span>/ Page Content</span></p>
                            <p>Kelola fitur dan konten pada aplikasi mobile</p>
                        </a>
                        <a href="" class="related-row">
                            <p class="related-title">Page Manager <span>/ Page Analytic</span></p>
                            <p>Analisa fitur aplikasi apa yang paling berguna</p>
                        </a>
                        <a href="/dashboard" class="related-row">
                            <p class="related-title">Dashboard <span>/ Statistic</span></p>
                            <p>Lihat rekap statistik data presensi dalam chart</p>
                        </a>
                        <a href="/dashboard/presensi" class="related-row">
                            <p class="related-title">Dashboard <span>/ Presensi Harian</span></p>
                            <p>Lihat rekap laporan presensi harian disini</p>
                        </a>
                        <a href="/dashboard/izin" class="related-row">
                            <p class="related-title">Dashboard <span>/ Izin Harian</span></p>
                            <p>Lihat rekap laporan izin harian disini</p>
                        </a>
                        <a href="/dashboard/aktivitas" class="related-row">
                            <p class="related-title">Dashboard <span>/ Aktivitas Harian</span></p>
                            <p>Lihat rekap laporan aktivitas harian disini</p>
                        </a>
                        <a href="/dashboard/lembur" class="related-row">
                            <p class="related-title">Dashboard <span>/ Lembur Harian</span></p>
                            <p>Lihat rekap laporan lembur harian disini</p>
                        </a>
                        <a href="/dashboard/chat-pegawai" class="related-row">
                            <p class="related-title">Dashboard <span>/ Chat Pegawai</span></p>
                            <p>Lihat chat dari pegawai disini</p>
                        </a>
                        @can('observer')
                            <a href="/dashboard/pengajuan-perubahan/presensi" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Presensi</span></p>
                                <p>Lihat pengajuan presensi manual dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/izin-presensi" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Izin</span></p>
                                <p>Lihat pengajuan Izin Harian dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/aktivitas-pegawai" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Aktivitas</span></p>
                                <p>Lihat pengajuan aktivitas Harian dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/lembur" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Lembur</span></p>
                                <p>Lihat pengajuan lembur Harian dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/data-departemen" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Data Departemen</span></p>
                                <p>Lihat pengajuan perubahan data departemen dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/data-jabatan" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Data Jabatan</span></p>
                                <p>Lihat pengajuan perubahan data jabatan dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/data-pegawai" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Data Pegawai</span></p>
                                <p>Lihat pengajuan perubahan data pegawai dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/data-admin" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Data Admin</span></p>
                                <p>Lihat pengajuan perubahan data admin dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/data-aktivitas" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Data Aktivitas</span></p>
                                <p>Lihat pengajuan perubahan data aktivitas dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/jadwal" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Jadwal Kerja</span></p>
                                <p>Lihat pengajuan perubahan data jadwal kerja dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/libur-nasional" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Libur Nasional</span></p>
                                <p>Lihat pengajuan perubahan data libur nasional dari pengelola disini</p>
                            </a>
                            <a href="/dashboard/pengajuan-perubahan/libur-khusus" class="related-row">
                                <p class="related-title">Pengajuan <span>/ Libur Khusus</span></p>
                                <p>Lihat pengajuan perubahan data libur khusus dari pengelola disini</p>
                            </a>
                        @endcan
                        @can('highOfficer')
                            <a href="/dashboard/master/departemen" class="related-row">                            
                                <p class="related-title">Master Data <span>/ Master Departement</span></p>
                                <p>Kelola semua Departement atau bagian kerja yang ada di perusahaanmu</p>
                            </a>
                        @endcan
                        <a href="/dashboard/master/jabatan" class="related-row">
                            <p class="related-title">Master Data <span>/ Master Pegawai / Master Jabatan</span></p>
                            <p>Kelola jenis jabatan bagi pegawai terdaftar</p>
                        </a>
                        <a href="/dashboard/master/pegawai" class="related-row">
                            <p class="related-title">Master Data <span>/ Master Pegawai / Master Pegawai</span></p>
                            <p>Kelola data lengkap pegawai perusahaanmu</p>
                        </a>
                        @can('highOfficer')
                            <a href="/dashboard/master/admin" class="related-row">
                                <p class="related-title">Master Data <span>/ Master Pegawai / Master Admin</span></p>
                                <p>Kelola pengelola dan admin dari sistem presensi ini</p>
                            </a>
                        @endcan
                        @can('manager')
                        <a href="/dashboard/master/aktivitas" class="related-row">
                            <p class="related-title">Master Data <span>/ Master Aktivitas</span></p>
                            <p>Kelola jenis aktivitas umum yang ada di perusahaanmu</p>
                        </a>
                        @endcan
                        @if (Auth::user()->instansi->type_jadwal == 'Semua' || Auth::user()->instansi->type_jadwal == 'Non Shift')
                            <a href="/dashboard/master/jadwal-non-shift" class="related-row">
                                <p class="related-title">Master Data <span>/ Master Jadwal / Jadwal Non-Shift</span></p>
                                <p>Kelola jadwal dan jam kerja non-shift untuk pegawaimu</p>
                            </a>
                        @endif
                        @if (Auth::user()->instansi->type_jadwal == 'Semua' || Auth::user()->instansi->type_jadwal == 'Shift')
                            <a href="/dashboard/master/jadwal-shift" class="related-row">
                                <p class="related-title">Master Data <span>/ Master Jadwal / Jadwal Shift</span></p>
                                <p>Kelola jadwal dan jam kerja shifting untuk pegawaimu</p>
                            </a>
                        @endif
                        @can('highOfficer')
                            <a href="/dashboard/master/libur-nasional" class="related-row">
                                <p class="related-title">Master Data <span>/ Master Jadwal / Libur Nasional</span></p>
                                <p>Kelola jadwal libur Nasional dalam jam kerja perusahaanmu</p>
                            </a>
                        @endcan
                        <a href="/dashboard/master/libur-khusus" class="related-row">
                            <p class="related-title">Master Data <span>/ Master Jadwal / Libur Khusus</span></p>
                            <p>Kelola sendiri jadwal libur yang ditentukan oleh perusahaanmu</p>
                        </a>
                        @can('highOfficer')
                            <a href="/dashboard/master/izin" class="related-row">
                                <p class="related-title">Master Data <span>/ Master Izin</span></p>
                                <p>Kelola jenis perizinan dalam sistem presensi</p>
                            </a>
                        @endcan
                        <a href="/dashboard/laporan/presensi" class="related-row">
                            <p class="related-title">Laporan <span>/ Laporan Presensi</span></p>
                            <p>Lihat rekap laporan bulanan dari data presensi</p>
                        </a>
                        <a href="/dashboard/laporan/aktivitas" class="related-row">
                            <p class="related-title">Laporan <span>/ Laporan Aktivitas</span></p>
                            <p>Lihat rekap laporan bulanan dari data aktivitas</p>
                        </a>
                        <a href="/dashboard/laporan/performa" class="related-row">
                            <p class="related-title">Laporan <span>/ Laporan Performa</span></p>
                            <p>Lihat kalkulasi performa pegawai dari kehadirannya</p>
                        </a>
                        <a href="/dashboard/laporan/change-log" class="related-row">
                            <p class="related-title">Laporan <span>/ Change Log</span></p>
                            <p>Lihat riwayat perubahan yang dilakukan pengelola</p>
                        </a>
                        @can('manager')    
                        <a href="/dashboard/laporan/approval" class="related-row">
                            <p class="related-title">Laporan <span>/ Approval</span></p>
                            <p>Lihat riwayat dan status pengajuan yang dilakukan pengelola</p>
                        </a>
                        @endcan
                        <a href="" class="related-row">
                            <p class="related-title">Pengumuman <span>/ Notifikasi</span></p>
                            <p>Pengaturan format Notifikasi Whatsapp dan SMS</p>
                        </a>
                        <a href="" class="related-row">
                            <p class="related-title">Pengumuman <span>/ Mobile App</span></p>
                            <p>Pengaturan format Notifikasi mobile app presensi</p>
                        </a>
                        <a href="" class="related-row">
                            <p class="related-title">Perusahaan</p>
                            <p>Pengaturan profile dan kontent terkait perusahaanmu</p>
                        </a>
                        <a href="/dashboard/device" class="related-row">
                            <p class="related-title">Perangkat Presensi</p>
                            <p>Pengaturan Perangkat yang terintegrasi dengan sistem presensi</p>
                        </a>
                    </div>
                </div>
                <div class="db-account">
                    <div class="db-account-box profile-acc-box">
                        <img src="{{ asset('assets/app_logo.png') }}" draggable="false"/>
                    </div>
                    <div class="log-out-pop-up">
                        <div class="user-logged-name">{{ Auth::user()->name }}</div>
                        <a href="/logout" class="evented-btn log-out-btn">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="db-section">
            <nav class="db-nav">
                <div class="db-nav-box">
                    <div class="db-nav-main-box">
                        <div class="main-nav">
                            <div class="nav-icon font-sm">
                                <i class="fa-solid fa-object-group"></i>
                                <p>Page Manager</p>
                            </div>
                            <div class="sub-nav">
                                <a href="">Page Design</a>
                                <a href="">Page Content</a>
                                <a href="">Page Analytic</a>
                            </div>
                        </div>
                        <div class="main-nav 
                        @if($parentPage === 'dashboard')
                            active
                        @endif
                        ">
                            <div class="nav-icon font-lg">
                                <i class="fa-solid fa-square-poll-vertical"></i>
                                <p>Dashboard</p>
                            </div>
                            <div class="sub-nav">
                                <a href="/dashboard">Statistic</a>
                                <span class="as-label">Data Harian</span>
                                <a href="/dashboard/presensi">Presensi Harian</a>
                                <a href="/dashboard/izin">Rekap Izin</a>
                                <a href="/dashboard/aktivitas">Aktivitas Harian</a>
                                <a href="/dashboard/lembur">Lembur Harian</a>
                                <span class="as-label">Pesan Masuk</span>
                                <a href="/dashboard/chat-pegawai">Chat Pegawai</a>
                            </div>
                        </div>
                        @can('observer')
                            <div class="main-nav 
                            @if($parentPage === 'approval')
                                active
                            @endif
                            ">
                                <div class="nav-icon font-sm">
                                    <i class="fa-solid fa-file-shield"></i>
                                    <p>Pengajuan</p>
                                </div>
                                <div class="sub-nav">
                                    <span class="as-label">Data Harian</span>
                                    <a href="/dashboard/pengajuan-perubahan/presensi">Presensi Manual</a>
                                    <a href="/dashboard/pengajuan-perubahan/izin-presensi">Pengajuan Izin</a>
                                    <a href="/dashboard/pengajuan-perubahan/aktivitas-pegawai">Pengajuan Aktivitas</a>
                                    <a href="/dashboard/pengajuan-perubahan/lembur">Pengajuan Lembur</a>
                                    <span class="as-label">Master Data</span>
                                    <a href="/dashboard/pengajuan-perubahan/data-departemen">Data Departemen</a>
                                    <a href="/dashboard/pengajuan-perubahan/data-jabatan">Data Jabatan</a>
                                    <a href="/dashboard/pengajuan-perubahan/data-pegawai">Data Pegawai</a>
                                    <a href="/dashboard/pengajuan-perubahan/data-admin">Data Admin</a>                                        
                                    <a href="/dashboard/pengajuan-perubahan/data-aktivitas">Data Aktivitas</a>
                                    <a href="/dashboard/pengajuan-perubahan/jadwal">Jadwal Kerja</a>
                                    <a href="/dashboard/pengajuan-perubahan/libur-nasional">Libur Nasional</a>                                        
                                    <a href="/dashboard/pengajuan-perubahan/libur-khusus">Libur Khusus</a>
                                    <a href="/dashboard/pengajuan-perubahan/izin">Jenis Izin</a>                                        
                                </div>
                            </div>
                        @endcan
                        <div class="main-nav
                        @if($parentPage === 'master')
                            active
                        @endif
                        ">
                            <div class="nav-icon font-sm">
                                <i class="fa-regular fa-folder-open"></i>
                                <p>Master Data</p>
                            </div>
                            <div class="sub-nav">
                                @can('highOfficer')
                                    <a href="/dashboard/master/departemen">Master Departement</a>                                    
                                @endcan
                                <span class="as-label">Pegawai</span>
                                <a href="/dashboard/master/jabatan">Master Jabatan</a>
                                <a href="/dashboard/master/pegawai">Master Pegawai</a>
                                @can('highOfficer')
                                    <a href="/dashboard/master/admin">Master Admin</a>
                                @endcan
                                @can('manager')
                                    <a href="/dashboard/master/aktivitas">Master Aktivitas</a>
                                @endcan
                                <span class="as-label">Jadwal</span>
                                @if (Auth::user()->instansi->type_jadwal == 'Semua' || Auth::user()->instansi->type_jadwal == 'Non Shift')
                                    <a href="/dashboard/master/jadwal-non-shift">Jadwal Non-Shift</a>
                                @endif
                                @if (Auth::user()->instansi->type_jadwal == 'Semua' || Auth::user()->instansi->type_jadwal == 'Shift')
                                    <a href="/dashboard/master/jadwal-shift">Jadwal Shift</a>
                                @endif
                                @can('highOfficer')
                                    <a href="/dashboard/master/libur-nasional">Libur Nasional</a>                                    
                                @endcan
                                <a href="/dashboard/master/libur-khusus">Libur Khusus</a>
                                @can('highOfficer')
                                    <span class="as-label">Perizinan</span>     
                                    <a href="/dashboard/master/izin">Master Izin</a>
                                @endcan
                            </div>
                        </div>
                        <div class="main-nav 
                        @if($parentPage === 'laporan')
                            active
                        @endif
                        ">
                            <div class="nav-icon font-md">
                                <i class="fa-solid fa-file"></i>
                                <p>Laporan</p>
                            </div>
                            <div class="sub-nav">
                                <a href="/dashboard/laporan/presensi">Laporan Presensi</a>
                                <a href="/dashboard/laporan/aktivitas">Laporan Aktivitas</a>
                                <a href="/dashboard/laporan/performa">Laporan Performa</a>
                                <span class="as-label">Sistem</span>
                                <a href="/dashboard/laporan/change-log">Change Log</a>
                                @can('manager')
                                <a href="/dashboard/laporan/approval">Approval</a>
                                @endcan
                            </div>
                        </div>
                        @can('manager')    
                        <div class="main-nav">
                            <div class="nav-icon font-md">
                                <i class="fa-solid fa-bell"></i>
                                <p>Pengumuman</p>
                            </div>
                            <div class="sub-nav">
                                <a href="">Notifikasi</a>
                                <a href="">Mobile App</a>
                            </div>
                        </div>
                        @endcan
                        <div class="main-nav">
                            <div class="nav-icon font-md">
                                <i class="fa-solid fa-building"></i>
                                <a href="" class="link-outside">Perusahaan</a>
                            </div>
                        </div>
                        @can('manager')    
                        <div class="main-nav
                        @if($parentPage === 'device')
                            active
                        @endif
                        ">
                            <div class="nav-icon font-md">
                                <i class="fa-solid fa-server"></i>
                                <a href="/dashboard/device" class="link-outside">Perangkat</a>
                            </div>
                        </div>
                        @endcan
                        <div class="main-nav disappeared"></div>
                    </div>
                    <div class="fog-box"></div>
                </div>
                <div class="db-nav-box">
                    <a href="/dashboard/setting" class="nav-icon font-md" style="cursor: pointer">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </div>
            </nav>
            <div class="db-content">