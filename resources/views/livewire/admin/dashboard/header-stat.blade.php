<div wire:poll class="statistic-header">
    @can('highOfficer')        
        <div class="horizon-card">
            <div class="card-row">
                <div class="card-desc">
                    <h5>Total Departemen</h5>
                    <a href="/dashboard/master/departemen">Kelola Departemen</a>
                </div>
                <div class="card-icon">
                    <i class="fa-regular fa-building"></i>
                </div>
            </div>
            <div class="card-row">
                <div class="card-val">
                    <span>{{ $departemen }}</span> Departemen
                </div>
                <div class="card-percentage na-percen">
                    <p>--;--</p>
                </div>
            </div>
        </div>
    @endcan
    <div class="horizon-card">
        <div class="card-row">
            <div class="card-desc">
                <h5>Total Pegawai</h5>
                <a href="/dashboard/master/pegawai">Kelola Pegawai</a>
            </div>
            <div class="card-icon">
                <i class="fa-regular fa-id-badge"></i>
            </div>
        </div>
        <div class="card-row">
            <div class="card-val">
                <span>
                    @php
                        $total_pegawai = 0;
                    @endphp
                    @can('highOfficer')                        
                        @foreach ($allDepar as $depar)
                            @foreach ($depar->jadwals as $jadwal)
                                @foreach ($jadwal->jabatans as $jabatan)
                                    @php
                                        $total_pegawai += $jabatan->pegawais->count()
                                    @endphp
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        @foreach ($allDepar as $depar)
                            @if ($depar->id == Auth::user()->departemen_id)
                                @foreach ($depar->jadwals as $jadwal)
                                    @foreach ($jadwal->jabatans as $jabatan)
                                        @php
                                            $total_pegawai += $jabatan->pegawais->count()
                                        @endphp
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    @endcan
                    {{ $total_pegawai }}
                </span> Pegawai
            </div>
            <div class="card-percentage na-percen">
                <p>--;--</p>
            </div>
        </div>
    </div>
    <div class="horizon-card important">
        <div class="card-row">
            <div class="card-desc">
                <h5>Total Presensi Hadir</h5>
                <a>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</a>
            </div>
            <div class="card-icon">
                <i class="fa-solid fa-users-viewfinder"></i>
            </div>
        </div>
        <div class="card-row">
            <div class="card-val">
                <span>{{ $hadir }}</span> Pegawai
            </div>
            @if ($hadir < $hadir_kemarin)
                <div class="card-percentage down-percen">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                    @if ($hadir === 0)
                        <p>{{ number_format((float)$hadir_kemarin * 100 / 1, 1) }}%</p>
                    @else
                        <p>{{ number_format((float)$hadir_kemarin * 100 / $hadir, 1) }}%</p>
                    @endif
                    <span class="percen-more">Dari hari sebelumnya</span>
                </div>
            @elseif ($hadir >= $hadir_kemarin)
                <div class="card-percentage up-percen">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    @if ($hadir_kemarin === 0)
                        <p>{{ number_format((float)$hadir * 100 / 1, 1) }}%</p>
                    @else
                        <p>{{ number_format((float)$hadir * 100 / $hadir_kemarin, 1) }}%</p>
                    @endif
                    <span class="percen-more">Dari hari sebelumnya</span>
                </div>
            @endif
        </div>
    </div>
</div> 