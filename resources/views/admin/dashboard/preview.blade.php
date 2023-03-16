@extends('admin.layout.master')

@section('admin')

<div class="data-template">
    <div class="data-content" style="margin-top: 0">
        <div class="data-controller">
            <div class="controller-role">
                <div onclick="history.back()" class="controller-btn evented-btn">
                    <i class="fa-solid fa-square-caret-left"></i>
                    Kembali
                </div>
            </div>
            <div class="controller-date">
                Preview Data {{ ucwords($used_data) }} Pegawai @if ($used_data != 'lembur')
                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                @endif
            </div>
            @can('manager')
                <div class="controller-box">
                    @if ($used_data === 'presensi')
                        <button class="controller-btn evented-btn" onclick="exportTableToExcel('presensi', 'Presensi Karyawan {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}')">
                            <i class="fa-solid fa-download"></i>
                            Ekspor XLS
                        </button>
                    @endif
                    @if ($used_data === 'izin')
                        <button class="controller-btn evented-btn" onclick="exportTableToExcel('izin', 'Izin Karyawan {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}')">
                            <i class="fa-solid fa-download"></i>
                            Ekspor XLS
                        </button>
                    @endif
                    @if ($used_data === 'aktivitas')
                        <button class="controller-btn evented-btn" onclick="exportTableToExcel('aktivitas', 'Aktivitas Karyawan {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}')">
                            <i class="fa-solid fa-download"></i>
                            Ekspor XLS
                        </button>
                    @endif
                    @if ($used_data === 'lembur')
                    <button class="controller-btn evented-btn" onclick="exportTableToExcel('lembur', 'Lembur Karyawan')">
                        <i class="fa-solid fa-download"></i>
                        Ekspor XLS
                    </button>
                @endif
                </div>
            @endcan
        </div>
    </div>
    <div class="data-grid rekap-grid preview-table">
        @if ($used_data === 'presensi')
            <table id="presensi" class="rekap-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: left">Nama Pegawai</th>
                        <th>Jenis</th>
                        <th>Check Log</th>
                        <th>Keterangan</th>
                        <th style="text-align: left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $presensi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align: left">{{ $presensi->pegawai->nama }}</td>
                            <td>{{ $presensi->type }}</td>
                            <td>{{ $presensi->check_log }} WIB</td>
                            <td>{{ $presensi->keterangan }}</td>
                            <td style="text-align: left">{{ $presensi->catatan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($used_data === 'izin')
            <table id="izin" class="rekap-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: left">Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $izin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align: left">{{ $izin->pegawai->nama }}</td>
                            <td>
                                @if ($izin->mulai == $izin->sampai)
                                    {{ \Carbon\Carbon::parse($izin->mulai)->isoFormat('D MMMM Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($izin->mulai)->isoFormat('D MMMM Y') }} <br> s.d <br> {{ \Carbon\Carbon::parse($izin->sampai)->isoFormat('D MMMM Y') }}
                                @endif
                            </td>
                            <td>{{ $izin->keterangan }}</td>
                            <td>
                                <a style="display: block;margin: 0 auto;" class="as-label" href="{{ asset('storage') }}/{{ $izin->lampiran }}" target="_blank">Lihat lampiran disini</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($used_data === 'aktivitas')
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
                    @foreach ($datas as $aktivitas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align: left">{{ $aktivitas->pegawai->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($aktivitas->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>{{ $aktivitas->mulai }} WIB</td>
                            <td>{{ $aktivitas->sampai }} WIB</td>
                            <td>{{ $aktivitas->jenis }}</td>
                            <td style="text-align: left">{{ $aktivitas->keterangan_aktivitas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($used_data === 'lembur')
        <table id="lembur" class="rekap-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: left">Nama Pegawai</th>
                    <th>Tanggal</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th style="text-align: left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $lembur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left">{{ $lembur->pegawai->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($lembur->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td>{{ $lembur->mulai }} WIB</td>
                        <td>{{ $lembur->sampai }} WIB</td>
                        <td style="text-align: left">{{ $lembur->keterangan_aktivitas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>
</div>

@endsection