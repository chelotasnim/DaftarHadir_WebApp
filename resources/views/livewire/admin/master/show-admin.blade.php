<tbody wire:poll>
    @foreach ($admins as $admin)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="col-left">{{ $admin->name }}</td>
            <td class="col-left">
                @if (isset($admin->pegawai->nama))
                    {{ $admin->pegawai->nama }}
                @else
                    ADMIN UTAMA
                @endif
            </td>
            <td class="col-left">
                @if (isset($admin->pegawai->jabatan->jadwal->departemen->nama_dept))
                    {{ $admin->pegawai->jabatan->jadwal->departemen->nama_dept }}
                @else
                    ADMIN UTAMA
                @endif
            </td>
            <td class="col-left">
                @if (isset($admin->pegawai->jabatan->jabatan))
                    {{ $admin->pegawai->jabatan->jabatan }}
                @else
                    ADMIN UTAMA
                @endif
            </td>
            <td>
                @if ($admin->peran === 'Pengelola Utama' || $admin->peran === 'Atasan Utama')
                    <span class="as-label red">{{ $admin->peran }}</span>
                @else
                    <span class="as-label">{{ $admin->peran }}</span>
                @endif
            </td>
            <td>
                @if ($admin->status === 'Aktif')
                    <span class="as-label green">{{ $admin->status }}</span>
                @else
                    <span class="as-label red">{{ $admin->status }}</span>
                @endif
            </td>
            <td class="action">
                @if ($admin->peran === 'Pengelola Utama' || $admin->peran === 'Atasan Utama')
                    <span class="as-label grey" style="cursor: not-allowed">
                        <i class="fa-solid fa-ban"></i>
                    </span>
                @else 
                    <span onclick="showModal({{ $admin->id }}, 'change')" class="as-label yellow modal-trigger">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <span onclick="showModal({{ $admin->id }}, 'destroy')" class="as-label red modal-trigger">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                @endif
            </td>                    
        </tr>
    @endforeach
</tbody>