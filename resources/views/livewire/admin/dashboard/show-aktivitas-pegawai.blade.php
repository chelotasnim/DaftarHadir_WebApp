<tbody wire:poll>
    @foreach ($aktivitases as $aktivitas)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="col-left">{{ $aktivitas->pegawai->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($aktivitas->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
            <td>{{ $aktivitas->mulai }} WIB</td>
            <td>{{ $aktivitas->sampai }} WIB</td>
            <td>{{ $aktivitas->jenis }}</td>
            <td class="col-left text-col">{{ $aktivitas->keterangan_aktivitas }}</td>
            <td class="action">
                <span onclick="showModal({{ $aktivitas->id }}, 'change')" class="as-label yellow modal-trigger">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <span onclick="showModal({{ $aktivitas->id }}, 'destroy')" class="as-label red modal-trigger">
                    <i class="fa-solid fa-trash-can"></i>
                </span>
            </td>
        </tr>
    @endforeach
</tbody>