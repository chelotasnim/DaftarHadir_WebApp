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
    @error('jabatan_id')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('nip')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('nama')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('email')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('tunjangan_tetap')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('no_hp')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('no_wa')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('alamat')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('tgl_lahir')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('jns_kel')
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
                <h5>Formulir Pengajuan<br>Penambahan Pegawai</h5>
                <p>
                    Ini merupakan form pengajuan izin Penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                </p>
            </div>
        </div>
        <div class="form-form">
            <div class="form-row">
                <div class="form-field">
                    <label for="finger">Finger ID (Sesuai yang terdaftar di mesin)</label>
                    <input wire:model.defer="fp_id" id="finger" type="number">
                </div>
            </div>
            <div class="form-row" style="margin: 0">
                <div class="form-field">
                    <label for="nip">NIP</label>
                    <input wire:model.defer="nip" id="nip" type="text" autocomplete="off">
                </div>
                <div class="form-field">
                    <label for="nama">Nama Pegawai</label>
                    <input wire:model.defer="nama" id="nama" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin-top: 8px">
                <div class="form-field">
                    <label for="jabatan">Jabatan</label>
                    <input id="jabatan" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="width: 100%">
                    @can('highOfficer')
                        @foreach ($departemens as $departemen)
                            @foreach ($departemen->jadwals as $jadwal)
                                @foreach ($jadwal->jabatans as $jabatan)
                                    <p>
                                        <span class="related-title">{{ $jabatan->jabatan }}</span>
                                        <input wire:model.defer="jabatan_id" type="radio" name="jabatan" value="{{ $jabatan->id }}">
                                    </p>
                                @endforeach
                            @endforeach
                        @endforeach
                    @else 
                        @foreach ($departemens as $departemen)
                            @if ($departemen->id == Auth::user()->departemen_id)
                                @foreach ($departemen->jadwals as $jadwal)
                                    @foreach ($jadwal->jabatans as $jabatan)
                                        <p>
                                            <span class="related-title">{{ $jabatan->jabatan }}</span>
                                            <input wire:model.defer="jabatan_id" type="radio" name="jabatan" value="{{ $jabatan->id }}">
                                        </p>
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    @endcan
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 32px">
                <div class="form-field">
                    <label for="tunjangan">Tunjangan Tetap (Per Bulan)</label>
                    <input wire:model.defer="tunjangan_tetap" id="tunjangan" type="number" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="gender">Jenis Kelamin</label>
                    <input id="gender" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="left: 0">
                    <p>
                        <span class="related-title">Laki - Laki</span>
                        <input wire:model.defer="jns_kel" wire:model.defer="jabatan_id" type="radio" name="gender" value="Laki - Laki">
                    </p>
                    <p>
                        <span class="related-title">Perempuan</span>
                        <input wire:model.defer="jns_kel" wire:model.defer="jabatan_id" type="radio" name="gender" value="Perempuan">
                    </p>
                </div>
                <div class="form-field">
                    <label for="bitrth">Tanggal Lahir</label>
                    <input wire:model.defer="tgl_lahir" id="bitrth" type="date" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="addres">Alamat</label>
                    <input wire:model.defer="alamat" id="addres" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin-top: 32px">
                <div class="form-field">
                    <label for="email">E-mail</label>
                    <input wire:model.defer="email" id="email" type="email" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="phone">Nomor HP</label>
                    <input wire:model.defer="no_hp" id="phone" type="number" autocomplete="off">
                </div>
                <div class="form-field">
                    <label for="wa">Nomor WA</label>
                    <input wire:model.defer="no_wa" id="wa" type="number" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin: 32px 0">
                <div class="form-field">
                    <label for="status">Status Pegawai</label>
                    <input id="status" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="width: 100%">
                    <p>
                        <span class="related-title">Aktif</span>
                        <input wire:model.defer="status" wire:model.defer="jabatan_id" type="radio" name="status" value="Aktif">
                    </p>
                    <p>
                        <span class="related-title">Tidak Aktif</span>
                        <input wire:model.defer="status" wire:model.defer="jabatan_id" type="radio" name="status" value="Tidak Aktif">
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
                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Pegawai</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>

    @can('highManager')
        @foreach ($departemens as $depar)
            @foreach ($depar->jadwals as $jadwal)
                @foreach ($jadwal->jabatans as $jabatan)
                    @foreach ($jabatan->pegawais as $pegawai)
                        <div class="modal-card">
                            <span class="modal-id">{{ $pegawai->id }}</span>
                            <span class="modal-fn">change</span>
                            <div class="form-head">
                                <div class="form-image">
                                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                                </div>
                                <div class="form-header">
                                    <h5>Formulir Pengajuan<br>Perubahan Pegawai</h5>
                                    <p>
                                        Ini merupakan form pengajuan izin Perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-form">
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="finger">Finger ID (Sesuai yang terdaftar di mesin)</label>
                                        <input wire:model.defer="fp_id" id="finger" type="number" placeholder="{{ $pegawai->fp_id }}">
                                    </div>
                                </div>
                                <div class="form-row" style="margin: 0">
                                    <div class="form-field">
                                        <label for="nip">NIP</label>
                                        <input wire:model.defer="nip" id="nip" type="text" autocomplete="off" placeholder="{{ $pegawai->nip }}">
                                    </div>
                                    <div class="form-field">
                                        <label for="nama">Nama Pegawai</label>
                                        <input wire:model.defer="nama" id="nama" type="text" autocomplete="off" placeholder="{{ $pegawai->nama }}">
                                    </div>
                                </div>
                                <div class="form-row" style="margin-top: 8px">
                                    <div class="form-field">
                                        <label for="jabatan">Jabatan</label>
                                        <input id="jabatan" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->jabatan->jabatan }}">
                                    </div>
                                    <div class="related-list" style="width: 100%">
                                        @can('highOfficer')
                                            @foreach ($departemens as $departemen)
                                                @foreach ($departemen->jadwals as $jadwal)
                                                    @foreach ($jadwal->jabatans as $jabatan)
                                                        <p>
                                                            <span class="related-title">{{ $jabatan->jabatan }}</span>
                                                            <input wire:model.defer="jabatan_id" type="radio" name="jabatan" value="{{ $jabatan->id }}">
                                                        </p>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else 
                                            @foreach ($departemens as $departemen)
                                                @if ($departemen->id == Auth::user()->departemen_id)
                                                    @foreach ($departemen->jadwals as $jadwal)
                                                        @foreach ($jadwal->jabatans as $jabatan)
                                                            <p>
                                                                <span class="related-title">{{ $jabatan->jabatan }}</span>
                                                                <input wire:model.defer="jabatan_id" type="radio" name="jabatan" value="{{ $jabatan->id }}">
                                                            </p>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endcan
                                    </div>
                                </div>
                                <div class="form-row" style="margin-bottom: 32px">
                                    <div class="form-field">
                                        <label for="tunjangan">Tunjangan Tetap (Per Bulan)</label>
                                        <input wire:model.defer="tunjangan_tetap" id="tunjangan" type="number" autocomplete="off" placeholder="{{ $pegawai->tunjangan_tetap }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="gender">Jenis Kelamin</label>
                                        <input id="gender" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->jns_kel }}">
                                    </div>
                                    <div class="related-list" style="left: 0">
                                        <p>
                                            <span class="related-title">Laki - Laki</span>
                                            <input wire:model.defer="jns_kel" wire:model.defer="jabatan_id" type="radio" name="gender" value="Laki - Laki">
                                        </p>
                                        <p>
                                            <span class="related-title">Perempuan</span>
                                            <input wire:model.defer="jns_kel" wire:model.defer="jabatan_id" type="radio" name="gender" value="Perempuan">
                                        </p>
                                    </div>
                                    <div class="form-field">
                                        <label for="bitrth">Tanggal Lahir</label>
                                        <input wire:model.defer="tgl_lahir" id="bitrth" type="date" autocomplete="off" placeholder="{{ $pegawai->tgl_lahir }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="addres">Alamat</label>
                                        <input wire:model.defer="alamat" id="addres" type="text" autocomplete="off" placeholder="{{ $pegawai->alamat }}">
                                    </div>
                                </div>
                                <div class="form-row" style="margin-top: 32px">
                                    <div class="form-field">
                                        <label for="email">E-mail</label>
                                        <input wire:model.defer="email" id="email" type="email" autocomplete="off" placeholder="{{ $pegawai->email }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="phone">Nomor HP</label>
                                        <input wire:model.defer="no_hp" id="phone" type="number" autocomplete="off" placeholder="{{ $pegawai->no_hp }}">
                                    </div>
                                    <div class="form-field">
                                        <label for="wa">Nomor WA</label>
                                        <input wire:model.defer="no_wa" id="wa" type="number" autocomplete="off" placeholder="{{ $pegawai->no_wa }}">
                                    </div>
                                </div>
                                <div class="form-row" style="margin: 32px 0">
                                    <div class="form-field">
                                        <label for="status">Status Pegawai</label>
                                        <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->status }}">
                                    </div>
                                    <div class="related-list" style="width: 100%">
                                        <p>
                                            <span class="related-title">Aktif</span>
                                            <input wire:model.defer="status" wire:model.defer="jabatan_id" type="radio" name="status" value="Aktif">
                                        </p>
                                        <p>
                                            <span class="related-title">Tidak Aktif</span>
                                            <input wire:model.defer="status" wire:model.defer="jabatan_id" type="radio" name="status" value="Tidak Aktif">
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
                                    <button wire:click="reqChange({{ $pegawai->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                                </div>
                            </div>
                            <div onclick="closeModal(this)" class="close-btn">
                                <i class="fa-solid fa-square-xmark"></i>
                            </div>
                        </div>      
                        
                        <div class="modal-card">
                            <span class="modal-id">{{ $pegawai->id }}</span>
                            <span class="modal-fn">destroy</span>
                            <div class="form-head">
                                <div class="form-image">
                                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                                </div>
                                <div class="form-header">
                                    <h5>Formulir Pengajuan<br>Penghapusan Pegawai</h5>
                                    <p>
                                        Ini merupakan form pengajuan izin Penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-form">
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="finger">Finger ID (Sesuai yang terdaftar di mesin)</label>
                                        <input id="finger" type="number" value="{{ $pegawai->fp_id }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row" style="margin: 0">
                                    <div class="form-field">
                                        <label for="nip">NIP</label>
                                        <input id="nip" type="text" autocomplete="off" value="{{ $pegawai->nip }}" readonly>
                                    </div>
                                    <div class="form-field">
                                        <label for="nama">Nama Pegawai</label>
                                        <input id="nama" type="text" autocomplete="off" value="{{ $pegawai->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-top: 8px">
                                    <div class="form-field">
                                        <label for="jabatan">Departemen</label>
                                        <input id="jabatan" type="text" autocomplete="off" value="{{ $pegawai->jabatan->jadwal->departemen->nama_dept }}" readonly>
                                    </div>
                                    <div class="form-field">
                                        <label for="jabatan">Jabatan</label>
                                        <input id="jabatan" type="text" autocomplete="off" value="{{ $pegawai->jabatan->jabatan }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-bottom: 32px">
                                    <div class="form-field">
                                        <label for="tunjangan">Tunjangan Tetap (Per Bulan)</label>
                                        <input id="tunjangan" type="number" autocomplete="off" value="{{ $pegawai->tunjangan_tetap }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="gender">Jenis Kelamin</label>
                                        <input id="gender" type="text" autocomplete="off" value="{{ $pegawai->jns_kel }}" readonly>
                                    </div>
                                    <div class="form-field">
                                        <label for="bitrth">Tanggal Lahir</label>
                                        <input id="bitrth" type="date" autocomplete="off" value="{{ $pegawai->tgl_lahir }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="addres">Alamat</label>
                                        <input id="addres" type="text" autocomplete="off" value="{{ $pegawai->alamat }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-top: 32px">
                                    <div class="form-field">
                                        <label for="email">E-mail</label>
                                        <input id="email" type="email" autocomplete="off" value="{{ $pegawai->email }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="phone">Nomor HP</label>
                                        <input id="phone" type="number" autocomplete="off" value="{{ $pegawai->no_hp }}" readonly>
                                    </div>
                                    <div class="form-field">
                                        <label for="wa">Nomor WA</label>
                                        <input id="wa" type="number" autocomplete="off" value="{{ $pegawai->no_wa }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row" style="margin: 32px 0">
                                    <div class="form-field">
                                        <label for="status">Status Pegawai</label>
                                        <input id="status" type="text" autocomplete="off" value="{{ $pegawai->status }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label for="ket">Keterangan Pengirim</label>
                                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                    </div>
                                </div>
                                <div onmouseover="resetError()" class="form-submit-btn">
                                    <button wire:click="reqDestroy({{ $pegawai->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
                                </div>
                            </div>
                            <div onclick="closeModal(this)" class="close-btn">
                                <i class="fa-solid fa-square-xmark"></i>
                            </div>
                        </div>      
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
                            <div class="modal-card">
                                <span class="modal-id">{{ $pegawai->id }}</span>
                                <span class="modal-fn">change</span>
                                <div class="form-head">
                                    <div class="form-image">
                                        <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                                    </div>
                                    <div class="form-header">
                                        <h5>Formulir Pengajuan<br>Perubahan Pegawai</h5>
                                        <p>
                                            Ini merupakan form pengajuan izin Perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-form">
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="finger">Finger ID (Sesuai yang terdaftar di mesin)</label>
                                            <input wire:model.defer="fp_id" id="finger" type="number" placeholder="{{ $pegawai->fp_id }}">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin: 0">
                                        <div class="form-field">
                                            <label for="nip">NIP</label>
                                            <input wire:model.defer="nip" id="nip" type="text" autocomplete="off" placeholder="{{ $pegawai->nip }}">
                                        </div>
                                        <div class="form-field">
                                            <label for="nama">Nama Pegawai</label>
                                            <input wire:model.defer="nama" id="nama" type="text" autocomplete="off" placeholder="{{ $pegawai->nama }}">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 8px">
                                        <div class="form-field">
                                            <label for="jabatan">Jabatan</label>
                                            <input id="jabatan" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->jabatan->jabatan }}">
                                        </div>
                                        <div class="related-list" style="width: 100%">
                                            @can('highOfficer')
                                                @foreach ($departemens as $departemen)
                                                    @foreach ($departemen->jadwals as $jadwal)
                                                        @foreach ($jadwal->jabatans as $jabatan)
                                                            <p>
                                                                <span class="related-title">{{ $jabatan->jabatan }}</span>
                                                                <input wire:model.defer="jabatan_id" type="radio" name="jabatan" value="{{ $jabatan->id }}">
                                                            </p>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @else 
                                                @foreach ($departemens as $departemen)
                                                    @if ($departemen->id == Auth::user()->departemen_id)
                                                        @foreach ($departemen->jadwals as $jadwal)
                                                            @foreach ($jadwal->jabatans as $jabatan)
                                                                <p>
                                                                    <span class="related-title">{{ $jabatan->jabatan }}</span>
                                                                    <input wire:model.defer="jabatan_id" type="radio" name="jabatan" value="{{ $jabatan->id }}">
                                                                </p>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 32px">
                                        <div class="form-field">
                                            <label for="tunjangan">Tunjangan Tetap (Per Bulan)</label>
                                            <input wire:model.defer="tunjangan_tetap" id="tunjangan" type="number" autocomplete="off" placeholder="{{ $pegawai->tunjangan_tetap }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="gender">Jenis Kelamin</label>
                                            <input id="gender" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->jns_kel }}">
                                        </div>
                                        <div class="related-list" style="left: 0">
                                            <p>
                                                <span class="related-title">Laki - Laki</span>
                                                <input wire:model.defer="jns_kel" wire:model.defer="jabatan_id" type="radio" name="gender" value="Laki - Laki">
                                            </p>
                                            <p>
                                                <span class="related-title">Perempuan</span>
                                                <input wire:model.defer="jns_kel" wire:model.defer="jabatan_id" type="radio" name="gender" value="Perempuan">
                                            </p>
                                        </div>
                                        <div class="form-field">
                                            <label for="bitrth">Tanggal Lahir</label>
                                            <input wire:model.defer="tgl_lahir" id="bitrth" type="date" autocomplete="off" placeholder="{{ $pegawai->tgl_lahir }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="addres">Alamat</label>
                                            <input wire:model.defer="alamat" id="addres" type="text" autocomplete="off" placeholder="{{ $pegawai->alamat }}">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 32px">
                                        <div class="form-field">
                                            <label for="email">E-mail</label>
                                            <input wire:model.defer="email" id="email" type="email" autocomplete="off" placeholder="{{ $pegawai->email }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="phone">Nomor HP</label>
                                            <input wire:model.defer="no_hp" id="phone" type="number" autocomplete="off" placeholder="{{ $pegawai->no_hp }}">
                                        </div>
                                        <div class="form-field">
                                            <label for="wa">Nomor WA</label>
                                            <input wire:model.defer="no_wa" id="wa" type="number" autocomplete="off" placeholder="{{ $pegawai->no_wa }}">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin: 32px 0">
                                        <div class="form-field">
                                            <label for="status">Status Pegawai</label>
                                            <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $pegawai->status }}">
                                        </div>
                                        <div class="related-list" style="width: 100%">
                                            <p>
                                                <span class="related-title">Aktif</span>
                                                <input wire:model.defer="status" wire:model.defer="jabatan_id" type="radio" name="status" value="Aktif">
                                            </p>
                                            <p>
                                                <span class="related-title">Tidak Aktif</span>
                                                <input wire:model.defer="status" wire:model.defer="jabatan_id" type="radio" name="status" value="Tidak Aktif">
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
                                        <button wire:click="reqChange({{ $pegawai->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                                    </div>
                                </div>
                                <div onclick="closeModal(this)" class="close-btn">
                                    <i class="fa-solid fa-square-xmark"></i>
                                </div>
                            </div>      
                            
                            <div class="modal-card">
                                <span class="modal-id">{{ $pegawai->id }}</span>
                                <span class="modal-fn">destroy</span>
                                <div class="form-head">
                                    <div class="form-image">
                                        <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                                    </div>
                                    <div class="form-header">
                                        <h5>Formulir Pengajuan<br>Penghapusan Pegawai</h5>
                                        <p>
                                            Ini merupakan form pengajuan izin Penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-form">
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="finger">Finger ID (Sesuai yang terdaftar di mesin)</label>
                                            <input id="finger" type="number" value="{{ $pegawai->fp_id }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin: 0">
                                        <div class="form-field">
                                            <label for="nip">NIP</label>
                                            <input id="nip" type="text" autocomplete="off" value="{{ $pegawai->nip }}" readonly>
                                        </div>
                                        <div class="form-field">
                                            <label for="nama">Nama Pegawai</label>
                                            <input id="nama" type="text" autocomplete="off" value="{{ $pegawai->nama }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 8px">
                                        <div class="form-field">
                                            <label for="jabatan">Departemen</label>
                                            <input id="jabatan" type="text" autocomplete="off" value="{{ $pegawai->jabatan->jadwal->departemen->nama_dept }}" readonly>
                                        </div>
                                        <div class="form-field">
                                            <label for="jabatan">Jabatan</label>
                                            <input id="jabatan" type="text" autocomplete="off" value="{{ $pegawai->jabatan->jabatan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 32px">
                                        <div class="form-field">
                                            <label for="tunjangan">Tunjangan Tetap (Per Bulan)</label>
                                            <input id="tunjangan" type="number" autocomplete="off" value="{{ $pegawai->tunjangan_tetap }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="gender">Jenis Kelamin</label>
                                            <input id="gender" type="text" autocomplete="off" value="{{ $pegawai->jns_kel }}" readonly>
                                        </div>
                                        <div class="form-field">
                                            <label for="bitrth">Tanggal Lahir</label>
                                            <input id="bitrth" type="date" autocomplete="off" value="{{ $pegawai->tgl_lahir }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="addres">Alamat</label>
                                            <input id="addres" type="text" autocomplete="off" value="{{ $pegawai->alamat }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 32px">
                                        <div class="form-field">
                                            <label for="email">E-mail</label>
                                            <input id="email" type="email" autocomplete="off" value="{{ $pegawai->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="phone">Nomor HP</label>
                                            <input id="phone" type="number" autocomplete="off" value="{{ $pegawai->no_hp }}" readonly>
                                        </div>
                                        <div class="form-field">
                                            <label for="wa">Nomor WA</label>
                                            <input id="wa" type="number" autocomplete="off" value="{{ $pegawai->no_wa }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin: 32px 0">
                                        <div class="form-field">
                                            <label for="status">Status Pegawai</label>
                                            <input id="status" type="text" autocomplete="off" value="{{ $pegawai->status }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <label for="ket">Keterangan Pengirim</label>
                                            <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                        </div>
                                    </div>
                                    <div onmouseover="resetError()" class="form-submit-btn">
                                        <button wire:click="reqDestroy({{ $pegawai->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
                                    </div>
                                </div>
                                <div onclick="closeModal(this)" class="close-btn">
                                    <i class="fa-solid fa-square-xmark"></i>
                                </div>
                            </div>      
                        @endforeach
                    @endforeach
                @endforeach
            @endif
        @endforeach
    @endcan
</div>