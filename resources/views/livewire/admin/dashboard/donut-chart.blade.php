<div wire:poll class="simple-chart">
    <div class="chart-head">
        <h5>Keterangan Presensi</h5>
        <p>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
    <div class="chart-data">
        <canvas id="chart-keterangan" class="chart"></canvas>
        <div class="chart-total">
            <h5>{{ $izin_ket->count() }}</h5>
            <p>Pegawai Izin</p>
        </div>
    </div>
    <div class="chart-detail">
        @foreach ($izin_ket as $izin)    
            <div class="chart-detail-row">
                <div class="chart-detail-col">
                    <div class="chart-detail-dot"></div>
                    {{ $izin[0]->keterangan }}
                </div>
                <div class="chart-detail-col detail-value izin-count">{{ $izin->count() }}</div>
            </div>
        @endforeach
    </div>
</div>