<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/app_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        ::-webkit-scrollbar {
            width: 0;
        }
    </style>
    <title>Daftar Hadir</title>
</head>
<body>
    <div class="page print-page">
        <div class="print-control">
            <a href="/dashboard/laporan/grafis-performa/preview/{{ $bulan }}/{{ $departemen_id }}" class="controller-btn evented-btn">Kembali</a>
            <div onclick="printElement(this)" class="controller-btn evented-btn">Cetak Grafis</div>
        </div>
        <div class="print-head">
            <h5>Rekap Grafis Performa</h5>
            @if ($departemen_id != 'all')
                @foreach ($departemens as $depar)
                    @if ($depar->id == $departemen_id)
                        <h3>Pegawai {{ $depar->nama_dept }}</h3>
                    @endif
                @endforeach
            @else 
                <h3>Pegawai Situbondo Fresh Fish</h3>
            @endif
            <p>Per Bulan {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}</p>
        </div>
        <div class="rekap-chart-container" style="padding: 0 24px 24px">
            <div class="chart-data-resource">
                @foreach ($departemens as $depar)
                    @foreach ($depar->jadwals as $jadwal)
                        @foreach ($jadwal->jabatans as $jabatan)
                            @foreach ($jabatan->pegawais as $pegawai)
                                @if (isset($log_hadir[(string)$pegawai->id]))
                                    <div class="resource-package">
                                        <span class="assemblyId">{{ $pegawai->id }}</span>
                                        <span class="resource-name">{{ $pegawai->nama }}</span>
                                        <span class="stat-hadir">{{ $log_hadir[(string)$pegawai->id] }}</span>
                                        <span class="stat-lembur">{{ $log_lembur[(string)$pegawai->id] }}</span>
                                        <span class="stat-izin">{{ $log_izin[(string)$pegawai->id] }}</span>
                                        <span class="stat-alpha">
                                            @if (isset($log_alpha[(string)$pegawai->id]))
                                                {{ (int)$log_alpha[(string)$pegawai->id] - $log_izin[(string)$pegawai->id] }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                        <span class="stat-telat">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($log_telat[(string)$pegawai->id] as $log)
                                                @php
                                                    $detail = $log->catatan;
                                                    $getMinute = (int) filter_var($detail, FILTER_SANITIZE_NUMBER_INT);

                                                    $total += $getMinute;
                                                @endphp
                                            @endforeach
                                            {{ $total }}
                                        </span>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            </div>
            <div class="rekap-chart-plate" style="margin-top: 24px">
                <div class="rekap-chart-head">
                    <h5>Statistic Kehadiran {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}</h5>
                    @if ($departemen_id != 'all')
                        @foreach ($departemens as $depar)
                            @if ($depar->id == $departemen_id)
                                <p>Per pegawai dalam departemen {{ $depar->nama_dept }}</p>
                            @endif
                        @endforeach
                    @else 
                        <p>Per pegawai dalam perusahaan {{ Auth::user()->instansi->nama_instansi }}</p>
                    @endif
                </div>
                <div class="rekap-chart-graphic">
                    <canvas id="chart-detail-hadir"></canvas>
                </div>
            </div>
            <div class="rekap-chart-plate">
                <div class="rekap-chart-head">
                    <h5>Statistic Lembur {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}
                    </h5>
                    @if ($departemen_id != 'all')
                        @foreach ($departemens as $depar)
                            @if ($depar->id == $departemen_id)
                                <p>Per pegawai dalam departemen {{ $depar->nama_dept }}</p>
                            @endif
                        @endforeach
                    @else
                        <p>Per pegawai dalam perusahaan {{ Auth::user()->instansi->nama_instansi }}</p>
                    @endif
                </div>
                <div class="rekap-chart-graphic">
                    <canvas id="chart-detail-lembur"></canvas>
                </div>
            </div>
            <div class="rekap-chart-plate" style="margin-top: 24px">
                <div class="rekap-chart-head">
                    <h5>Statistic Izin {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}</h5>
                    @if ($departemen_id != 'all')
                        @foreach ($departemens as $depar)
                            @if ($depar->id == $departemen_id)
                                <p>Per pegawai dalam departemen {{ $depar->nama_dept }}</p>
                            @endif
                        @endforeach
                    @else 
                        <p>Per pegawai dalam perusahaan {{ Auth::user()->instansi->nama_instansi }}</p>
                    @endif
                </div>
                <div class="rekap-chart-graphic">
                    <canvas id="chart-detail-izin"></canvas>
                </div>
            </div>
            <div class="rekap-chart-plate" style="margin-top: 24px">
                <div class="rekap-chart-head">
                    <h5>Statistic Alpha {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}</h5>
                    @if ($departemen_id != 'all')
                        @foreach ($departemens as $depar)
                            @if ($depar->id == $departemen_id)
                                <p>Per pegawai dalam departemen {{ $depar->nama_dept }}</p>
                            @endif
                        @endforeach
                    @else 
                        <p>Per pegawai dalam perusahaan {{ Auth::user()->instansi->nama_instansi }}</p>
                    @endif
                </div>
                <div class="rekap-chart-graphic">
                    <canvas id="chart-detail-alpha"></canvas>
                </div>
            </div>
            <div class="rekap-chart-plate" style="margin-top: 24px">
                <div class="rekap-chart-head">
                    <h5>Statistic Telat {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}</h5>
                    @if ($departemen_id != 'all')
                        @foreach ($departemens as $depar)
                            @if ($depar->id == $departemen_id)
                                <p>Per pegawai dalam departemen {{ $depar->nama_dept }}</p>
                            @endif
                        @endforeach
                    @else 
                        <p>Per pegawai dalam perusahaan {{ Auth::user()->instansi->nama_instansi }}</p>
                    @endif
                </div>
                <div class="rekap-chart-graphic">
                    <canvas id="chart-detail-telat"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>