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
    @error('departemen_id')
        <div class="notif new">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ $message }}
        </div>
    @enderror
    @error('aktivitas')
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
                <h5>Formulir Pengajuan<br>Penambahan Aktivitas</h5>
                <p>
                    Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                </p>
            </div>
        </div>
        <div class="form-form">
            <div class="form-row">
                <div class="form-field">
                    <label for="departemen">Departemen</label>
                    <input id="departemen" type="text" class="filter-input" autocomplete="off">
                </div>
                <div class="related-list" style="left: 0">
                    @can('highOfficer')
                        @foreach ($departemens as $depar)
                            <p>
                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                <input wire:model.defer="departemen_id" type="radio" name="deaprtemen" value="{{ $depar->id }}">
                            </p>
                        @endforeach
                    @else
                        @foreach ($departemens as $depar)
                            @if ($depar->id == Auth::user()->departemen_id)
                                <p>
                                    <span class="related-title">{{ $depar->nama_dept }}</span>
                                    <input wire:model.defer="departemen_id" type="radio" name="deaprtemen" value="{{ $depar->id }}">
                                </p>
                            @endif
                        @endforeach
                    @endcan
                </div>
                <div class="form-field">
                    <label for="aktivitas">Jenis Aktivitas</label>
                    <input wire:model.defer="aktivitas" id="aktivitas" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 32px">
                <div class="form-field">
                    <label for="status">Status Aktivitas</label>
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
                <button wire:click="reqNew()" class="new evented-btn">Kirim Pengajuan Aktivitas</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>

    @can('highOfficer')
        @foreach ($departemens as $depar)
            @foreach ($depar->aktivitas as $aktivitas)
                <div class="modal-card">
                    <span class="modal-id">{{ $aktivitas->id }}</span>
                    <span class="modal-fn">change</span>
                    <div class="form-head">
                        <div class="form-image">
                            <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                        </div>
                        <div class="form-header">
                            <h5>Formulir Pengajuan<br>Perubahan Aktivitas</h5>
                            <p>
                                Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-form">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="departemen">Departemen</label>
                                <input id="departemen" type="text" class="filter-input" autocomplete="off" placeholder="{{ $aktivitas->departemen->nama_dept }}">
                            </div>
                            <div class="related-list" style="left: 0">
                                @can('highOfficer')
                                    @foreach ($departemens as $depar)
                                        <p>
                                            <span class="related-title">{{ $depar->nama_dept }}</span>
                                            <input wire:model.defer="departemen_id" type="radio" name="deaprtemen" value="{{ $depar->id }}">
                                        </p>
                                    @endforeach
                                @else
                                    @foreach ($departemens as $depar)
                                        @if ($depar->id == Auth::user()->departemen_id)
                                            <p>
                                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                                <input wire:model.defer="departemen_id" type="radio" name="deaprtemen" value="{{ $depar->id }}">
                                            </p>
                                        @endif
                                    @endforeach
                                @endcan
                            </div>
                            <div class="form-field">
                                <label for="aktivitas">Jenis Aktivitas</label>
                                <input wire:model.defer="aktivitas" id="aktivitas" type="text" autocomplete="off" placeholder="{{ $aktivitas->aktivitas }}">
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 32px">
                            <div class="form-field">
                                <label for="status">Status Aktivitas</label>
                                <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $aktivitas->status }}">
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
                            <button wire:click="reqChange({{ $aktivitas->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                        </div>
                    </div>
                    <div onclick="closeModal(this)" class="close-btn">
                        <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </div>

                <div class="modal-card">
                    <span class="modal-id">{{ $aktivitas->id }}</span>
                    <span class="modal-fn">destroy</span>
                    <div class="form-head">
                        <div class="form-image">
                            <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                        </div>
                        <div class="form-header">
                            <h5>Formulir Pengajuan<br>Penghapusan Aktivitas</h5>
                            <p>
                                Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-form">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="departemen">Departemen</label>
                                <input id="departemen" type="text" autocomplete="off" placeholder="{{ $aktivitas->departemen->nama_dept }}" disabled>
                            </div>
                            <div class="form-field">
                                <label for="aktivitas">Jenis Aktivitas</label>
                                <input id="aktivitas" type="text" autocomplete="off" placeholder="{{ $aktivitas->aktivitas }}" disabled>
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 32px">
                            <div class="form-field">
                                <label for="status">Status Aktivitas</label>
                                <input id="status" type="text" autocomplete="off" placeholder="{{ $aktivitas->status }}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="ket">Keterangan Pengirim</label>
                                <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                            </div>
                        </div>
                        <div onmouseover="resetError()" class="form-submit-btn">
                            <button wire:click="reqDestroy({{ $aktivitas->id }})" class="destroy evented-btn">Kirim Pengajuan Perubahan</button>
                        </div>
                    </div>
                    <div onclick="closeModal(this)" class="close-btn">
                        <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </div>
            @endforeach
        @endforeach
    @else
        @foreach ($departemens as $depar)
            @if ($depar->id == Auth::user()->departemen_id)
                @foreach ($depar->aktivitas as $aktivitas)
                    <div class="modal-card">
                        <span class="modal-id">{{ $aktivitas->id }}</span>
                        <span class="modal-fn">change</span>
                        <div class="form-head">
                            <div class="form-image">
                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                            </div>
                            <div class="form-header">
                                <h5>Formulir Pengajuan<br>Perubahan Aktivitas</h5>
                                <p>
                                    Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-form">
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" class="filter-input" autocomplete="off" placeholder="{{ $aktivitas->departemen->nama_dept }}">
                                </div>
                                <div class="related-list" style="left: 0">
                                    @can('highOfficer')
                                        @foreach ($departemens as $depar)
                                            <p>
                                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                                <input wire:model.defer="departemen_id" type="radio" name="deaprtemen" value="{{ $depar->id }}">
                                            </p>
                                        @endforeach
                                    @else
                                        @foreach ($departemens as $depar)
                                            @if ($depar->id == Auth::user()->departemen_id)
                                                <p>
                                                    <span class="related-title">{{ $depar->nama_dept }}</span>
                                                    <input wire:model.defer="departemen_id" type="radio" name="deaprtemen" value="{{ $depar->id }}">
                                                </p>
                                            @endif
                                        @endforeach
                                    @endcan
                                </div>
                                <div class="form-field">
                                    <label for="aktivitas">Jenis Aktivitas</label>
                                    <input wire:model.defer="aktivitas" id="aktivitas" type="text" autocomplete="off" placeholder="{{ $aktivitas->aktivitas }}">
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 32px">
                                <div class="form-field">
                                    <label for="status">Status Aktivitas</label>
                                    <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $aktivitas->status }}">
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
                                <button wire:click="reqChange({{ $aktivitas->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                            </div>
                        </div>
                        <div onclick="closeModal(this)" class="close-btn">
                            <i class="fa-solid fa-square-xmark"></i>
                        </div>
                    </div>

                    <div class="modal-card">
                        <span class="modal-id">{{ $aktivitas->id }}</span>
                        <span class="modal-fn">destroy</span>
                        <div class="form-head">
                            <div class="form-image">
                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                            </div>
                            <div class="form-header">
                                <h5>Formulir Pengajuan<br>Penghapusan Aktivitas</h5>
                                <p>
                                    Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-form">
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" autocomplete="off" placeholder="{{ $aktivitas->departemen->nama_dept }}" disabled>
                                </div>
                                <div class="form-field">
                                    <label for="aktivitas">Jenis Aktivitas</label>
                                    <input id="aktivitas" type="text" autocomplete="off" placeholder="{{ $aktivitas->aktivitas }}" disabled>
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 32px">
                                <div class="form-field">
                                    <label for="status">Status Aktivitas</label>
                                    <input id="status" type="text" autocomplete="off" placeholder="{{ $aktivitas->status }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="ket">Keterangan Pengirim</label>
                                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                </div>
                            </div>
                            <div onmouseover="resetError()" class="form-submit-btn">
                                <button wire:click="reqDestroy({{ $aktivitas->id }})" class="destroy evented-btn">Kirim Pengajuan Perubahan</button>
                            </div>
                        </div>
                        <div onclick="closeModal(this)" class="close-btn">
                            <i class="fa-solid fa-square-xmark"></i>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    @endcan
</div>