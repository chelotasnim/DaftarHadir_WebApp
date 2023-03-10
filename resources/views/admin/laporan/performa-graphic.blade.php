@extends('admin.layout.master')

@section('admin')

<div class="data-template rekap-template">
    <div class="data-content master-template">
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
                <a href="/dashboard/laporan/performa" class="controller-btn evented-btn">Lihat Tabel</a>
                @if ($departemen_id != 'all')
                    <a href="/dashboard/laporan/grafis-performa/print/{{ $bulan }}/{{ $departemen_id }}" class="controller-btn evented-btn">Cetak Grafis</a> 
                @else 
                    <a href="/dashboard/laporan/grafis-performa/print/{{ $bulan }}/all" class="controller-btn evented-btn">Cetak Grafis</a> 
                @endif
            </div>
        </div>
        <div class="rekap-area">
            <div class="rekap-box">
                <div class="rekap-field">
                    <label for="">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        Performa Bulan
                    </label>
                    <input class="as-param-get-month" class="rekap-filter-wire" type="month" autocomplete="off" value="{{ $bulan }}">
                </div>
            </div>
            @can('highOfficer')
                <div class="rekap-box">
                    <div class="rekap-field">
                        <label for="">
                            <i class="fa-solid fa-users-viewfinder"></i>
                            Pegawai Departemen
                        </label>
                        <input type="text" class="filter-input" autocomplete="off" placeholder="Cari Departemen">
                    </div>
                    <div class="related-list" style="margin-top: -3px;width: 100%">
                        @foreach ($departemens as $depar)
                            @if ($depar->status === 'Aktif')
                                <p>
                                    <span class="related-title">{{ $depar->nama_dept }}</span>
                                    <input type="radio" class="as-param-get-depar" value="{{ $depar->id }}">
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>                
            @endcan
            <div class="rekap-box filter-sender">
                <button onclick="rekapSyncFilter()" type="submit evented-btn">Tampilkan</button>
            </div>
        </div>
        <div class="rekap-chart-container">
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
            <div class="rekap-chart-plate">
                <div class="rekap-chart-head">
                    <h5>Statistic Kehadiran {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}
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
            <div class="rekap-chart-plate">
                <div class="rekap-chart-head">
                    <h5>Statistic Izin {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}
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
                    <canvas id="chart-detail-izin"></canvas>
                </div>
            </div>
            <div class="rekap-chart-plate">
                <div class="rekap-chart-head">
                    <h5>Statistic Alpha {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}
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
                    <canvas id="chart-detail-alpha"></canvas>
                </div>
            </div>
            <div class="rekap-chart-plate">
                <div class="rekap-chart-head">
                    <h5>Statistic Telat {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}
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
                    <canvas id="chart-detail-telat"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection