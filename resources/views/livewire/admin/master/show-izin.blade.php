<tbody wire:poll>
    @foreach ($izins as $izin)    
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="col-left">{{ $izin->keterangan_izin }}</td>
            <td>
                <span class="as-label">{{ $izin->kode_izin }}</span>
            </td>
            @can('manager')
                <td class="action">
                    <span onclick="showModal({{ $izin->id }}, 'change')" class="as-label yellow modal-trigger">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <span onclick="showModal({{ $izin->id }}, 'destroy')" class="as-label red modal-trigger">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                </td>
            @endcan
        </tr>
    @endforeach
</tbody>