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
    @error('nama_dept')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('atasan1')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('atasan2')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('atasan3')
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
                <h5>Formulir Pengajuan<br>Penambahan Departemen</h5>
                <p>
                    Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                </p>
            </div>
        </div>
        <div class="form-form">
            <div class="form-row">
                <div class="form-field">
                    <label for="name">Departemen</label>
                    <input wire:model.defer="nama_dept" id="name" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 5px; margin-top: 32px;">
                <div class="form-field">
                    <label for="atasan1">Nama Atasan 1</label>
                    <input wire:model.defer="atasan1" id="atasan1" type="text" autocomplete="off">
                </div>
                <div class="form-field">
                    <label for="telp_1">Nomor WA Atasan 1</label>
                    <input wire:model.defer="telp_1" id="telp_1" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="atasan2">Nama Atasan 2</label>
                    <input wire:model.defer="atasan2" id="atasan2" type="text" autocomplete="off">
                </div>
                <div class="form-field">
                    <label for="telp_2">Nomor WA Atasan 2</label>
                    <input wire:model.defer="telp_2" id="telp_2" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="atasan3">Nama Atasan 3</label>
                    <input wire:model.defer="atasan3" id="atasan3" type="text" autocomplete="off">
                </div>
                <div class="form-field">
                    <label for="telp_3">Nomor WA Atasan 3</label>
                    <input wire:model.defer="telp_3" id="telp_3" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin-top: 32px">
                <div class="form-field">
                    <label for="status">Status Departemen</label>
                    <input id="status" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="width: 100%">
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
                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Departemen</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>

    @foreach ($departemens as $departemen)
        <div class="modal-card">
            <span class="modal-id">{{ $departemen->id }}</span>
            <span class="modal-fn">change</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Perubahan Departemen</h5>
                    <p>
                        Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="name">Departemen</label>
                        <input wire:model.defer="nama_dept" id="name" type="text" autocomplete="off" placeholder="{{ $departemen->nama_dept }}">
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 5px; margin-top: 32px;">
                    <div class="form-field">
                        <label for="atasan1">Nama Atasan 1</label>
                        <input wire:model.defer="atasan1" id="atasan1" type="text" autocomplete="off" placeholder="{{ $departemen->atasan1 }}">
                    </div>
                    <div class="form-field">
                        <label for="telp_1">Nomor WA Atasan 1</label>
                        <input wire:model.defer="telp_1" id="telp_1" type="text" autocomplete="off" placeholder="{{ $departemen->telp_1 }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="atasan2">Nama Atasan 2</label>
                        <input wire:model.defer="atasan2" id="atasan2" type="text" autocomplete="off" placeholder="{{ $departemen->atasan2 }}">
                    </div>
                    <div class="form-field">
                        <label for="telp_2">Nomor WA Atasan 2</label>
                        <input wire:model.defer="telp_2" id="telp_2" type="text" autocomplete="off" placeholder="{{ $departemen->telp_2 }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="atasan3">Nama Atasan 3 (Optional)</label>
                        <input wire:model.defer="atasan3" id="atasan3" type="text" autocomplete="off"
                        @if ($departemen->atasan3 !== null)
                            placeholder="{{ $departemen->atasan3 }}"
                            @else
                            placeholder="--;--"
                        @endif
                        >
                    </div>
                    <div class="form-field">
                        <label for="telp_3">Nomor WA Atasan 3 (Optional)</label>
                        <input wire:model.defer="telp_3" id="telp_3" type="text" autocomplete="off"
                        @if ($departemen->telp_3 !== null)
                            placeholder="{{ $departemen->telp_3 }}"
                            @else
                            placeholder="--;--"
                        @endif
                        >
                    </div>
                </div>
                <div class="form-row" style="margin-top: 32px">
                    <div class="form-field">
                        <label for="status">Status Departemen</label>
                        <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $departemen->status }}">
                    </div>
                    <div class="related-list" style="width: 100%">
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
                    <button wire:click="reqChange({{ $departemen->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>
        <div class="modal-card">
            <span class="modal-id">{{ $departemen->id }}</span>
            <span class="modal-fn">destroy</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Pengajuan<br>Penghapusan Departemen</h5>
                    <p>
                        Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                    </p>
                </div>
            </div>
            <div class="form-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="name">Departemen</label>
                        <input id="name" type="text" autocomplete="off" value="{{ $departemen->nama_dept }}" readonly>
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 5px; margin-top: 32px;">
                    <div class="form-field">
                        <label for="atasan1">Nama Atasan 1</label>
                        <input id="atasan1" type="text" autocomplete="off" value="{{ $departemen->atasan1 }}" readonly>
                    </div>
                    <div class="form-field">
                        <label for="atasan1">Nomor WA Atasan 1</label>
                        <input id="atasan1" type="text" autocomplete="off" value="{{ $departemen->telp_1 }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="atasan1">Nama Atasan 1</label>
                        <input id="atasan1" type="text" autocomplete="off" value="{{ $departemen->atasan1 }}" readonly>
                    </div>
                    <div class="form-field">
                        <label for="atasan1">Nomor WA Atasan 1</label>
                        <input id="atasan1" type="text" autocomplete="off" value="{{ $departemen->telp_1 }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="atasan3">Nama Atasan 3 (Optional)</label>
                        <input id="atasan3" type="text" autocomplete="off"
                        @if ($departemen->atasan3 !== null)
                            placeholder="{{ $departemen->atasan3 }}"
                            @else
                            placeholder="--;--"
                        @endif
                        readonly> 
                    </div>
                    <div class="form-field">
                        <label for="atasan3">Nomor WA Atasan 3 (Optional)</label>
                        <input id="atasan3" type="text" autocomplete="off"
                        @if ($departemen->telp_3 !== null)
                            placeholder="{{ $departemen->telp_3 }}"
                            @else
                            placeholder="--;--"
                        @endif
                        readonly> 
                    </div>
                </div>
                <div class="form-row" style="margin-top: 32px">
                    <div class="form-field">
                        <label for="status">Status Departemen</label>
                        <input id="status" type="text" autocomplete="off" value="{{ $departemen->status }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="ket">Keterangan Pengirim</label>
                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                    </div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button wire:click="reqDestroy({{ $departemen->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
                </div>
            </div>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>
    @endforeach
</div>