<tbody wire:poll>
    @can('highOfficer')
        @foreach ($departemens as $depar)
            @foreach ($depar->liburKhusus as $libur)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="col-left">{{ $libur->departemen->nama_dept }}</td>
                    <td class="col-left">{{ $libur->nama_libur }}</td>
                    <td>
                        @if ($libur->mulai == $libur->sampai)
                            {{ \Carbon\Carbon::parse($libur->mulai)->isoFormat('D MMMM Y') }}
                        @else
                            {{ \Carbon\Carbon::parse($libur->mulai)->isoFormat('D MMMM Y') }} <br> s.d <br> {{ \Carbon\Carbon::parse($libur->sampai)->isoFormat('D MMMM Y') }}
                        @endif
                    </td>
                    <td class="col-left">{{ $libur->pengumuman }}</td>
                        <td class="action">
                            <span onclick="showModal({{ $libur->id }}, 'change')" class="as-label yellow modal-trigger">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span onclick="showModal({{ $libur->id }}, 'destroy')" class="as-label red modal-trigger">
                                <i class="fa-solid fa-trash-can"></i>
                            </span>
                        </td>
                </tr>
            @endforeach
        @endforeach
    @else
        @foreach ($departemens as $depar)
            @if ($depar->id == Auth::user()->departemen_id)
                @foreach ($depar->liburKhusus as $libur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="col-left">{{ $libur->departemen->nama_dept }}</td>
                        <td class="col-left">{{ $libur->nama_libur }}</td>
                        <td>
                            @if ($libur->mulai == $libur->sampai)
                                {{ \Carbon\Carbon::parse($libur->mulai)->isoFormat('D MMMM Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($libur->mulai)->isoFormat('D MMMM Y') }} <br> s.d <br> {{ \Carbon\Carbon::parse($libur->sampai)->isoFormat('D MMMM Y') }}
                            @endif
                        </td>
                        <td class="col-left">{{ $libur->pengumuman }}</td>
                            <td class="action">
                                <span onclick="showModal({{ $libur->id }}, 'change')" class="as-label yellow modal-trigger">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <span onclick="showModal({{ $libur->id }}, 'destroy')" class="as-label red modal-trigger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </span>
                            </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    @endcan
</tbody>