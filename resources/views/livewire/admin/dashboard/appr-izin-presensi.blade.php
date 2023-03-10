<div class="data-modal independent">
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
    @error('pegawai_id')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('mulai')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('sampai')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('keterangan')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('lampiran')
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
        <span class="modal-id">4dd</span>
        <span class="modal-fn">new</span>
        <div class="form-head">
            <div class="form-image">
                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
            </div>
            <div class="form-header">
                <h5>Formulir Pengajuan<br>Penambahan Izin</h5>
                <p>
                    Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                </p>
            </div>
        </div>
        <div class="form-form">
            <div class="form-row">
                <div class="form-field">
                    <label for="nama">Nama Pegawai</label>
                    <input id="nama" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="width: 100%">
                    @can('highManager')
                        @foreach ($departemens as $depar)
                            @foreach ($depar->jadwals as $jadwal)
                                @foreach ($jadwal->jabatans as $jabatan)
                                    @foreach ($jabatan->pegawais as $pegawai)
                                        <p>
                                            <span class="related-title">{{ $pegawai->nama }}</span>
                                            <input wire:model.defer="pegawai_id" type="radio" name="nama_pegawai" value="{{ $pegawai->id }}">
                                        </p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        @foreach ($departemens as $depar)
                            @if ($depar->id == Auth::user()->departemen_id)
                                @foreach ($depar->jadwals as $jadwal)
                                    @foreach ($jadwal->jabatans as $jabatan)
                                        @foreach ($jabatan->pegawais as $pegawai)
                                            <p>
                                                <span class="related-title">{{ $pegawai->nama }}</span>
                                                <input wire:model.defer="pegawai_id" type="radio" name="nama_pegawai" value="{{ $pegawai->id }}">
                                            </p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    @endcan
                </div>
            </div>
            <div class="form-row cross-row" style="margin-bottom: 10px">
                <div class="form-field">
                    <label for="date">Mulai Tanggal</label>
                    <input wire:model.defer="mulai" id="date" type="date">
                </div>
                <div class="form-field">
                    <label for="date">Sampai Tanggal</label>
                    <input wire:model.defer="sampai" id="date" type="date">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="reason">Jenis Keterangan</label>
                    <input id="reason" type="text" class="filter-input">
                </div>
                <div class="related-list" style="width: 100%">
                    @foreach ($keterangans as $ket)    
                        <p>
                            <span class="related-title">{{ $ket->keterangan_izin }}</span>
                            <input wire:model.defer="keterangan" type="radio" name="jenis_izin" value="{{ $ket->keterangan_izin }}">
                        </p>
                    @endforeach
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="file">Lampiran</label>
                    <input class="image-field" wire:model.defer="lampiran" id="file" type="file" accept="image/png, image/jpg, image/jpeg">
                    <div class="upload-logo">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        <h5>Upload Bukti</h5>
                    </div>
                </div>
                <div class="form-field">
                    <label for="ket">Keterangan Pengirim</label>
                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                </div>
            </div>
            <div onmouseover="resetError()" class="form-submit-btn">
                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Izin</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>

    @foreach ($izins as $izin)
        <div class="modal-card">
            <span class="modal-id">{{ $izin->id }}</span>
            <span class="modal-fn">change</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Perubahan Izin</h5>
                    <p>
                        Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="nama">Nama Pegawai</label>
                        <input id="nama" type="text" class="filter-input" autocomplete="off" placeholder="{{ $izin->pegawai->nama }}">
                    </div>
                    <div class="related-list" style="width: 100%">
                        @can('highManager')
                            @foreach ($departemens as $depar)
                                @foreach ($depar->jadwals as $jadwal)
                                    @foreach ($jadwal->jabatans as $jabatan)
                                        @foreach ($jabatan->pegawais as $pegawai)
                                            <p>
                                                <span class="related-title">{{ $pegawai->nama }}</span>
                                                <input wire:model.defer="pegawai_id" type="radio" name="nama_pegawai" value="{{ $pegawai->id }}">
                                            </p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach ($departemens as $depar)
                                @if ($depar->id == Auth::user()->departemen_id)
                                    @foreach ($depar->jadwals as $jadwal)
                                        @foreach ($jadwal->jabatans as $jabatan)
                                            @foreach ($jabatan->pegawais as $pegawai)
                                                <p>
                                                    <span class="related-title">{{ $pegawai->nama }}</span>
                                                    <input wire:model.defer="pegawai_id" type="radio" name="nama_pegawai" value="{{ $pegawai->id }}">
                                                </p>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endif
                            @endforeach
                        @endcan
                    </div>
                </div>
                <div class="form-row cross-row" style="margin-bottom: 10px">
                    <div class="form-field">
                        <label for="date">Mulai Tanggal</label>
                        <input class="text-to-date" wire:model.defer="mulai" id="date" type="text" maxlength="10" placeholder="{{ $izin->mulai }}">
                    </div>
                    <div class="form-field">
                        <label for="date">Sampai Tanggal</label>
                        <input class="text-to-date" wire:model.defer="sampai" id="date" type="text" maxlength="10" placeholder="{{ $izin->sampai }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="reason">Jenis Keterangan</label>
                        <input id="reason" type="text" class="filter-input" placeholder="{{ $izin->keterangan }}">
                    </div>
                    <div class="related-list" style="width: 100%">
                        @foreach ($keterangans as $ket)    
                            <p>
                                <span class="related-title">{{ $ket->keterangan_izin }}</span>
                                <input wire:model.defer="keterangan" type="radio" name="jenis_izin" value="{{ $ket->keterangan_izin }}">
                            </p>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqChange({{ $izin->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>

        <div class="modal-card">
            <span class="modal-id">{{ $izin->id }}</span>
            <span class="modal-fn">destroy</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Penghapusan Izin</h5>
                    <p>
                        Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="nama">Nama Pegawai</label>
                        <input id="nama" type="text" autocomplete="off" value="{{ $izin->pegawai->nama }}" disabled>
                    </div>
                </div>
                <div class="form-row cross-row" style="margin-bottom: 10px">
                    <div class="form-field">
                        <label for="date">Mulai Tanggal</label>
                        <input class="text-to-date" id="date" type="text" maxlength="10" value="{{ $izin->mulai }}" disabled>
                    </div>
                    <div class="form-field">
                        <label for="date">Sampai Tanggal</label>
                        <input class="text-to-date" id="date" type="text" maxlength="10" value="{{ $izin->sampai }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="reason">Jenis Keterangan</label>
                        <input id="reason" type="text" value="{{ $izin->keterangan }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqDestroy({{ $izin->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>
    @endforeach
</div>