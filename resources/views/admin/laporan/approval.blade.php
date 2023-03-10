@extends('admin.layout.master')

@section('admin')
    <div class="data-template">
        <header class="container-header" style="margin-top: 0">
            <p>--- Approval Departemen ---</p>
        </header>
        <div class="req-card-container">
            @foreach ($reqDepartemens as $req)
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
                            <span class="as-label grey">
                                {{ $req->updated_at->format('h:i') }} WIB - {{ $req->updated_at->isoFormat('dddd, D MMMM Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="req-desc">
                        <p class="desc-title">Keterangan</p>
                        <p class="desc-sender">
                            {{ $req->keterangan_pengirim }}
                        </p>
                        <span onclick="showModal(5471{{ $req->id }}, 'more')" class="as-label modal-trigger">
                            Lihat Detail
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <header class="container-header">
            <p>--- Approval Jadwal ---</p>
        </header>
        <div class="req-card-container">
            <p class="no-data"><span><i class="fa-regular fa-envelope-open"></i></span> Belum ada pengajuan</p>
            @foreach ($reqJadwals as $req)
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
                            <span class="as-label grey">
                                {{ $req->updated_at->format('h:i') }} WIB - {{ $req->updated_at->isoFormat('dddd, D MMMM Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="req-desc">
                        <p class="desc-title">Keterangan</p>
                        <p class="desc-sender">
                            {{ $req->keterangan_pengirim }}
                        </p>
                        <span onclick="showModal(6119{{ $req->id }}, 'more')" class="as-label modal-trigger">
                            Lihat Detail
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <header class="container-header">
            <p>--- Approval Jabatan ---</p>
        </header>
        <div class="req-card-container">
            <p class="no-data"><span><i class="fa-regular fa-envelope-open"></i></span> Belum ada pengajuan</p>
            @foreach ($reqJabatans as $req)
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
                            <span class="as-label grey">
                                {{ $req->updated_at->format('h:i') }} WIB - {{ $req->updated_at->isoFormat('dddd, D MMMM Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="req-desc">
                        <p class="desc-title">Keterangan</p>
                        <p class="desc-sender">
                            {{ $req->keterangan_pengirim }}
                        </p>
                        <span onclick="showModal(3129{{ $req->id }}, 'more')" class="as-label modal-trigger">
                            Lihat Detail
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <header class="container-header">
            <p>--- Approval Pegawai ---</p>
        </header>
        <div class="req-card-container">
            <p class="no-data"><span><i class="fa-regular fa-envelope-open"></i></span> Belum ada pengajuan</p>
            @foreach ($reqPegawais as $req)
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
                            <span class="as-label grey">
                                {{ $req->updated_at->format('h:i') }} WIB - {{ $req->updated_at->isoFormat('dddd, D MMMM Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="req-desc">
                        <p class="desc-title">Keterangan</p>
                        <p class="desc-sender">
                            {{ $req->keterangan_pengirim }}
                        </p>
                        <span onclick="showModal(4165{{ $req->id }}, 'more')" class="as-label modal-trigger">
                            Lihat Detail
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="data-modal">
            @foreach ($reqDepartemens as $req)
            <div class="modal-card">
                <span class="modal-id">5471{{ $req->id }}</span>
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
                        <div class="form-row">
                            <div class="form-field">
                                <label>Nama Departemen</label>
                                <input type="text" value="{{ $req->nama_dept }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row" style="margin: 0; margin-bottom: 8px">
                            <div class="form-field">
                                <label>Atasan 1</label>
                                <input type="text" value="{{ $req->atasan1 }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Atasan 2</label>
                                <input type="text" value="{{ $req->atasan2 }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Atasan 3 (Optional)</label>
                                <input type="text" value="{{ $req->atasan3 }}" disabled> 
                            </div>
                        </div>
                    @endif
                </div>
                <div onclick="closeModal(this)" class="close-btn">
                    <i class="fa-solid fa-square-xmark"></i>
                </div>
            </div>
            @endforeach
            @foreach ($reqJadwals as $req)
            <div class="modal-card">
                <span class="modal-id">6119{{ $req->id }}</span>
                <span class="modal-fn">more</span>
                <div class="form-form" style="padding-top: 8px; border: none">
                    @if ($req->jenis_pengajuan === 'Perubahan')
                        <div class="change-list">
                            {!! $req->list_perubahan !!}
                        </div>
                    @else
                        <div class="form-row">
                            <div class="form-field">
                                <label for="name">Departemen</label>
                                <input id="name" type="text" autocomplete="off" value="{{ $req->departemen->nama_dept }}" readonly>
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 10px">
                            <div class="form-field">
                                <label for="jadwal">Nama Jadwal</label>
                                <input id="jadwal" type="text" autocomplete="off" value="{{ $req->nama_jadwal }}" readonly>
                            </div>
                            <div class="form-field">
                                <label for="jadwalket">Keterangan Jadwal</label>
                                <input id="jadwalket" type="text" autocomplete="off" value="{{ $req->keterangan_jadwal }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="toleransi1">Toleransi Terlambat (Menit)</label>
                                <input id="toleransi1" type="number" value="{{ $req->toleransi_masuk }}" readonly>
                            </div>
                            <div class="form-field">
                                <label for="toleransi2">Toleransi Pulang Cepat (Menit)</label>
                                <input id="toleransi2" type="number" value="{{ $req->toleransi_pulang }}" readonly>
                            </div>
                        </div>
                        <div class="form-row" style="margin: 32px 0 24px">
                            <div class="form-field">
                                <p class="time-info">Jam Masuk</p>
                                @foreach ($req->details as $day)
                                    <label>{{ $day->hari }}</label>
                                    <input type="text" style="margin-bottom: 5px" value="{{ $day->jam_masuk }}" readonly>
                                @endforeach
                            </div>
                            <div class="form-field">
                                <p class="time-info">Jam Pulang</p>
                                @foreach ($req->details as $day)
                                    <label>{{ $day->hari }}</label>
                                    <input type="text" style="margin-bottom: 5px" value="{{ $day->jam_pulang }}" readonly>
                            @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div onclick="closeModal(this)" class="close-btn">
                    <i class="fa-solid fa-square-xmark"></i>
                </div>
            </div>
            @endforeach

            @foreach ($reqJabatans as $req)
            <div class="modal-card">
                <span class="modal-id">3129{{ $req->id }}</span>
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
                        <div class="form-row" style="margin: 0; margin-bottom: 8px">
                            <div class="form-field">
                                <label>Departemen</label>
                                <input type="text" value="{{ $req->jadwal->departemen->nama_dept }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row" style="margin: 0; margin-bottom: 8px">
                            <div class="form-field">
                                <label>Jabatan</label>
                                <input type="text" value="{{ $req->jabatan }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 8px">
                            <div class="form-field">
                                <label>Jatah Cuti Tahunan</label>
                                <input type="text" value="{{ $req->jatah_cuti_tahunan }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Jadwal Kerja</label>
                                <input type="text" value="{{ $req->jadwal->nama_jadwal }}" disabled> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Gaji Perbulan</label>
                                <input type="text" value="Rp {{ $req->gaji }}" disabled> 
                            </div>
                        </div>
                    @endif
                </div>
                <div onclick="closeModal(this)" class="close-btn">
                    <i class="fa-solid fa-square-xmark"></i>
                </div>
            </div>
            @endforeach

            @foreach ($reqPegawais as $req)
            <div class="modal-card">
                <span class="modal-id">4165{{ $req->id }}</span>
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
                    <div class="form-row" style="margin: 0; margin-bottom: 8px">
                        <div class="form-field">
                            <label>NIP</label>
                            <input type="text" value="{{ $req->nip }}" disabled> 
                        </div>
                    </div>
                    <div class="form-row" style="margin: 0; margin-bottom: 8px">
                        <div class="form-field">
                            <label>Departemen</label>
                            <input type="text" value="{{ $req->jabatan->jadwal->departemen->nama_dept }}" disabled> 
                        </div>
                    </div>
                    <div class="form-row" style="margin: 0; margin-bottom: 8px">
                        <div class="form-field">
                            <label>Jabatan</label>
                            <input type="text" value="{{ $req->jabatan->jabatan }}" disabled> 
                        </div>
                    </div>
                    <div class="form-row" style="margin-bottom: 8px">
                        <div class="form-field">
                            <label>Nama Pegawai</label>
                            <input type="text" value="{{ $req->nama }}" disabled> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Nomor WA</label>
                            <input type="text" value="Rp {{ $req->no_wa }}" disabled> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Alamat</label>
                            <input type="text" value="Rp {{ $req->alamat }}" disabled> 
                        </div>
                    </div>
                    @endif
                </div>
                <div onclick="closeModal(this)" class="close-btn">
                    <i class="fa-solid fa-square-xmark"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection