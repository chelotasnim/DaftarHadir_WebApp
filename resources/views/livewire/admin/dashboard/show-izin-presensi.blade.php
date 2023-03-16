<tbody wire:poll>
    @foreach ($izins as $izin)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $izin->pegawai->nip }}</td>
            <td class="col-left">{{ $izin->pegawai->nama }}</td>
            @can('highOfficer')
                <td class="col-left">{{ $izin->pegawai->jabatan->jadwal->departemen->nama_dept }}</td>
            @endcan
            <td>
                @if ($izin->mulai == $izin->sampai)
                    {{ \Carbon\Carbon::parse($izin->mulai)->isoFormat('D MMMM Y') }}
                @else
                    {{ \Carbon\Carbon::parse($izin->mulai)->isoFormat('D MMMM Y') }} <br> s.d <br> {{ \Carbon\Carbon::parse($izin->sampai)->isoFormat('D MMMM Y') }}
                @endif
            </td>
            <td><span class="as-label">{{ $izin->keterangan }}</span></td>
            <td><a href="{{ asset('storage') }}/{{ $izin->lampiran }}" class="as-label" target="_blank">Lihat Lampiran</a></td>
                <td class="action">
                    <span onclick="showModal({{ $izin->id }}, 'change')" class="as-label yellow modal-trigger">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <span onclick="showModal({{ $izin->id }}, 'destroy')" class="as-label red modal-trigger">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                </td>
        </tr>
    @endforeach
</tbody>