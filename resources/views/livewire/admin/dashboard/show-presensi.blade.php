<tbody wire:poll>
    @foreach ($presensis as $presensi)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="col-left">{{ $presensi->pegawai->nama }}</td>
            @can('highOfficer')
                <td class="col-left">{{ $presensi->pegawai->jabatan->jadwal->departemen->nama_dept }}</td>
            @endcan
            <td>{{ $presensi->type }}</td>
            <td>
                @if (!empty($presensi->check_log))
                    {{ $presensi->check_log }} WIB
                @else
                    {{ '--:--' }}
                @endif
            </td>
            <td class="col-left">{{ $presensi->catatan }}</td>
            <td>
                @if ($presensi->keterangan === 'Hadir')
                    <span class="as-label">{{ $presensi->keterangan }}</span>
                @endif
                @if ($presensi->keterangan === 'Terlambat')
                    <span class="as-label yellow">{{ $presensi->keterangan }}</span>
                @endif
                @if ($presensi->keterangan === 'Tidak Check Log')
                    <span class="as-label red">{{ $presensi->keterangan }}</span>
                @endif
                @if ($presensi->keterangan === 'Keluar Awal')
                    <span class="as-label yellow">{{ $presensi->keterangan }}</span>
                @endif
                @if ($presensi->keterangan === 'Keluar')
                    <span class="as-label green">{{ $presensi->keterangan }}</span>
                @endif
                @if ($presensi->keterangan === 'Belum Check Log')
                    <span class="as-label">{{ $presensi->keterangan }}</span>
                @endif
            </td>
            @if ($presensi->keterangan !== 'Belum Check Log')
                <td class="action">
                    <span onclick="showModal({{ $presensi->id }}, 'destroy')" class="as-label red modal-trigger">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                </td>
            @else
                <td class="action">
                    <span class="as-label modal-trigger">
                        <i class="fa-solid fa-spinner"></i>
                    </span>
                </td>
            @endif
        </tr>
    @endforeach
</tbody>