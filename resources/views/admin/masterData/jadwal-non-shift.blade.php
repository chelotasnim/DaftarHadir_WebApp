@extends('admin.layout.master')

@section('admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<div class="data-template">
    <div class="data-content master-template">
        <div class="data-controller">
            <div class="controller-role">
                @can('manager')
                    <i class="fa-solid fa-user-gear"></i>
                @endcan
                @can('observer')
                    <i class="fa-solid fa-user-secret"></i>
                @endcan
                {{ Auth::user()->peran }}
            </div>
                <div class="controller-box">
                    <div onclick="showModal('4dd', 'new')" class="controller-btn modal-trigger">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        Tambah Jadwal
                    </div>
                </div>
        </div>
        <div class="data-grid master-grid">
            <table id="non-shift">
                <thead>
                    <tr>
                        <th>#</th>
                        @can('highOfficer')
                            <th class="col-left">Departemen</th>
                        @endcan
                        <th class="col-left">Nama Jadwal</th>
                        <th class="col-left">Keterangan Jadwal</th>
                        <th>Status</th>
                            <th class="action">*</th>
                    </tr>
                </thead>
                @livewire('admin.master.show-jadwal')
            </table>
        </div>
    </div>

    <div class="data-modal full-page-modal">
        @if (session()->has('sended'))
        <div class="notif success new">
            <i class="fa-solid fa-square-check"></i>
            {{ session('sended') }}
        </div>
        @endif
        @if (session()->has('failed'))
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ session('failed') }}
            </div>
        @endif
        @error('departemen_id')
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $message }}
            </div>
        @enderror
        @error('nama_jadwal')
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $message }}
            </div>
        @enderror
        @error('keterangan_jadwal')
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $message }}
            </div>
        @enderror
        @error('status')
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $message }}
            </div>
        @enderror
        @error('keterangan_pengirim')
            <div class="notif new">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $message }}
            </div>
        @enderror
        <div class="modal-card">
            <div class="modal-id">4dd</div>
            <div class="modal-fn">new</div>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Penambahan Jadwal</h5>
                    <p>
                        Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <form action="/dashboard/master/req-jadwal" method="POST" class="form-form">
                @csrf
                <div class="form-row" style="margin-bottom: 8px">
                    <div class="form-field">
                        <label for="departemen">Departemen</label>
                        <input id="departemen" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div class="related-list" style="left: 0">
                        @can('highOfficer')
                            @foreach ($departemens as $depar)
                                @if ($depar->status === 'Aktif')
                                    <p>
                                        <span class="related-title">{{ $depar->nama_dept }}</span>
                                        <input type="radio" name="departemen_id" value="{{ $depar->id }}">
                                    </p>
                                @endif
                            @endforeach
                        @else
                            @foreach ($departemens as $depar)
                                @if ($depar->id == Auth::user()->departemen_id)
                                    @if ($depar->status === 'Aktif')
                                        <p>
                                            <span class="related-title">{{ $depar->nama_dept }}</span>
                                            <input type="radio" name="departemen_id" value="{{ $depar->id }}">
                                        </p>
                                    @endif
                                @endif
                            @endforeach
                        @endcan
                    </div>
                    <div class="form-field">
                        <label for="nama">Nama Jadwal</label>
                        <input name="nama_jadwal" id="nama" type="text" autocomplete="off">
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 8px">
                    <div class="form-field">
                        <label for="jadwal_ket">Keterangan Jadwal</label>
                        <input name="keterangan_jadwal" id="jadwal_ket" type="text" autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <input name="type" id="type" type="hidden" value="Non Shift" class="filter-input" autocomplete="off">
                    <div class="form-field">
                        <label for="status">Status</label>
                        <input name="status" id="status" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div class="related-list" style="width: 100%">
                        <p>
                            <span class="related-title">Aktif</span>
                        </p>
                        <p>
                            <span class="related-title">Tidak Aktif</span>
                        </p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field day-label">
                        <p>Pilih Hari :</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field select-day">
                        <div class="day-box active">Senin</div>
                        <div class="day-box">Selasa</div>
                        <div class="day-box">Rabu</div>
                        <div class="day-box">Kamis</div>
                        <div class="day-box">Jumat</div>
                        <div class="day-box">Sabtu</div>
                        <div class="day-box">Minggu</div>                    
                    </div>
                </div>
                <div class="form-row add-check-btn">
                    <div class="form-field">
                        <div class="add-check-time" btn-for-day="senin">
                            <i class="fa-solid fa-plus"></i>
                            Tambah Check Log
                        </div>
                    </div>
                </div>
                <!-- #LR VW 4L -->
                <div count-log="0" class="day-is-senin wrap-check-day">
                    <input class="total-log" name="log_total_senin" type="hidden" value="0" readonly>
                </div>
                <div count-log="0" class="day-is-selasa wrap-check-day">
                    <input class="total-log" name="log_total_selasa" type="hidden" value="0" readonly>
                </div>
                <div count-log="0" class="day-is-rabu wrap-check-day">
                    <input class="total-log" name="log_total_rabu" type="hidden" value="0" readonly>
                </div>
                <div count-log="0" class="day-is-kamis wrap-check-day">
                    <input class="total-log" name="log_total_kamis" type="hidden" value="0" readonly>
                </div>
                <div count-log="0" class="day-is-jumat wrap-check-day">
                    <input class="total-log" name="log_total_jumat" type="hidden" value="0" readonly>
                </div>
                <div count-log="0" class="day-is-sabtu wrap-check-day">
                    <input class="total-log" name="log_total_sabtu" type="hidden" value="0" readonly>
                </div>
                <div count-log="0" class="day-is-minggu wrap-check-day">
                    <input class="total-log" name="log_total_minggu" type="hidden" value="0" readonly>
                </div>
                <div class="form-row" style="margin-top: 24px">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea name="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div class="form-submit-btn">
                    <button type="submit" class="evented-btn new">Kirim Pengajuan Jadwal</button>
                </div>
            </form>
            <div onclick="closeModal(this)" class="close-btn">
                Batalkan Pengajuan
            </div>
        </div>

        @can('highOfficer')
            @foreach ($departemens as $depar)
                @foreach ($depar->jadwals as $jadwal)
                    <div class="modal-card">
                        <div class="modal-id">{{ $jadwal->id }}</div>
                        <div class="modal-fn">change</div>
                        <div class="form-head">
                            <div class="form-image">
                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                            </div>
                            <div class="form-header">
                                <h5>Formulir Pengajuan<br>Perubahan Jadwal</h5>
                                <p>
                                    Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                </p>
                            </div>
                        </div>
                        <form action="/dashboard/master/reqChange-jadwal/{{ $jadwal->id }}" method="POST" class="form-form">
                            @csrf
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" class="filter-input" autocomplete="off" placeholder="{{ $jadwal->departemen->nama_dept }}">
                                </div>
                                <div class="related-list" style="left: 0">
                                    @can('highOfficer')
                                        @foreach ($departemens as $depar)
                                            @if ($depar->status === 'Aktif')
                                                <p>
                                                    <span class="related-title">{{ $depar->nama_dept }}</span>
                                                    <input type="radio" name="departemen_id" value="{{ $depar->id }}">
                                                </p>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($departemens as $depar)
                                            @if ($depar->id == Auth::user()->departemen_id)
                                                @if ($depar->status === 'Aktif')
                                                    <p>
                                                        <span class="related-title">{{ $depar->nama_dept }}</span>
                                                        <input type="radio" name="departemen_id" value="{{ $depar->id }}">
                                                    </p>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endcan
                                </div>
                                <div class="form-field">
                                    <label for="nama">Nama Jadwal</label>
                                    <input name="nama_jadwal" id="nama" type="text" placeholder="{{ $jadwal->nama_jadwal }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="jadwal_ket">Keterangan Jadwal</label>
                                    <input name="keterangan_jadwal" id="jadwal_ket" type="text" placeholder="{{ $jadwal->keterangan_jadwal }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-row">
                                <input name="type" id="type" type="hidden" value="Non Shift" class="filter-input" autocomplete="off">
                                <div class="form-field">
                                    <label for="status">Status</label>
                                    <input name="status" id="status" type="text" class="filter-input" placeholder="{{ $jadwal->status }}" autocomplete="off">
                                </div>
                                <div class="related-list" style="width: 100%">
                                    <p>
                                        <span class="related-title">Aktif</span>
                                    </p>
                                    <p>
                                        <span class="related-title">Tidak Aktif</span>
                                    </p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field day-label">
                                    <p>Pilih Hari :</p>
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
                            <div class="form-row add-check-btn">
                                <div class="form-field">
                                    <div class="add-check-time" btn-for-day="senin">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Check Log
                                    </div>
                                </div>
                            </div>
                            <div is-there-log="0" class="day-is-senin wrap-check-day">
                                <input class="total-log" name="log_total_senin" type="hidden" value="0" readonly>
                                @php
                                    $loop_senin = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Senin')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_senin{{ $loop_senin }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_senin{{ $loop_senin }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_senin{{ $loop_senin }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input name="log_type_senin{{ $loop_senin }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_senin{{ $loop_senin }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_senin{{ $loop_senin++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-selasa wrap-check-day" style="display: none">
                                <input class="total-log" name="log_total_selasa" type="hidden" value="0" readonly>
                                @php
                                    $loop_selasa = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Selasa')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_selasa{{ $loop_selasa }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_selasa{{ $loop_selasa }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_selasa{{ $loop_selasa }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input name="log_type_selasa{{ $loop_selasa }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_selasa{{ $loop_selasa }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_selasa{{ $loop_selasa++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-rabu wrap-check-day" style="display: none">
                                <input class="total-log" name="log_total_rabu" type="hidden" value="0" readonly>
                                @php
                                    $loop_rabu = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Rabu')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_rabu{{ $loop_rabu }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_rabu{{ $loop_rabu }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_rabu{{ $loop_rabu }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input name="log_type_rabu{{ $loop_rabu }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_rabu{{ $loop_rabu }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_rabu{{ $loop_rabu++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-kamis wrap-check-day" style="display: none">
                                <input class="total-log" name="log_total_kamis" type="hidden" value="0" readonly>
                                @php
                                    $loop_kamis = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Kamis')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_kamis{{ $loop_kamis }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_kamis{{ $loop_kamis }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_kamis{{ $loop_kamis }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input name="log_type_kamis{{ $loop_kamis }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_kamis{{ $loop_kamis }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_kamis{{ $loop_kamis++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-jumat wrap-check-day" style="display: none">
                                <input class="total-log" name="log_total_jumat" type="hidden" value="0" readonly>
                                @php
                                    $loop_jumat = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Jumat')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_jumat{{ $loop_jumat }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_jumat{{ $loop_jumat }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_jumat{{ $loop_jumat }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input name="log_type_jumat{{ $loop_jumat }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_jumat{{ $loop_jumat }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_jumat{{ $loop_jumat++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-sabtu wrap-check-day" style="display: none">
                                <input class="total-log" name="log_total_sabtu" type="hidden" value="0" readonly>
                                @php
                                    $loop_sabtu = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Sabtu')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input name="log_type_sabtu{{ $loop_sabtu }}" type="text" class="filter-input" value="{{ $detail->log_type }}" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_sabtu{{ $loop_sabtu++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-minggu wrap-check-day" style="display: none">
                                <input class="total-log" name="log_total_minggu" type="hidden" value="0" readonly>
                                @php
                                    $loop_minggu = 1;
                                @endphp
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Minggu')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input name="log_name_minggu{{ $loop_minggu }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input name="log_limit_minggu{{ $loop_minggu }}" value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input name="log_time_minggu{{ $loop_minggu }}" value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label value="{{ $detail->log_type }}">Jenis Check Log</label>
                                                <input name="log_type_minggu{{ $loop_minggu }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                            </div>
                                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                <p>
                                                    <span class="related-title">Masuk</span>
                                                </p>
                                                <p>
                                                    <span class="related-title">Keluar</span>
                                                </p>
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input name="log_tolerance_minggu{{ $loop_minggu }}" value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input name="log_range_minggu{{ $loop_minggu++ }}" value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-row" style="margin-top: 24px">
                                <div class="form-field">
                                    <label for="ket">Keterangan Pengirim</label>
                                    <textarea name="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                </div>
                            </div>
                            <div class="form-submit-btn">
                                <button type="submit" class="evented-btn change">Kirim Pengajuan Perubahan</button>
                            </div>
                        </form>
                        <div onclick="closeModal(this)" class="close-btn">
                            Batalkan Pengajuan
                        </div>
                    </div>


                    <div class="modal-card">
                        <span class="modal-id">{{ $jadwal->id }}</span>
                        <span class="modal-fn">destroy</span>
                        <div class="form-head">
                            <div class="form-image">
                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                            </div>
                            <div class="form-header">
                                <h5>Formulir Pengajuan<br>Penghapusan Jadwal</h5>
                                <p>
                                    Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                </p>
                            </div>
                        </div>
                        <form action="/dashboard/master/reqDestroy-jadwal/{{ $jadwal->id }}" method="POST" class="form-form">
                            @csrf
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" value="{{ $jadwal->departemen->nama_dept }}" autocomplete="off" disabled>
                                </div>
                                <div class="form-field">
                                    <label for="nama">Nama Jadwal</label>
                                    <input name="nama_jadwal" id="nama" type="text" value="{{ $jadwal->nama_jadwal }}" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="jadwal_ket">Keterangan Jadwal</label>
                                    <input name="keterangan_jadwal" id="jadwal_ket" type="text" value="{{ $jadwal->keterangan_jadwal }}" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 8px">
                                <div class="form-field">
                                    <label for="status">Status Jadwal</label>
                                    <input id="status" type="text" value="{{ $jadwal->status }}" autocomplete="off" disabled>
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
                            <div class="day-is-senin wrap-check-day">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Senin')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="day-is-selasa wrap-check-day" style="display: none">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Selasa')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-rabu wrap-check-day" style="display: none">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Rabu')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-kamis wrap-check-day" style="display: none">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Kamis')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-jumat wrap-check-day" style="display: none">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Jumat')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-sabtu wrap-check-day" style="display: none">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Sabtu')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled type="text" autocomplete="off" value="{{ $detail->log_type }}">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div is-there-log="0" class="day-is-minggu wrap-check-day" style="display: none">
                                @foreach ($jadwal->details as $detail)
                                    @if ($detail->hari === 'Minggu')
                                        <div class="form-row log-row" style="margin: 24px 0 8px;">
                                            <div class="form-field">
                                                <label for="">Nama Check Log</label>
                                                <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Jam / Waktu</label>
                                                <input disabled value="{{ $detail->log_limit }}"  type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Dibuka</label>
                                                <input disabled value="{{ $detail->log_time }}"  type="time">
                                            </div>
                                        </div>
                                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                            <div class="form-field">
                                                <label>Jenis Check Log</label>
                                                <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Toleransi</label>
                                                <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                            </div>
                                            <div class="form-field">
                                                <label for="">Check Log Ditutup</label>
                                                <input disabled value="{{ $detail->log_range }}" type="time">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-row" style="margin-top: 24px">
                                <div class="form-field">
                                    <label for="ket">Keterangan Pengirim</label>
                                    <textarea name="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                </div>
                            </div>
                            <div class="form-submit-btn">
                                <button type="submit" class="evented-btn destroy">Kirim Pengajuan Penghapusan</button>
                            </div>
                        </form>
                        <div onclick="closeModal(this)" class="close-btn">
                            Batalkan pengajuan
                        </div>
                    </div>
                @endforeach
            @endforeach
        @else
            @foreach ($departemens as $depar)
                @if ($depar->id == Auth::user()->departemen_id)
                    @foreach ($depar->jadwals as $jadwal)
                        <div class="modal-card">
                            <div class="modal-id">{{ $jadwal->id }}</div>
                            <div class="modal-fn">change</div>
                            <div class="form-head">
                                <div class="form-image">
                                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                                </div>
                                <div class="form-header">
                                    <h5>Formulir Pengajuan<br>Perubahan Jadwal</h5>
                                    <p>
                                        Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                    </p>
                                </div>
                            </div>
                            <form action="/dashboard/master/reqChange-jadwal/{{ $jadwal->id }}" method="POST" class="form-form">
                                @csrf
                                <div class="form-row" style="margin-bottom: 8px">
                                    <div class="form-field">
                                        <label for="departemen">Departemen</label>
                                        <input id="departemen" type="text" class="filter-input" autocomplete="off" placeholder="{{ $jadwal->departemen->nama_dept }}">
                                    </div>
                                    <div class="related-list" style="left: 0">
                                        @can('highOfficer')
                                            @foreach ($departemens as $depar)
                                                @if ($depar->status === 'Aktif')
                                                    <p>
                                                        <span class="related-title">{{ $depar->nama_dept }}</span>
                                                        <input type="radio" name="departemen_id" value="{{ $depar->id }}">
                                                    </p>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($departemens as $depar)
                                                @if ($depar->id == Auth::user()->departemen_id)
                                                    @if ($depar->status === 'Aktif')
                                                        <p>
                                                            <span class="related-title">{{ $depar->nama_dept }}</span>
                                                            <input type="radio" name="departemen_id" value="{{ $depar->id }}">
                                                        </p>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endcan
                                    </div>
                                    <div class="form-field">
                                        <label for="nama">Nama Jadwal</label>
                                        <input name="nama_jadwal" id="nama" type="text" placeholder="{{ $jadwal->nama_jadwal }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row" style="margin-bottom: 8px">
                                    <div class="form-field">
                                        <label for="jadwal_ket">Keterangan Jadwal</label>
                                        <input name="keterangan_jadwal" id="jadwal_ket" type="text" placeholder="{{ $jadwal->keterangan_jadwal }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <input name="type" id="type" type="hidden" value="Non Shift" class="filter-input" autocomplete="off">
                                    <div class="form-field">
                                        <label for="status">Status</label>
                                        <input name="status" id="status" type="text" class="filter-input" placeholder="{{ $jadwal->status }}" autocomplete="off">
                                    </div>
                                    <div class="related-list" style="width: 100%">
                                        <p>
                                            <span class="related-title">Aktif</span>
                                        </p>
                                        <p>
                                            <span class="related-title">Tidak Aktif</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field day-label">
                                        <p>Pilih Hari :</p>
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
                                <div class="form-row add-check-btn">
                                    <div class="form-field">
                                        <div class="add-check-time" btn-for-day="senin">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Check Log
                                        </div>
                                    </div>
                                </div>
                                <div is-there-log="0" class="day-is-senin wrap-check-day">
                                    <input class="total-log" name="log_total_senin" type="hidden" value="0" readonly>
                                    @php
                                        $loop_senin = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Senin')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_senin{{ $loop_senin }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_senin{{ $loop_senin }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_senin{{ $loop_senin }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input name="log_type_senin{{ $loop_senin }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_senin{{ $loop_senin }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_senin{{ $loop_senin++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-selasa wrap-check-day" style="display: none">
                                    <input class="total-log" name="log_total_selasa" type="hidden" value="0" readonly>
                                    @php
                                        $loop_selasa = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Selasa')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_selasa{{ $loop_selasa }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_selasa{{ $loop_selasa }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_selasa{{ $loop_selasa }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input name="log_type_selasa{{ $loop_selasa }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_selasa{{ $loop_selasa }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_selasa{{ $loop_selasa++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-rabu wrap-check-day" style="display: none">
                                    <input class="total-log" name="log_total_rabu" type="hidden" value="0" readonly>
                                    @php
                                        $loop_rabu = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Rabu')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_rabu{{ $loop_rabu }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_rabu{{ $loop_rabu }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_rabu{{ $loop_rabu }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input name="log_type_rabu{{ $loop_rabu }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_rabu{{ $loop_rabu }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_rabu{{ $loop_rabu++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-kamis wrap-check-day" style="display: none">
                                    <input class="total-log" name="log_total_kamis" type="hidden" value="0" readonly>
                                    @php
                                        $loop_kamis = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Kamis')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_kamis{{ $loop_kamis }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_kamis{{ $loop_kamis }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_kamis{{ $loop_kamis }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input name="log_type_kamis{{ $loop_kamis }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_kamis{{ $loop_kamis }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_kamis{{ $loop_kamis++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-jumat wrap-check-day" style="display: none">
                                    <input class="total-log" name="log_total_jumat" type="hidden" value="0" readonly>
                                    @php
                                        $loop_jumat = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Jumat')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_jumat{{ $loop_jumat }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_jumat{{ $loop_jumat }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_jumat{{ $loop_jumat }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input name="log_type_jumat{{ $loop_jumat }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_jumat{{ $loop_jumat }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_jumat{{ $loop_jumat++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-sabtu wrap-check-day" style="display: none">
                                    <input class="total-log" name="log_total_sabtu" type="hidden" value="0" readonly>
                                    @php
                                        $loop_sabtu = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Sabtu')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input name="log_type_sabtu{{ $loop_sabtu }}" type="text" class="filter-input" value="{{ $detail->log_type }}" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_sabtu{{ $loop_sabtu }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_sabtu{{ $loop_sabtu++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-minggu wrap-check-day" style="display: none">
                                    <input class="total-log" name="log_total_minggu" type="hidden" value="0" readonly>
                                    @php
                                        $loop_minggu = 1;
                                    @endphp
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Minggu')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input name="log_name_minggu{{ $loop_minggu }}" value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input name="log_limit_minggu{{ $loop_minggu }}" value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input name="log_time_minggu{{ $loop_minggu }}" value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label value="{{ $detail->log_type }}">Jenis Check Log</label>
                                                    <input name="log_type_minggu{{ $loop_minggu }}" value="{{ $detail->log_type }}" type="text" class="filter-input" autocomplete="off">
                                                </div>
                                                <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                                    <p>
                                                        <span class="related-title">Masuk</span>
                                                    </p>
                                                    <p>
                                                        <span class="related-title">Keluar</span>
                                                    </p>
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input name="log_tolerance_minggu{{ $loop_minggu }}" value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input name="log_range_minggu{{ $loop_minggu++ }}" value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-row" style="margin-top: 24px">
                                    <div class="form-field">
                                        <label for="ket">Keterangan Pengirim</label>
                                        <textarea name="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                    </div>
                                </div>
                                <div class="form-submit-btn">
                                    <button type="submit" class="evented-btn change">Kirim Pengajuan Perubahan</button>
                                </div>
                            </form>
                            <div onclick="closeModal(this)" class="close-btn">
                                Batalkan Pengajuan
                            </div>
                        </div>


                        <div class="modal-card">
                            <span class="modal-id">{{ $jadwal->id }}</span>
                            <span class="modal-fn">destroy</span>
                            <div class="form-head">
                                <div class="form-image">
                                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                                </div>
                                <div class="form-header">
                                    <h5>Formulir Pengajuan<br>Penghapusan Jadwal</h5>
                                    <p>
                                        Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                    </p>
                                </div>
                            </div>
                            <form action="/dashboard/master/reqDestroy-jadwal/{{ $jadwal->id }}" method="POST" class="form-form">
                                @csrf
                                <div class="form-row" style="margin-bottom: 8px">
                                    <div class="form-field">
                                        <label for="departemen">Departemen</label>
                                        <input id="departemen" type="text" value="{{ $jadwal->departemen->nama_dept }}" autocomplete="off" disabled>
                                    </div>
                                    <div class="form-field">
                                        <label for="nama">Nama Jadwal</label>
                                        <input name="nama_jadwal" id="nama" type="text" value="{{ $jadwal->nama_jadwal }}" autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-bottom: 8px">
                                    <div class="form-field">
                                        <label for="jadwal_ket">Keterangan Jadwal</label>
                                        <input name="keterangan_jadwal" id="jadwal_ket" type="text" value="{{ $jadwal->keterangan_jadwal }}" autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-bottom: 8px">
                                    <div class="form-field">
                                        <label for="status">Status Jadwal</label>
                                        <input id="status" type="text" value="{{ $jadwal->status }}" autocomplete="off" disabled>
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
                                <div class="day-is-senin wrap-check-day">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Senin')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="day-is-selasa wrap-check-day" style="display: none">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Selasa')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-rabu wrap-check-day" style="display: none">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Rabu')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-kamis wrap-check-day" style="display: none">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Kamis')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-jumat wrap-check-day" style="display: none">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Jumat')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-sabtu wrap-check-day" style="display: none">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Sabtu')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled type="text" autocomplete="off" value="{{ $detail->log_type }}">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div is-there-log="0" class="day-is-minggu wrap-check-day" style="display: none">
                                    @foreach ($jadwal->details as $detail)
                                        @if ($detail->hari === 'Minggu')
                                            <div class="form-row log-row" style="margin: 24px 0 8px;">
                                                <div class="form-field">
                                                    <label for="">Nama Check Log</label>
                                                    <input disabled value="{{ $detail->log_name }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Jam / Waktu</label>
                                                    <input disabled value="{{ $detail->log_limit }}"  type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Dibuka</label>
                                                    <input disabled value="{{ $detail->log_time }}"  type="time">
                                                </div>
                                            </div>
                                            <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                                                <div class="form-field">
                                                    <label>Jenis Check Log</label>
                                                    <input disabled value="{{ $detail->log_type }}" type="text" autocomplete="off">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Toleransi</label>
                                                    <input disabled value="{{ $detail->log_tolerance }}" type="time">
                                                </div>
                                                <div class="form-field">
                                                    <label for="">Check Log Ditutup</label>
                                                    <input disabled value="{{ $detail->log_range }}" type="time">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-row" style="margin-top: 24px">
                                    <div class="form-field">
                                        <label for="ket">Keterangan Pengirim</label>
                                        <textarea name="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                    </div>
                                </div>
                                <div class="form-submit-btn">
                                    <button type="submit" class="evented-btn destroy">Kirim Pengajuan Penghapusan</button>
                                </div>
                            </form>
                            <div onclick="closeModal(this)" class="close-btn">
                                Batalkan pengajuan
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endcan
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#non-shift').DataTable();
    } );
</script>   

@endsection