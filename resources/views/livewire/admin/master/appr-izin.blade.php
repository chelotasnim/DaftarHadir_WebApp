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
    @error('keterangan_izin')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('kode_izin')
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
                    <label for="nama">Keterangan Izin</label>
                    <input wire:model.defer="keterangan_izin" id="nama" type="text" autocomplete="off">
                </div>
                <div class="form-field">
                    <label for="symbol">Kode Izin</label>
                    <input wire:model.defer="kode_izin" id="symbol" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin: 0">
                <div class="form-field">
                    <label for="ket">Keterangan Pengirim</label>
                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                </div>
            </div>
            <div onmouseover="resetError()" class="form-submit-btn">
                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Keterangan Izin</button>
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
                        <label for="nama">Keterangan Izin</label>
                        <input wire:model.defer="keterangan_izin" id="nama" type="text" autocomplete="off" placeholder="{{ $izin->keterangan_izin }}">
                    </div>
                    <div class="form-field">
                        <label for="symbol">Kode Izin</label>
                        <input wire:model.defer="kode_izin" id="symbol" type="text" autocomplete="off" placeholder="{{ $izin->kode_izin }}">
                    </div>
                </div>
                <div class="form-row" style="margin: 0">
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
                        <label for="nama">Keterangan Izin</label>
                        <input id="nama" type="text" autocomplete="off" value="{{ $izin->keterangan_izin }}" readonly>
                    </div>
                    <div class="form-field">
                        <label for="symbol">Kode Izin</label>
                        <input id="symbol" type="text" autocomplete="off" value="{{ $izin->kode_izin }}" readonly>
                    </div>
                </div>
                <div class="form-row" style="margin: 0">
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