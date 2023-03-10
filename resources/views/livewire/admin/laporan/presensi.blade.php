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
                @if (isset($bulan))
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('presensi', 'Aktivitas Karyawan {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}')">Ekspor XLS</button>
                @else
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('presensi', 'Aktivitas Karyawan {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}')">Ekspor XLS</button>
                @endif
            </div>
        </div>
        <div class="rekap-area">
            <div class="rekap-box">
                <div class="rekap-field">
                    <label for="">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        Akltivitas Bulan
                    </label>
                    <input wire:model.defer="bulan" type="month" autocomplete="off">
                </div>
            </div>
            <div class="rekap-box">
                <div class="rekap-field">
                    <label for="">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        Nama Pegawai
                    </label>
                    <input type="text" class="filter-input dont-wire" autocomplete="off" placeholder="Cari Nama Pegawai">
                </div>
                <div class="related-list" style="margin-top: -3px;width: 100%">
                    @can('highOfficer')
                        @foreach ($departemens as $depar)
                            @foreach ($depar->jadwals as $jadwal)
                                @foreach ($jadwal->jabatans as $jabatan)
                                    @foreach ($jabatan->pegawais as $pegawai)
                                        <p class="wire-filter">
                                            <span class="related-title">{{ $pegawai->nama }}</span>
                                            <input wire:model.defer="pegawai_id" type="radio" name="pegawai" value="{{ $pegawai->id }}">
                                        </p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        @foreach ($departemens as $depar)
                            @if ($depar->id == Auth::user()->departemen_id)
                                @foreach ($depar->jadwals as $jadwal)
                                    @foreach ($jadwal->jabatans as $jabatan)
                                        @foreach ($jabatan->pegawais as $pegawai)
                                            <p class="wire-filter">
                                                <span class="related-title">{{ $pegawai->nama }}</span>
                                                <input wire:model.defer="pegawai_id" type="radio" name="pegawai" value="{{ $pegawai->id }}">
                                            </p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    @endcan
                </div>
            </div>
            <div class="rekap-box" style="padding-top: 24px; margin-left: -12px;">
                <div wire:click="render" class="btn on btn-icon evented-btn">
                    <i class="fa-solid fa-filter"></i>
                </div>
            </div>
        </div>
        <div class="data-grid rekap-grid">
            <table id="presensi" class="rekap-table big-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Pulang</th>
                        <th style="text-align: left">Aktivitas</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove>
                    @if (!empty($pegawai_id))
                        @foreach ($days_in_month as $day)
                            @if ($day['status'] === 'Aktif' && $day['keterangan_kehadiran'] === 'Hadir')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($day['tanggal'])->isoFormat('dddd') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($day['tanggal'])->isoFormat('D MMMM Y') }}</td>
                                    <td>
                                        {{ $day['masuk'] }} WIB
                                        <span class="tip-span">{{ $day['keterangan_masuk'] }}</span>
                                    </td>
                                    <td>
                                        {{ $day['keluar'] }} WIB
                                        <span class="tip-span">{{ $day['keterangan_keluar'] }}</span>
                                    </td>
                                    <td style="text-align: left">
                                        <ul>
                                            @foreach ($day['aktivitas'] as $aktivitas)
                                                <li>{{ $aktivitas }}</li>
                                                <br>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @elseif ($day['status'] === 'Libur')
                                <tr class="libur-row">
                                    <td colspan="7" class="blocked-row">
                                        {{ \Carbon\Carbon::parse($day['tanggal'])->isoFormat('dddd, D MMMM Y') }}
                                        <span class="tip-span">{{ $day['keterangan_libur'] }}</span>
                                    </td>
                                </tr>
                            @elseif ($day['status'] === 'Izin')
                                <tr class="izin-row">
                                    <td colspan="7" class="blocked-row">
                                        {{ \Carbon\Carbon::parse($day['tanggal'])->isoFormat('dddd, D MMMM Y') }}
                                        <span class="tip-span">{{ $day['keterangan_libur'] }}</span>
                                    </td>
                                </tr>
                            @elseif ($day['status'] === 'Aktif' && $day['keterangan_kehadiran'] === 'Alpha')
                                <tr class="alpha-row">
                                    <td colspan="7" class="blocked-row">
                                        {{ \Carbon\Carbon::parse($day['tanggal'])->isoFormat('dddd, D MMMM Y') }}
                                        <span class="tip-span">Tidak Masuk Tanpa Keterangan</span>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div wire:loading.delay class="load-wrapper">
            <div class="loading-layer">
                <i class="fa-solid fa-spinner"></i>
            </div>
        </div>
    </div>
</div>