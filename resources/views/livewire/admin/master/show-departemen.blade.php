<tbody wire:poll>
    @foreach ($departemens as $departemen)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="col-left">{{ $departemen->nama_dept }}</td>
            <td class="col-left">{{ $departemen->atasan1 }} - {{ $departemen->telp_1 }}</td>
            <td class="col-left">{{ $departemen->atasan2 }} - {{ $departemen->telp_2 }}</td>
            <td class="col-left">{{ $departemen->atasan3 }} - {{ $departemen->telp_3 }}</td>
            <td>
                @if ($departemen->status === 'Aktif')
                    <span class="as-label green">{{ $departemen->status }}</span>
                @else
                    <span class="as-label red">{{ $departemen->status }}</span>
                @endif
            </td>
            <td class="action">
                <span onclick="showModal({{ $departemen->id }}, 'change')" class="as-label yellow modal-trigger">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <span onclick="showModal({{ $departemen->id }}, 'destroy')" class="as-label red modal-trigger">
                    <i class="fa-solid fa-trash-can"></i>
                </span>
            </td>
        </tr>
    @endforeach
</tbody>