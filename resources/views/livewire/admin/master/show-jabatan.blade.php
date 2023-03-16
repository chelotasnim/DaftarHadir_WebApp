<tbody wire:poll>
    @if (empty(Auth::user()->departemen_id))
        @foreach ($departemens as $depar)
            @foreach ($depar->jadwals as $jadwal)
                @foreach ($jadwal->jabatans as $jabatan)    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="col-left">{{ $jabatan->jadwal->departemen->nama_dept }}</td>
                        <td class="col-left">{{ $jabatan->jabatan }}</td>
                        <td class="col-left">{{ $jabatan->jadwal->nama_jadwal }}</td>
                        <td class="col-price">{{ $jabatan->gaji }}</td>
                        <td>
                            @if ($jabatan->status === 'Aktif')
                                <span class="as-label green">{{ $jabatan->status }}</span>
                            @else
                                <span class="as-label red">{{ $jabatan->status }}</span>
                            @endif
                        </td>
                        <td class="action">
                            <span onclick="showModal({{ $jabatan->id }}, 'change')" class="as-label yellow modal-trigger">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span onclick="showModal({{ $jabatan->id }}, 'destroy')" class="as-label red modal-trigger">
                                <i class="fa-solid fa-trash-can"></i>
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    @else
        @foreach ($departemens as $depar)
            @if ($depar->id == Auth::user()->departemen_id)    
                @foreach ($depar->jadwals as $jadwal)
                    @foreach ($jadwal->jabatans as $jabatan)    
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="col-left">{{ $jabatan->jabatan }}</td>
                            <td class="col-left">{{ $jabatan->jadwal->nama_jadwal }}</td>
                            <td class="col-price">{{ $jabatan->gaji }}</td>
                            <td>
                                @if ($jabatan->status === 'Aktif')
                                    <span class="as-label green">{{ $jabatan->status }}</span>
                                @else
                                    <span class="as-label red">{{ $jabatan->status }}</span>
                                @endif
                            </td>
                            <td class="action">
                                <span onclick="showModal({{ $jabatan->id }}, 'change')" class="as-label yellow modal-trigger">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <span onclick="showModal({{ $jabatan->id }}, 'destroy')" class="as-label red modal-trigger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        @endforeach 
    @endif
</tbody>