<tbody wire:poll>
    @php
        $noUrut = 1;
    @endphp
    @can('highOfficer')
        @foreach ($departemens as $depar)
            @foreach ($depar->jadwals as $jadwal)
                @if ($jadwal->type === 'Shift')
                    <tr>
                        <th>{{ $noUrut++ }}</th>
                        <th class="col-left">{{ $jadwal->departemen->nama_dept }}</th>
                        <th class="col-left">{{ $jadwal->nama_jadwal }}</th>
                        <th class="col-left">{{ $jadwal->keterangan_jadwal }}</th>
                        <td>
                            @if ($jadwal->status === 'Aktif')
                                <span class="as-label green">{{ $jadwal->status }}</span>
                            @else
                                <span class="as-label red">{{ $jadwal->status }}</span>
                            @endif
                        </td>
                            <td class="action">
                                <span onclick="showModal({{ $jadwal->id }}, 'change')" class="as-label yellow modal-trigger">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <span onclick="showModal({{ $jadwal->id }}, 'destroy')" class="as-label red modal-trigger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </span>
                            </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    @else
        @foreach ($departemens as $depar)
            @if ($depar->id == Auth::user()->departemen_id)
                @foreach ($depar->jadwals as $jadwal)
                    @if ($jadwal->type === 'Shift')
                        <tr>
                            <th>{{ $noUrut++ }}</th>
                            <th class="col-left">{{ $jadwal->nama_jadwal }}</th>
                            <th class="col-left">{{ $jadwal->keterangan_jadwal }}</th>
                            <td>
                                @if ($jadwal->status === 'Aktif')
                                    <span class="as-label green">{{ $jadwal->status }}</span>
                                @else
                                    <span class="as-label red">{{ $jadwal->status }}</span>
                                @endif
                            </td>
                                <td class="action">
                                    <span onclick="showModal({{ $jadwal->id }}, 'change')" class="as-label yellow modal-trigger">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span onclick="showModal({{ $jadwal->id }}, 'destroy')" class="as-label red modal-trigger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </span>
                                </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endcan
</tbody>