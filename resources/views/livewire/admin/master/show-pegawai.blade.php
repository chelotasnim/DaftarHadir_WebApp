<tbody>
    @can('highManager')
        @php
            $number = 1;
        @endphp
        @foreach ($departemens as $departemen)
            @foreach ($departemen->jadwals as $jadwal)
                @foreach ($jadwal->jabatans as $jabatan)
                    @foreach ($jabatan->pegawais as $pegawai)    
                        <tr>
                            <td>{{ $number++ }}</td>
                            <td>{{ $pegawai->nip }}</td>
                            <td class="col-left">{{ $pegawai->nama }}</td>
                            <td class="col-left">{{ $pegawai->jabatan->jadwal->departemen->nama_dept }}</td>
                            <td class="col-left">{{ $pegawai->jabatan->jabatan }}</td>
                            <td class="col-price">{{ $pegawai->jabatan->gaji + $pegawai->tunjangan_bulan_ini }}</td>
                            <td>{{ $pegawai->no_wa }}</td>
                            <td>
                                @if ($jabatan->status === 'Aktif')
                                    <span class="as-label green">{{ $jabatan->status }}</span>
                                @else
                                    <span class="as-label red">{{ $jabatan->status }}</span>
                                @endif
                            </td>
                            @can('manager')
                                <td class="action">
                                    <span onclick="showModal({{ $pegawai->id }}, 'change')" class="as-label yellow modal-trigger">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span onclick="showModal({{ $pegawai->id }}, 'destroy')" class="as-label red modal-trigger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </span>
                                </td>
                            @endcan               
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
    @else
        @foreach ($departemens as $departemen)
            @if ($departemen->id == Auth::user()->departemen_id)
                @foreach ($departemen->jadwals as $jadwal)
                    @foreach ($jadwal->jabatans as $jabatan)
                        @foreach ($jabatan->pegawais as $pegawai)    
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pegawai->nip }}</td>
                                <td class="col-left">{{ $pegawai->nama }}</td>
                                <td class="col-left">{{ $pegawai->jabatan->jabatan }}</td>
                                <td class="col-price">{{ $pegawai->jabatan->gaji + $pegawai->tunjangan_bulan_ini }}</td>
                                <td>{{ $pegawai->no_wa }}</td>
                                <td>
                                    @if ($jabatan->status === 'Aktif')
                                        <span class="as-label green">{{ $jabatan->status }}</span>
                                    @else
                                        <span class="as-label red">{{ $jabatan->status }}</span>
                                    @endif
                                </td>
                                @can('manager')
                                    <td class="action">
                                        <span onclick="showModal({{ $pegawai->id }}, 'change')" class="as-label yellow modal-trigger">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </span>
                                        <span onclick="showModal({{ $pegawai->id }}, 'destroy')" class="as-label red modal-trigger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </span>
                                    </td>
                                @endcan               
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            @endif
        @endforeach
    @endcan
</tbody>