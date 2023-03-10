<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/app_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/regist.css') }}">
    <title>Daftar Hadir</title>
    @livewireStyles
</head>
<body>
    <div class="page">
        <div class="progress-bar">
            <div class="progress-line">
                <div class="progress-fill"></div>
            </div>
            <div class="progress-dot active">1</div>
            <div class="progress-dot">2</div>
            <div class="progress-dot">3</div>
            <div class="progress-dot">4</div>
            <div class="progress-dot">5</div>
            <div class="progress-dot">6</div>
        </div>
        @livewire('wizard.start-form')
    </div>
    @livewireScripts
    <script src="{{ asset('js/regist.js') }}"></script>
</body>
</html>