<div wire:poll class="data-header">
    <div class="data-card" onclick="statPreview('izin','{{ $preview_param }}','keterangan','all')">
        <p>Total Izin</p>
        <h5>{{ $total_izin }} Pegawai</h5>
        <i class="fa-solid fa-file-circle-check"></i>
        <span class="note">Lihat atau Unduh data izin disini</span>
    </div>
    @foreach ($izin_statistics as $izin) 
            <div class="data-card" onclick="statPreview('izin','{{ $preview_param }}','keterangan','{{ $izin[0]->keterangan }}')">
                <p>{{ $izin[0]->keterangan }}</p>
                <h5>{{ $izin->count() }} Pegawai</h5>
                <i class="fa-solid fa-file-circle-check"></i>
                <span class="note">Lihat atau Unduh data {{ $izin[0]->keterangan }} disini</span>
            </div>
    @endforeach
</div>