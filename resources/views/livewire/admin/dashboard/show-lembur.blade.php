<tbody wire:poll>
    @foreach ($lemburs as $lembur)
        <tr>
            <td>{{ $number++ }}</td>
            <td class="col-left">{{ $pegawai->nama }}</td>
            @can('highOfficer')
                <td class="col-left">{{ $pegawai->jabatan->jadwal->departemen->nama_dept }}</td>
            @endcan
            <td>{{ \Carbon\Carbon::parse($lembur->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
            <td>{{ $lembur->mulai }} WIB</td>
            <td>{{ $lembur->sampai }} WIB</td>
            <td class="col-left text-col">{{ $lembur->keterangan_aktivitas }}</td>
            @can('manager')
                <td class="action">
                    <span onclick="showModal({{ $lembur->id }}, 'change')" class="as-label yellow modal-trigger">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <span onclick="showModal({{ $lembur->id }}, 'destroy')" class="as-label red modal-trigger">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                </td>
            @endcan
        </tr>
    @endforeach
</tbody>