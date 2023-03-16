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
                    <a href="/dashboard/laporan/grafis-performa/preview/{{ \Carbon\Carbon::now()->format('Y-m') }}/all" class="controller-btn evented-btn">Lihat Grafis</a>
                @if (isset($bulan))
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('performa', 'Performa Karyawan {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}')">Ekspor XLS</button>
                @else
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('performa', 'Performa Karyawan {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}')">Ekspor XLS</button>
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
                    <input wire:model.defer="bulan" type="month" autocomplete="off">
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
                                    <input wire:model.defer="departemen_id" type="radio" name="depar" value="{{ $depar->id }}">
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endcan
            <div class="rekap-box">
                <div class="rekap-field">
                    <label for="">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        Nama Pegawai
                    </label>
                    <input type="text" class="rekap-search" autocomplete="off" placeholder="Cari Nama Pegawai">
                </div>
            </div>
            <div class="rekap-box" style="padding-top: 24px; margin-left: -12px;">
                <div wire:click="render" class="btn on btn-icon evented-btn">
                    <i class="fa-solid fa-filter"></i>
                </div>
            </div>
        </div>
        <div class="data-grid rekap-grid">
            <table id="performa" class="rekap-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Departemen</th>
                        <th colspan="2">Detail Performa 
                            @if (!empty($bulan))
                                {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}
                            @else
                                {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}
                            @endif
                        </th>
                    </tr>
                </thead>
                    @foreach ($departemens as $depar)
                        @foreach ($depar->jadwals as $jadwal)
                            @foreach ($jadwal->jabatans as $jabatan)
                                @foreach ($jabatan->pegawais as $pegawai)
                                    @if (isset($act_day[(string)$pegawai->id]))
                                        <tbody>
                                            <tr>
                                                <td rowspan="6">{{ $loop->iteration }}</td>
                                                <td class="table-parameter" rowspan="6">{{ $pegawai->nama }}</td>
                                                <td rowspan="6">{{ $pegawai->jabatan->jadwal->departemen->nama_dept }}</td>
                                                <td class="marked-col">Total Hari Efektif Kerja</td>
                                                <td class="value-col">{{ $act_day[(string)$pegawai->id] }} Hari Kerja</td>
                                            </tr>
                                            <tr class="data-row">
                                                <td class="marked-col">Total Kehadiran</td>
                                                <td class="value-col">
                                                    {{ $log_hadir[(string)$pegawai->id] }} Hari / {{ $act_day[(string)$pegawai->id] }} Hari Kerja
                                                </td>
                                            </tr>
                                            <tr class="data-row">
                                                <td class="marked-col">Total Lembur (Pengajuan & Jam)</td>
                                                @if (isset($log_lembur[(string)$pegawai->id]))
                                                    <td class="value-col">
                                                        {{ $log_lembur[(string)$pegawai->id]['log'] }} Pengajuan / {{ $log_lembur[(string)$pegawai->id]['jam'] }} Jam
                                                    </td>
                                                @else    
                                                    <td class="value-col">
                                                        0 Pengajuan / 0 Jam
                                                    </td>
                                                @endif
                                            </tr>
                                            <tr class="data-row">
                                                <td class="marked-col">Total Telat (Check Log & Menit)</td>
                                                <td class="value-col">
                                                    {{ $log_telat[(string)$pegawai->id]->count() }} Check Log /
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
                                                    {{ $total }} Menit
                                                </td>
                                            </tr>
                                            <tr class="data-row">
                                                <td class="marked-col">Total Izin</td>
                                                <td class="value-col">
                                                    {{ $log_izin[(string)$pegawai->id] }} Hari / {{ $act_day[(string)$pegawai->id] }} Hari Kerja
                                                </td>
                                            </tr>
                                            <tr class="data-row">
                                                <td class="marked-col">Total Alpha</td>
                                                @if (isset($log_alpha[(string)$pegawai->id]))
                                                    <td class="value-col">{{ (int)$log_alpha[(string)$pegawai->id] - $log_izin[(string)$pegawai->id] }} Hari / {{ $act_day[(string)$pegawai->id] }} Hari Kerja</td>
                                                @else
                                                    <td class="value-col">0 Hari / {{ $act_day[(string)$pegawai->id] }} Hari Kerja</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
            </table>
        </div>
        <div wire:loading.delay class="load-wrapper">
            <div class="loading-layer">
                <i class="fa-solid fa-spinner"></i>
            </div>
        </div>
    </div>
</div>