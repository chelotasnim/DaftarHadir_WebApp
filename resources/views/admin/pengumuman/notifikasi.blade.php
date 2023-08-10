@extends('admin.layout.master')

@section('admin')

    <div class="data-template rekap-template">
        <div class="data-content master-template">
            @if (session()->has('success'))
                <div class="notif success new">
                    <i class="fa-solid fa-square-check"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('failed'))
                <div class="notif new">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ session('failed') }}
                </div>
            @endif
            <div class="data-controller">
                <div class="controller-role">
                    @can('manager')
                        <i class="fa-solid fa-user-gear"></i>
                    @endcan
                    @can('observer')   
                        <i class="fa-solid fa-user-secret"></i>
                    @endcan
                    {{ Auth::user()->peran }}
                </div>
                <div class="controller-box">
                    <div class="controller-btn evented-btn modal-trigger" onclick="showModal('4dd', 'new')">Tambah Pesan</div>
                </div>    
            </div>    
            <form class="rekap-area" action="/dashboard/pengumuman/autonotif" method="POST">    
                @csrf
                @if (isset(Auth::user()->autonotif))
                    <div class="rekap-box">    
                        <div class="rekap-field">    
                            <label for="">    
                                <i class="fa-solid fa-user-tag"></i>    
                                Username AutoNotif    
                            </label>
                            <input name="username" type="text" autocomplete="off" placeholder="Username AutoNotif" value="{{ Auth::user()->autonotif->username }}">
                        </div>
                    </div>
                    <div class="rekap-box">
                        <div class="rekap-field">
                            <label for="">
                                <i class="fa-solid fa-qrcode"></i>
                                Token AutoNotif
                            </label>
                            <input name="token" type="text" autocomplete="off" placeholder="Token AutoNotif" value="{{ Auth::user()->autonotif->token }}">
                        </div>
                    </div>
                @else
                    <div class="rekap-box">    
                        <div class="rekap-field">    
                            <label for="">    
                                <i class="fa-solid fa-user-tag"></i>    
                                Username AutoNotif    
                            </label>
                            <input name="username" type="text" autocomplete="off" placeholder="Username AutoNotif">
                        </div>
                    </div>
                    <div class="rekap-box">
                        <div class="rekap-field">
                            <label for="">
                                <i class="fa-solid fa-qrcode"></i>
                                Token AutoNotif
                            </label>
                            <input name="token" type="text" autocomplete="off" placeholder="Token AutoNotif">
                        </div>
                    </div>    
                @endif
                <div class="rekap-box" style="padding-top: 26px; margin-left: -12px;">
                    <button type="submit" class="btn on btn-icon evented-btn" style="font-size: 12px">
                        Simpan
                    </button>
                </div>
            </form>
            <form action="/autonotif-test" class="rekap-area" method="POST">
                @csrf
                <div class="rekap-box">
                    <div class="rekap-field">
                        <label for="">
                            <i class="fa-solid fa-satellite-dish"></i>
                            Uji Coba Pesan
                        </label>
                        <input type="number" name="test_target" placeholder="Masukkan nomor WA">
                    </div>
                </div>
                <div class="rekap-box" style="padding-top: 26px; margin-left: -12px;">
                    <button type="submit" class="btn on btn-icon evented-btn" style="font-size: 12px">
                        Kirim
                    </button>
                </div>
            </form>
            <div class="data-controller message-event-menu">
                <div class="controller-box @if($event === 'Pendaftaran Pegawai'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/pendaftaran_pegawai" class="controller-btn evented-btn">Pendaftaran Pegawai</a>
                </div>    
                <div class="controller-box @if($event === 'Absensi Masuk'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/absensi_masuk" class="controller-btn evented-btn">Absensi Masuk</a>
                </div>    
                <div class="controller-box @if($event === 'Absensi Keluar'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/absensi_keluar" class="controller-btn evented-btn">Absensi Keluar</a>
                </div>    
                <div class="controller-box @if($event === 'Absensi Terlambat'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/absensi_terlambat" class="controller-btn evented-btn">Absensi Terlambat</a>
                </div>  
                <div class="controller-box @if($event === 'Absensi Keluar Cepat'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/absensi_keluar_cepat" class="controller-btn evented-btn">Absensi Keluar Cepat</a>
                </div>    
                <div class="controller-box @if($event === 'Alpha'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/alpha" class="controller-btn evented-btn">Alpha</a>
                </div>   
                <div class="controller-box @if($event === 'Pengingat Masuk'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/masuk_reminder" class="controller-btn evented-btn">Pengingat Absensi Masuk</a>
                </div> 
                <div class="controller-box @if($event === 'Pengingat Keluar'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/keluar_reminder" class="controller-btn evented-btn">Pengingat Absensi Keluar</a>
                </div>   
                <div class="controller-box @if($event === 'Ulang Tahun'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/ulang_tahun" class="controller-btn evented-btn">Ulang Tahun</a>
                </div>   
                <div class="controller-box @if($event === 'Libur'){{ 'used' }}@endif">
                    <a href="/dashboard/pengumuman/notifikasi/libur" class="controller-btn evented-btn">Hari Libur</a>
                </div>   
            </div>
            @yield('message_event')
        </div>
    </div>
    
@endsection