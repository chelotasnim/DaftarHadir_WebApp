<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/app_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
    <title>Daftar Hadir</title>
    @livewireStyles
</head>
@php
    $quickUi = Auth::user()->dashboardUi[0]->quick_setting;
    $theme = Auth::user()->dashboardUi[0]->theme;
    $blob = Auth::user()->dashboardUi[0]->blob;
    $shadow = Auth::user()->dashboardUi[0]->shadow;
    $filter = Auth::user()->dashboardUi[0]->filter;
    $transition = Auth::user()->dashboardUi[0]->transition;
@endphp
<body class="{{ $theme }}">
    <form class="page" action="/dashboard/setting" method="POST">
        @csrf
        <nav>
            <a href="/dashboard" class="nav-box">
                <i class="fa-solid fa-angles-left"></i>
            </a>
            <div>
                <button class="nav-box as-btn" type="submit">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
                <div class="name-box">Simpan Perubahan</div>
                <a class="nav-box as-btn" href="/logout">
                    <i class="fa-solid fa-power-off"></i>
                </a>
            </div>
        </nav>
        <div class="setting">
            <header>
                <div class="quick-setting-menu @if($quickUi === 'HighBlob'){{ 'active' }}@endif" quickSettingTargetId="1">
                    <div class="quick-setting-box">
                        <div class="quick-setting-preview">
                            <img src="{{ asset('assets/dashboard-settings.png') }}" draggable="false"/>
                            <input type="radio" name="quick_setting" class="preview-cover" value="HighBlob" @if($quickUi === 'HighBlob'){{ 'checked' }}@endif>
                            <div class="setting-status">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div class="quick-setting-stat">
                            <div class="stat-ui stat-box">
                                <span class="stat-label">Tampilan :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-perform stat-box">
                                <span class="stat-label">Performa :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($quickUi == 'HighBlob')
                            <span class="used-by-now">DIGUNAKAN</span>
                        @endif
                    </div>
                </div>
                <div class="quick-setting-menu @if($quickUi === 'HighSharp'){{ 'active' }}@endif" quickSettingTargetId="2">
                    <div class="quick-setting-box">
                        <div class="quick-setting-preview">
                            <img src="{{ asset('assets/dashboard-settings.png') }}" draggable="false"/>
                            <input type="radio" name="quick_setting" class="preview-cover" value="HighSharp" @if($quickUi === 'HighSharp'){{ 'checked' }}@endif>
                            <div class="setting-status">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div class="quick-setting-stat">
                            <div class="stat-ui stat-box">
                                <span class="stat-label">Tampilan :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-perform stat-box">
                                <span class="stat-label">Performa :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($quickUi == 'HighSharp')
                            <span class="used-by-now">DIGUNAKAN</span>
                        @endif
                    </div>
                </div>
                <div class="quick-setting-menu @if($quickUi === 'Medium'){{ 'active' }}@endif" quickSettingTargetId="3">
                    <div class="quick-setting-box">
                        <div class="quick-setting-preview">
                            <img src="{{ asset('assets/dashboard-settings.png') }}" draggable="false"/>
                            <input type="radio" name="quick_setting" class="preview-cover" value="Medium" @if($quickUi === 'Medium'){{ 'checked' }}@endif>
                            <div class="setting-status">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div class="quick-setting-stat">
                            <div class="stat-ui stat-box">
                                <span class="stat-label">Tampilan :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-perform stat-box">
                                <span class="stat-label">Performa :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($quickUi == 'Medium')
                            <span class="used-by-now">DIGUNAKAN</span>
                        @endif
                    </div>
                </div>
                <div class="quick-setting-menu @if($quickUi === 'Low'){{ 'active' }}@endif" quickSettingTargetId="4">
                    <div class="quick-setting-box">
                        <div class="quick-setting-preview">
                            <img src="{{ asset('assets/dashboard-settings.png') }}" draggable="false"/>
                            <input type="radio" name="quick_setting" class="preview-cover" value="Low" @if($quickUi === 'Low'){{ 'checked' }}@endif>
                            <div class="setting-status">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div class="quick-setting-stat">
                            <div class="stat-ui stat-box">
                                <span class="stat-label">Tampilan :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-perform stat-box">
                                <span class="stat-label">Performa :</span>
                                <div class="stat-rate-box">
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="stat-val">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($quickUi == 'Low')
                            <span class="used-by-now">DIGUNAKAN</span>
                        @endif
                    </div>
                </div>
                <div class="quick-setting-menu customize-setting @if($quickUi == 'Custom'){{ 'active' }}@endif" quickSettingTargetId="5">
                    <div class="quick-setting-box">
                        <div class="quick-setting-preview">
                            <img src="{{ asset('assets/dashboard-settings.png') }}" draggable="false"/>
                            <input type="radio" name="quick_setting" class="preview-cover" value="Custom" @if($quickUi === 'Custom'){{ 'checked' }}@endif>
                            <div class="add-setting">
                                <i class="fa-solid fa-circle-plus"></i>
                            </div>
                            <div class="setting-status">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div class="quick-setting-stat">
                            <div class="stat-ui stat-box">
                                <span class="stat-label">
                                    <i class="fa-solid fa-plus"></i>
                                    @if($quickUi == 'Custom')
                                        Pengaturan Manual Saat Ini
                                    @else
                                        Tambahkan Pengaturan Manual
                                    @endif
                                </span>
                            </div>
                        </div>
                        @if($quickUi == 'Custom')
                            <span class="used-by-now">DIGUNAKAN</span>
                        @endif
                    </div>
                </div>
            </header>
            <div class="setting-detail">
                <div class="color-setting">
                    <div class="color-box red @if($theme === 'red-page'){{ 'used' }}@endif">
                        Spike Red
                        <input type="radio" name="theme" value="red-page" class="color-picker" @if($theme === 'red-page'){{ 'checked' }}@endif>
                    </div>
                    <div class="color-box green @if($theme === 'green-page'){{ 'used' }}@endif">
                        Nitro Green
                        <input type="radio" name="theme" value="green-page" class="color-picker" @if($theme === 'green-page'){{ 'checked' }}@endif>
                    </div>
                    <div class="color-box blue @if($theme === 'blue-page'){{ 'used' }}@endif">
                        Organize Blue
                        <input type="radio" name="theme" value="blue-page" class="color-picker"@if($theme === 'blue-page'){{ 'checked' }}@endif>
                    </div>
                    <div class="color-box black @if($theme === 'black-page'){{ 'used' }}@endif">
                        Elite Black
                        <input type="radio" name="theme" value="black-page" class="color-picker" @if($theme === 'black-page'){{ 'checked' }}@endif>
                    </div>
                </div>
                <hr>
                <div quickSettingId="1" class="setting-option-wrapper disabled-setting @if($quickUi === 'HighBlob'){{ 'active-detail' }}@endif">
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Blob Element</h5>
                            <p>
                                Menerapkan jenis bentuk tampilan yang halus dan tumpul pada element aplikasi seperti bar menu, kartu, tombol, dan lain lain. Banyaknya element yang menerapkan Blob Element mungkin akan berpengaruh pada performa saat memuat halaman namun tidak akan begitu signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Semi Neumorphism</h5>
                            <p>
                                Efek tampilan yang lebih berdimensi dengan pengaturan bayangan dan pencahayaan pada element aplikasi. Bayangan yang ditampilkan sangat memungkinkan penurunan performa dalam memuat halaman pada perangkat dengan daya muat dan kecepatan internet yang rendah
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Visual Filter</h5>
                            <p>
                                Fitur visual yang bekerja dengan mempercantik tampilan dari segi pencahayaan, suhu warna, ketajaman, dan sorotan. Jika anda menggunakan browser versi lawas atau menggunakan perangkat dengan daya muat yang rendah, fitur ini memungkinkan terjadinya penurunan FPS yang signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Transition Animation</h5>
                            <p>
                                Fitur transisi dan animasi yang disematkan pada element aplikasi sebagai pendukung tampilan maupun pendukung pengalaman user dalam menggunakan aplikasi. Jika anda merasakan penurunan FPS saat berinteraksi dengan element yang disematkan transisi, matikan fitur ini
                            </p>
                        </div>
                    </div>
                </div>
                <div quickSettingId="2" class="setting-option-wrapper disabled-setting @if($quickUi === 'HighSharp'){{ 'active-detail' }}@endif">
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Blob Element</h5>
                            <p>
                                Menerapkan jenis bentuk tampilan yang halus dan tumpul pada element aplikasi seperti bar menu, kartu, tombol, dan lain lain. Banyaknya element yang menerapkan Blob Element mungkin akan berpengaruh pada performa saat memuat halaman namun tidak akan begitu signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Semi Neumorphism</h5>
                            <p>
                                Efek tampilan yang lebih berdimensi dengan pengaturan bayangan dan pencahayaan pada element aplikasi. Bayangan yang ditampilkan sangat memungkinkan penurunan performa dalam memuat halaman pada perangkat dengan daya muat dan kecepatan internet yang rendah
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Visual Filter</h5>
                            <p>
                                Fitur visual yang bekerja dengan mempercantik tampilan dari segi pencahayaan, suhu warna, ketajaman, dan sorotan. Jika anda menggunakan browser versi lawas atau menggunakan perangkat dengan daya muat yang rendah, fitur ini memungkinkan terjadinya penurunan FPS yang signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Transition Animation</h5>
                            <p>
                                Fitur transisi dan animasi yang disematkan pada element aplikasi sebagai pendukung tampilan maupun pendukung pengalaman user dalam menggunakan aplikasi. Jika anda merasakan penurunan FPS saat berinteraksi dengan element yang disematkan transisi, matikan fitur ini
                            </p>
                        </div>
                    </div>
                </div>
                <div quickSettingId="3" class="setting-option-wrapper disabled-setting @if($quickUi === 'Medium'){{ 'active-detail' }}@endif">
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Blob Element</h5>
                            <p>
                                Menerapkan jenis bentuk tampilan yang halus dan tumpul pada element aplikasi seperti bar menu, kartu, tombol, dan lain lain. Banyaknya element yang menerapkan Blob Element mungkin akan berpengaruh pada performa saat memuat halaman namun tidak akan begitu signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Semi Neumorphism</h5>
                            <p>
                                Efek tampilan yang lebih berdimensi dengan pengaturan bayangan dan pencahayaan pada element aplikasi. Bayangan yang ditampilkan sangat memungkinkan penurunan performa dalam memuat halaman pada perangkat dengan daya muat dan kecepatan internet yang rendah
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Visual Filter</h5>
                            <p>
                                Fitur visual yang bekerja dengan mempercantik tampilan dari segi pencahayaan, suhu warna, ketajaman, dan sorotan. Jika anda menggunakan browser versi lawas atau menggunakan perangkat dengan daya muat yang rendah, fitur ini memungkinkan terjadinya penurunan FPS yang signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox" checked>
                        </div>
                        <div class="setting-desc">
                            <h5>Transition Animation</h5>
                            <p>
                                Fitur transisi dan animasi yang disematkan pada element aplikasi sebagai pendukung tampilan maupun pendukung pengalaman user dalam menggunakan aplikasi. Jika anda merasakan penurunan FPS saat berinteraksi dengan element yang disematkan transisi, matikan fitur ini
                            </p>
                        </div>
                    </div>
                </div>
                <div quickSettingId="4" class="setting-option-wrapper disabled-setting @if($quickUi === 'Low'){{ 'active-detail' }}@endif">
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Blob Element</h5>
                            <p>
                                Menerapkan jenis bentuk tampilan yang halus dan tumpul pada element aplikasi seperti bar menu, kartu, tombol, dan lain lain. Banyaknya element yang menerapkan Blob Element mungkin akan berpengaruh pada performa saat memuat halaman namun tidak akan begitu signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Semi Neumorphism</h5>
                            <p>
                                Efek tampilan yang lebih berdimensi dengan pengaturan bayangan dan pencahayaan pada element aplikasi. Bayangan yang ditampilkan sangat memungkinkan penurunan performa dalam memuat halaman pada perangkat dengan daya muat dan kecepatan internet yang rendah
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Visual Filter</h5>
                            <p>
                                Fitur visual yang bekerja dengan mempercantik tampilan dari segi pencahayaan, suhu warna, ketajaman, dan sorotan. Jika anda menggunakan browser versi lawas atau menggunakan perangkat dengan daya muat yang rendah, fitur ini memungkinkan terjadinya penurunan FPS yang signifikan
                            </p>
                        </div>
                    </div>
                    <div class="setting-option">
                        <div class="setting-check">
                            <input type="checkbox">
                        </div>
                        <div class="setting-desc">
                            <h5>Transition Animation</h5>
                            <p>
                                Fitur transisi dan animasi yang disematkan pada element aplikasi sebagai pendukung tampilan maupun pendukung pengalaman user dalam menggunakan aplikasi. Jika anda merasakan penurunan FPS saat berinteraksi dengan element yang disematkan transisi, matikan fitur ini
                            </p>
                        </div>
                    </div>
                </div>
                @if ($quickUi === 'Custom')
                    <div quickSettingId="5" class="setting-option-wrapper active-detail">
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="blob" value="1" @if($blob == true){{ 'checked' }}@endif>
                            </div>
                            <div class="setting-desc">
                                <h5>Blob Element</h5>
                                <p>
                                    Menerapkan jenis bentuk tampilan yang halus dan tumpul pada element aplikasi seperti bar menu, kartu, tombol, dan lain lain. Banyaknya element yang menerapkan Blob Element mungkin akan berpengaruh pada performa saat memuat halaman namun tidak akan begitu signifikan
                                </p>
                            </div>
                        </div>
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="shadow" value="1" @if($shadow == true){{ 'checked' }}@endif>
                            </div>
                            <div class="setting-desc">
                                <h5>Semi Neumorphism</h5>
                                <p>
                                    Efek tampilan yang lebih berdimensi dengan pengaturan bayangan dan pencahayaan pada element aplikasi. Bayangan yang ditampilkan sangat memungkinkan penurunan performa dalam memuat halaman pada perangkat dengan daya muat dan kecepatan internet yang rendah
                                </p>
                            </div>
                        </div>
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="filter" value="1" @if($filter == true){{ 'checked' }}@endif>
                            </div>
                            <div class="setting-desc">
                                <h5>Visual Filter</h5>
                                <p>
                                    Fitur visual yang bekerja dengan mempercantik tampilan dari segi pencahayaan, suhu warna, ketajaman, dan sorotan. Jika anda menggunakan browser versi lawas atau menggunakan perangkat dengan daya muat yang rendah, fitur ini memungkinkan terjadinya penurunan FPS yang signifikan
                                </p>
                            </div>
                        </div>
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="transition" value="1" @if($transition == true){{ 'checked' }}@endif>
                            </div>
                            <div class="setting-desc">
                                <h5>Transition Animation</h5>
                                <p>
                                    Fitur transisi dan animasi yang disematkan pada element aplikasi sebagai pendukung tampilan maupun pendukung pengalaman user dalam menggunakan aplikasi. Jika anda merasakan penurunan FPS saat berinteraksi dengan element yang disematkan transisi, matikan fitur ini
                                </p>
                            </div>
                        </div>
                    </div>
                @else 
                    <div quickSettingId="5" class="setting-option-wrapper">
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="blob" value="1">
                            </div>
                            <div class="setting-desc">
                                <h5>Blob Element</h5>
                                <p>
                                    Menerapkan jenis bentuk tampilan yang halus dan tumpul pada element aplikasi seperti bar menu, kartu, tombol, dan lain lain. Banyaknya element yang menerapkan Blob Element mungkin akan berpengaruh pada performa saat memuat halaman namun tidak akan begitu signifikan
                                </p>
                            </div>
                        </div>
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="shadow" value="1">
                            </div>
                            <div class="setting-desc">
                                <h5>Semi Neumorphism</h5>
                                <p>
                                    Efek tampilan yang lebih berdimensi dengan pengaturan bayangan dan pencahayaan pada element aplikasi. Bayangan yang ditampilkan sangat memungkinkan penurunan performa dalam memuat halaman pada perangkat dengan daya muat dan kecepatan internet yang rendah
                                </p>
                            </div>
                        </div>
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="filter" value="1">
                            </div>
                            <div class="setting-desc">
                                <h5>Visual Filter</h5>
                                <p>
                                    Fitur visual yang bekerja dengan mempercantik tampilan dari segi pencahayaan, suhu warna, ketajaman, dan sorotan. Jika anda menggunakan browser versi lawas atau menggunakan perangkat dengan daya muat yang rendah, fitur ini memungkinkan terjadinya penurunan FPS yang signifikan
                                </p>
                            </div>
                        </div>
                        <div class="setting-option">
                            <div class="setting-check">
                                <input type="checkbox" name="transition" value="1">
                            </div>
                            <div class="setting-desc">
                                <h5>Transition Animation</h5>
                                <p>
                                    Fitur transisi dan animasi yang disematkan pada element aplikasi sebagai pendukung tampilan maupun pendukung pengalaman user dalam menggunakan aplikasi. Jika anda merasakan penurunan FPS saat berinteraksi dengan element yang disematkan transisi, matikan fitur ini
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @error('quick_setting')
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $message }}
            </div>
        @enderror
        @error('theme')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
        @enderror
        @if (session()->has('success'))
            <div class="notif success new">
                <i class="fa-solid fa-square-check"></i>
                {{ session('success') }}
            </div>
        @endif
    </form>
    @livewireScripts
    <script src="{{ asset('js/setting.js') }}"></script>
</body>
</html>