<div wire:poll class="data-header">
    @foreach ($presensi_statistics as $keterangan)
            <div class="data-card" onclick="statPreview('presensi','{{ $preview_param }}','keterangan','{{ $keterangan[0]->keterangan }}')">
                <p>Total {{ $keterangan[0]->keterangan }}</p>
                <h5>{{ $keterangan->count() }} Check Log</h5>
                <i class="fa-solid fa-file-circle-check"></i>
                <span class="note">Lihat atau Unduh data {{ $keterangan[0]->keterangan }} disini</span>
            </div>
    @endforeach
</div>