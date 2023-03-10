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
    @error('tanggal')
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
    @error('keterangan_aktivitas')
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
                <h5>Formulir Pengajuan<br>Penambahan Lembur</h5>
                <p>
                    Ini merupakan form pengajuan penambahan lembur. Penambahan dapat diterima atau ditolak oleh pegawai terkait. Cek status pengajuan <a href="">disini.</a>
                </p>
            </div>
        </div>
        <div class="form-form">
            <div class="form-row" style="margin-bottom: 24px">
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
            <div class="form-row" style="margin-bottom: 5px">
                <div class="form-field">
                    <label for="date">Tanggal</label>
                    <input wire:model.defer="tanggal" id="date" type="date">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 24px">
                <div class="form-field">
                    <label for="timeIn">Mulai</label>
                    <input wire:model.defer="mulai" id="timeIn" type="time">
                </div>
                <div class="form-field">
                    <label for="timeOut">Selesai</label>
                    <input wire:model.defer="sampai" id="timeOut" type="time">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="act">Keterangan Aktivitas</label>
                    <textarea wire:model.defer="keterangan_aktivitas" id="act" placeholder="Lengkapi keterangan, seperti detail kegiatan dalam aktivitas terkait"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="ket">Keterangan Pengirim</label>
                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                </div>
            </div>
            <div onmouseover="resetError()" class="form-submit-btn">
                <button wire:click="reqNew()" class="new evented-btn">Kirim Pengajuan Lembur</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>

    @foreach ($lemburs as $lembur)
        <div class="modal-card">
            <span class="modal-id">{{ $lembur->id }}</span>
            <span class="modal-fn">change</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Perubahan Aktivitas</h5>
                    <p>
                        Ini merupakan form pengajuan perubahan aktivitas. Perubahan dapat diterima atau ditolak oleh pegawai terkait. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row" style="margin-bottom: 24px">
                    <div class="form-field">
                        <label for="nama">Nama Pegawai</label>
                        <input id="nama" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->nama }}">
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
                <div class="form-row" style="margin-bottom: 5px">
                    <div class="form-field">
                        <label for="date">Tanggal</label>
                        <input wire:model.defer="tanggal" id="date" class="text-to-date" type="text" placeholder="{{ $lembur->tanggal }}">
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 24px">
                    <div class="form-field">
                        <label for="timeIn">Mulai</label>
                        <input wire:model.defer="mulai" id="timeIn" type="text" class="text-to-time" placeholder="{{ $lembur->mulai }}">
                    </div>
                    <div class="form-field">
                        <label for="timeOut">Selesai</label>
                        <input wire:model.defer="sampai" id="timeOut" type="text" class="text-to-time" placeholder="{{ $lembur->sampai }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="act">Keterangan Aktivitas</label>
                        <textarea wire:model.defer="keterangan_aktivitas" id="act" placeholder="{{ $lembur->keterangan_aktivitas }}"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqChange({{ $lembur->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>

        <div class="modal-card">
            <span class="modal-id">{{ $lembur->id }}</span>
            <span class="modal-fn">destroy</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Penghapusan Aktivitas</h5>
                    <p>
                        Ini merupakan form pengajuan penghapusan aktivitas. Penghapusan dapat diterima atau ditolak oleh pegawai terkait. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row" style="margin-bottom: 24px">
                    <div class="form-field">
                        <label for="nama">Nama Pegawai</label>
                        <input id="nama" type="text" autocomplete="off" value="{{ $pegawai->nama }}">
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 5px">
                    <div class="form-field">
                        <label for="date">Tanggal</label>
                        <input id="date" type="date" value="{{ $lembur->tanggal }}">
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 24px">
                    <div class="form-field">
                        <label for="timeIn">Mulai</label>
                        <input id="timeIn" type="time" value="{{ $lembur->mulai }}">
                    </div>
                    <div class="form-field">
                        <label for="timeOut">Selesai</label>
                        <input id="timeOut" type="time" value="{{ $lembur->sampai }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="act">Keterangan Aktivitas</label>
                        <textarea id="act" disabled>{{ $lembur->keterangan_aktivitas }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqDestroy({{ $lembur->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>
    @endforeach
</div>