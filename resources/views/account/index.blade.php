<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/app_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <title>Daftar Hadir</title>
</head>
<body>
    <div class="page">
        <div class="container">
            <div class="col image-col">
                <img src="{{ asset('assets/login-image.png') }}" draggable="false"/>
                <div class="about">
                    <h5>Daftar Hadir</h5>
                    <p>Aplikasi pengelola presensi secara lebih cepat, efisien dan optimal dengan berbagai fitur lengkap!</p>
                </div>
            </div>
            <div class="col">
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-head">
                        <h5>Masuk Akun</h5>
                        <p>Selamat Datang di Daftar Hadir</p>
                    </div>
                    <div class="form-prompt">
                        <input fieldFor="name" class="switched-field" type="text" name="name" placeholder="Nama Anda" value="{{ old('name') }}" autocomplete="off">
                        <input fieldFor="username" class="switched-field" type="text" name="username" placeholder="Username" value="{{ old('username') }}" autocomplete="off">
                        <input fieldFor="email" class="switched-field used" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                        <div class="password-wrapper">
                            <input type="password" name="password" placeholder="Password">
                            <span class="show-pass">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        <button class="evented-btn">Masuk</button>
                    </div>
                    <div class="form-footer">
                        <p>Pilih Opsi Masuk Dibawah</p>
                        <div class="login-select">
                            <div loginWith="name" class="login-select-box">
                                <i class="fa-solid fa-signature"></i>
                            </div>
                            <div loginWith="username" class="login-select-box">
                                <i class="fa-solid fa-user-tag"></i>
                            </div>
                            <div loginWith="email" class="login-select-box active">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                            </div>
                        </div>
                        <p>&copy;Daftar Hadir</p>
                    </div>
                </form>
                @if ($libur == true)
                    <div class="notif success new">
                        <i class="fa-solid fa-mug-hot"></i>
                        <span>Selamat {{ $event }}</span>
                    </div>
                @endif
                @error('name')
                <div class="notif new">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ $message }}
                </div>
                @enderror
                @error('password')
                <div class="notif new">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ $message }}
                </div>
                @enderror
                @if (session()->has('login_failed'))
                <div class="notif new">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ session('login_failed') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/account.js') }}"></script>
</body>
</html>