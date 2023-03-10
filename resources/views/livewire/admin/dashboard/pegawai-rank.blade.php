<tbody wire:poll.60000ms>
    @foreach ($departemens as $depar)
        @foreach ($depar->jadwals as $jadwal)
            @foreach ($jadwal->jabatans as $jabatan)
                @foreach ($jabatan->pegawais as $pegawai)
                    @if (isset($rank[(string)$pegawai->id]))
                        <tr>
                            <td class="col-image">
                                @if ($rank[(string)$pegawai->id]['medal'] === 'C-')
                                    <h1 class="c-min-rank">C-</h1>
                                @endif
                                @if ($rank[(string)$pegawai->id]['medal'] === 'D')
                                    <h1 class="d-rank">D</h1>
                                @endif
                                @if ($rank[(string)$pegawai->id]['medal'] === 'E')
                                    <h1 class="e-rank">E</h1>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $pegawai->nama }}</strong>
                            </td>
                            <td>
                                {{ $pegawai->jabatan->jadwal->departemen->nama_dept }}
                            </td>
                            <td>
                                {{ $pegawai->jabatan->jabatan }}
                            </td>
                            <td class="col-center">{{ $rank[(string)$pegawai->id]['telat'] }} Check Log</td>
                            <td class="col-center">{{ $rank[(string)$pegawai->id]['alpha'] }} Hari</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @endforeach
    @endforeach
</tbody>