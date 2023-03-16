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
    @error('peran')
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
        <span class="modal-id">4dd</span>
        <span class="modal-fn">new</span>
        <div class="form-head">
            <div class="form-image">
                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
            </div>
            <div class="form-header">
                <h5>Formulir Pengajuan<br>Penambahan Admin</h5>
                <p>
                    Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                </p>
            </div>
        </div>
        <div class="form-form">
            <div class="form-row" style="margin-bottom: 8px">
                <div class="form-field">
                    <label for="nama">Username</label>
                    <input id="nama" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="left: 0">
                    @foreach ($departemens as $depar)
                        @foreach ($depar->jadwals as $jadwal)
                            @foreach ($jadwal->jabatans as $jabatan)
                                @foreach ($jabatan->pegawais as $pegawai)
                                    <p>
                                        <span class="related-title">{{ $pegawai->email }}</span>
                                        <input wire:model.defer="pegawai_id" type="radio" name="jadwal" value="{{ $pegawai->id }}">
                                    </p>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
                <div class="form-field">
                    <label for="pass">Password Admin</label>
                    <input wire:model.defer="password" id="pass" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 8px">
                <div class="form-field">
                    <label for="peran">Peran Admin</label>
                    <input id="peran" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="left: 0">
                    <p>
                        <span class="related-title">Pengelola</span>
                        <input wire:model.defer="peran" type="radio" name="status_dept" value="Pengelola">
                    </p>
                    <p>
                        <span class="related-title">Atasan</span>
                        <input wire:model.defer="peran"  type="radio" name="status_dept" value="Atasan">
                    </p>
                </div>
                <div class="form-field">
                    <label for="status">Status Admin</label>
                    <input id="status" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="right: 0">
                    <p>
                        <span class="related-title">Aktif</span>
                        <input wire:model.defer="status" type="radio" name="status_dept" value="Aktif">
                    </p>
                    <p>
                        <span class="related-title">Tidak Aktif</span>
                        <input wire:model.defer="status"  type="radio" name="status_dept" value="Tidak Aktif">
                    </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="ket">Keterangan Pengirim</label>
                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                </div>
            </div>
            <div onmouseover="resetError()" class="form-submit-btn">
                <button wire:click="reqNew()" class="new evented-btn">Kirim Pengajuan Admin</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>

    @foreach ($admins as $admin)
        <div class="modal-card">
            <span class="modal-id">{{ $admin->id }}</span>
            <span class="modal-fn">change</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Perubahan Admin</h5>
                    <p>
                        Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row" style="margin-bottom: 8px">
                    <div class="form-field">
                        <label for="nama">Username</label>
                        <input id="nama" type="text" class="filter-input" autocomplete="off" placeholder="{{ $admin->name }}">
                    </div>
                    <div class="related-list" style="left: 0">
                        @foreach ($departemens as $depar)
                            @foreach ($depar->jadwals as $jadwal)
                                @foreach ($jadwal->jabatans as $jabatan)
                                    @foreach ($jabatan->pegawais as $pegawai)
                                        <p>
                                            <span class="related-title">{{ $pegawai->email }}</span>
                                            <input wire:model.defer="pegawai_id" type="radio" name="jadwal" value="{{ $pegawai->id }}">
                                        </p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>
                    <div class="form-field">
                        <label for="pass">Password Admin</label>
                        <input wire:model.defer="password" id="pass" type="text" autocomplete="off" placeholder="Tidak Ditampilkan">
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 8px">
                    <div class="form-field">
                        <label for="peran">Peran Admin</label>
                        <input id="peran" type="text" class="filter-input" autocomplete="off" placeholder="{{ $admin->peran }}">
                    </div>
                    <div class="related-list" style="left: 0">
                        <p>
                            <span class="related-title">Pengelola</span>
                            <input wire:model.defer="peran" type="radio" name="status_dept" value="Pengelola">
                        </p>
                        <p>
                            <span class="related-title">Atasan</span>
                            <input wire:model.defer="peran"  type="radio" name="status_dept" value="Atasan">
                        </p>
                    </div>
                    <div class="form-field">
                        <label for="status">Status Admin</label>
                        <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $admin->status }}">
                    </div>
                    <div class="related-list" style="right: 0">
                        <p>
                            <span class="related-title">Aktif</span>
                            <input wire:model.defer="status" type="radio" name="status_dept" value="Aktif">
                        </p>
                        <p>
                            <span class="related-title">Tidak Aktif</span>
                            <input wire:model.defer="status"  type="radio" name="status_dept" value="Tidak Aktif">
                        </p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqChange({{ $admin->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>

        <div class="modal-card">
            <span class="modal-id">{{ $admin->id }}</span>
            <span class="modal-fn">destroy</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Penghapusan Admin</h5>
                    <p>
                        Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row" style="margin-bottom: 8px">
                    <div class="form-field">
                        <label for="nama">Username</label>
                        <input id="nama" type="text" autocomplete="off" placeholder="{{ $admin->name }}" disabled>
                    </div>
                    <div class="form-field">
                        <label for="pass">Password Admin</label>
                        <input id="pass" type="text" autocomplete="off" placeholder="Tidak Ditampilkan" disabled>
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 8px">
                    <div class="form-field">
                        <label for="peran">Peran Admin</label>
                        <input id="peran" type="text" autocomplete="off" placeholder="{{ $admin->peran }}" disabled>
                    </div>
                    <div class="form-field">
                        <label for="status">Status Admin</label>
                        <input id="status" type="text" autocomplete="off" placeholder="{{ $admin->status }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqDestroy({{ $admin->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>
    @endforeach
</div>