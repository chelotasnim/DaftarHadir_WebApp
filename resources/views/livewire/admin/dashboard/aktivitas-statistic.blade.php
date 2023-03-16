<div wire:poll class="data-header">
    <div class="data-card" onclick="statPreview('aktivitas','{{ $preview_param }}','jenis','all')">
        <p>Total Aktivitas</p>
        <h5>{{ $total }} Laporan</h5>
        <i class="fa-solid fa-file-circle-check"></i>
        <span class="note">Lihat atau Unduh data aktivitas disini</span>
    </div>
    @foreach ($by_jenis as $aktivitas)
        <div class="data-card" onclick="statPreview('aktivitas','{{ $preview_param }}','jenis','{{ $aktivitas[0]->jenis }}')">
            <p>{{ $aktivitas[0]->jenis }}</p>
            <h5>{{ $aktivitas->count() }} Laporan</h5>
            <i class="fa-solid fa-file-circle-check"></i>
            <span class="note">Lihat atau Unduh aktivitas {{ $aktivitas[0]->jenis }} disini</span>
        </div>
    @endforeach
</div>