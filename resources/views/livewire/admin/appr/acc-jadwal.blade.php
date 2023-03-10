<div wire:poll class="data-template">
    <div class="req-card-container">
        <p class="no-data"><span><i class="fa-regular fa-envelope-open"></i></span> Belum ada pengajuan</p>
        @foreach ($allAdmin as $admin)
            @foreach ($admin->reqJadwal as $req)
                <div class="req-card">
                    <div class="req-head">
                        <p class="tip">Pengajuan</p>
                        <h5>{{ $req->jenis_pengajuan }}</h5>
                        @if ($req->status_pengajuan === 'Menunggu Approval')
                            <div class="req-status">{{ $req->status_pengajuan }}</div>                            
                        @endif
                        @if ($req->status_pengajuan === 'Approved')
                            <div class="req-status approved">{{ $req->status_pengajuan }}</div>                            
                        @endif
                        @if ($req->status_pengajuan === 'Refused')
                            <div class="req-status refused">{{ $req->status_pengajuan }}</div>                            
                        @endif
                        <div class="req-action">
                            @if ($req->status_pengajuan === 'Menunggu Approval')
                                <span wire:click="approved({{ $req->id }})" class="as-label evented-btn green">
                                    <i class="fa-solid fa-check"></i>
                                    Approve
                                </span>
                                <span wire:click="refused({{ $req->id }})" class="as-label evented-btn red refuse-btn">
                                    <i class="fa-solid fa-xmark"></i>
                                    Refuse
                                </span>
                            @else
                                <span wire:click="trash({{ $req->id }})" onclick="noData()" class="as-label evented-btn grey">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Buang (Telah Diverifikasi)
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="req-desc">
                        <p class="desc-title">Keterangan</p>
                        <p class="desc-sender">
                            {{ $req->keterangan_pengirim }}
                        </p>
                        <p class="desc-author">By : {{ $req->sender->name }}</p>
                        <span onclick="showModal({{ $req->id }}, 'more')" class="as-label evented-btn modal-trigger">
                            Lihat Detail
                        </span>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

    <div class="data-modal acc-modal">
        @foreach ($allAdmin as $admin)
            @foreach ($admin->reqJadwal as $req)
                <div class="modal-card">
                    <span class="modal-id">{{ $req->id }}</span>
                    <span class="modal-fn">more</span>
                    <div class="form-head-type-2">
                        <p>Pengajuan</p>
                        <h5>{{ $req->jenis_pengajuan }}</h5>
                    </div>
                    <div class="form-form">
                        @if ($req->jenis_pengajuan === 'Perubahan')
                            <div class="change-list">
                                {!! $req->list_perubahan !!}
                            </div>
                        @else
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" value="{{ $req->departemen->nama_dept }}" autocomplete="off" disabled>
                                </div>
                                <div class="form-field">
                                    <label for="nama">Nama Jadwal</label>
                                    <input name="nama_jadwal" id="nama" type="text" value="{{ $req->nama_jadwal }}" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="jadwal_ket">Keterangan Jadwal</label>
                                    <input name="keterangan_jadwal" id="jadwal_ket" type="text" value="{{ $req->keterangan_jadwal }}" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field day-label">
                                    <p>Lihat Hari :</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field select-day">
                                    <div class="day-box just-view active">Senin</div>
                                    <div class="day-box just-view">Selasa</div>
                                    <div class="day-box just-view">Rabu</div>
                                    <div class="day-box just-view">Kamis</div>
                                    <div class="day-box just-view">Jumat</div>
                                    <div class="day-box just-view">Sabtu</div>
                                    <div class="day-box just-view">Minggu</div>                    
                                </div>
                            </div>
                            <div count-log="0" class="day-is-senin wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Senin')
                                        <div class="form-row log-row" style="display: block">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px; display; block">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div count-log="0" class="day-is-selasa wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Selasa')
                                        <div class="form-row log-row">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div count-log="0" class="day-is-rabu wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Rabu')
                                        <div class="form-row log-row">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div count-log="0" class="day-is-kamis wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Kamis')
                                        <div class="form-row log-row">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div count-log="0" class="day-is-jumat wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Jumat')
                                        <div class="form-row log-row">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div count-log="0" class="day-is-sabtu wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Sabtu')
                                        <div class="form-row log-row">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div count-log="0" class="day-is-minggu wrap-check-day">
                                @foreach ($req->details as $detail)
                                    @if ($detail->hari === 'Minggu')
                                        <div class="form-row log-row">
                                            <div class="form-field">
                                                <label>Type</label>
                                                <input type="text" value="{{ $detail->log_type }}" autocomplete="off" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Batasan Awal/Akhir</label>
                                                @php
                                                    $explode_jadwal = explode(':', $detail->log_limit);

                                                    if((int)$explode_jadwal[0] < 10) {
                                                        $explode_jadwal[0] = '0' . $explode_jadwal[0];
                                                    };

                                                    if((int)$explode_jadwal[1] < 10) {
                                                        $explode_jadwal[1] = '0' . $explode_jadwal[1];
                                                    };
                                                @endphp
                                                <input type="text" value="{{ $explode_jadwal[0] . ':' . $explode_jadwal[1] }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="margin-bottom: 8px">
                                            <div class="form-field">
                                                <label>Mulai Pukul</label>
                                                <input type="text" value="{{ $detail->log_time }}" disabled>
                                            </div>
                                            <div class="form-field">
                                                <label>Sampai Pukul</label>
                                                <input type="text" value="{{ $detail->log_range }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                         @endif
                    </div>
                    <div onclick="closeModal(this)" class="close-btn">
                        <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>