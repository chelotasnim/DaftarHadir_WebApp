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
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('aktivitas', 'Aktivitas Karyawan {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM Y') }}')">Ekspor XLS</button>
                @else
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('aktivitas', 'Aktivitas Karyawan {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}')">Ekspor XLS</button>
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
                    <input type="text" class="filter-input" autocomplete="off" placeholder="Cari Nama Pegawai">
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
            <table id="aktivitas" class="rekap-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: left">Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Aktivitas</th>
                        <th style="text-align: left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aktivitas_pegawai as $aktivitas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align: left">{{ $aktivitas->pegawai->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($aktivitas->tanggal)->isoFormat('dddd, M DDDD Y') }}</td>
                            <td>{{ $aktivitas->mulai }} WIB</td>
                            <td>{{ $aktivitas->sampai }} WIB</td>
                            <td>{{ $aktivitas->jenis }}</td>
                            <td style="text-align: left">{{ $aktivitas->keterangan_aktivitas }}</td>
                        </tr>
                    @endforeach
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