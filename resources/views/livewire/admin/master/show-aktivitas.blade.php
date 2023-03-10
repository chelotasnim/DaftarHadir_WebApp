<tbody wire:poll>
    @can('highOfficer')
        @foreach ($departemens as $depar)
            @foreach ($depar->aktivitas as $aktivitas)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="col-left">{{ $aktivitas->departemen->nama_dept }}</td>
                    <td class="col-left">{{ $aktivitas->aktivitas }}</td>
                    <td>
                        @if ($aktivitas->status === 'Aktif')
                                <span class="as-label green">{{ $aktivitas->status }}</span>
                            @else
                                <span class="as-label red">{{ $aktivitas->status }}</span>
                            @endif
                    </td>
                    @can('manager')
                        <td class="action">
                            <span onclick="showModal({{ $aktivitas->id }}, 'change')" class="as-label yellow modal-trigger">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span onclick="showModal({{ $aktivitas->id }}, 'destroy')" class="as-label red modal-trigger">
                                <i class="fa-solid fa-trash-can"></i>
                            </span>
                        </td>
                    @endcan                   
                </tr>
            @endforeach
        @endforeach
    @else
        @foreach ($departemens as $depar)
            @if ($depar->id == Auth::user()->departemen_id)
                @foreach ($depar->aktivitas as $aktivitas)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="col-left">{{ $aktivitas->aktivitas }}</td>
                        <td>
                            @if ($aktivitas->status === 'Aktif')
                                    <span class="as-label green">{{ $aktivitas->status }}</span>
                                @else
                                    <span class="as-label red">{{ $aktivitas->status }}</span>
                                @endif
                        </td>
                        @can('manager')
                            <td class="action">
                                <span onclick="showModal({{ $aktivitas->id }}, 'change')" class="as-label yellow modal-trigger">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <span onclick="showModal({{ $aktivitas->id }}, 'destroy')" class="as-label red modal-trigger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </span>
                            </td>
                        @endcan                   
                    </tr>
                @endforeach
            @endif
        @endforeach
    @endcan
</tbody>