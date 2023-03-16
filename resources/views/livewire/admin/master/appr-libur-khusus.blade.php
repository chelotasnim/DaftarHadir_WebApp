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
    @error('nama_libur')
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
    @error('pengumuman')
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
                <h5>Formulir Pengajuan<br>Penambahan Libur</h5>
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
                                <input wire:model.defer="departemen_id" type="radio" value="{{ $depar->id }}">
                            </p>
                        @endforeach
                    @else
                        @foreach ($departemens as $depar)
                            @if ($depar->id == Auth::user()->departemen_id)
                                <p>
                                    <span class="related-title">{{ $depar->nama_dept }}</span>
                                    <input wire:model.defer="departemen_id" type="radio" value="{{ $depar->id }}">
                                </p>
                            @endif
                        @endforeach
                    @endcan
                </div>
                <div class="form-field">
                    <label for="name">Nama Libur</label>
                    <input wire:model.defer="nama_libur" id="name" type="text" autocomplete="off">
                </div>
            </div>
            <div class="form-row" style="margin: 24px 0">
                <div class="form-field">
                    <label for="mulai">Dari Tanggal</label>
                    <input wire:model.defer="mulai" id="mulai" type="date">
                </div>
                <div class="form-field">
                    <label for="akhir">Sampai Tanggal (Optional)</label>
                    <input wire:model.defer="sampai" id="akhir" type="date">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="note">Ucapan / Pengumuman</label>
                    <textarea wire:model.defer="pengumuman" id="note"></textarea>
                </div>
                <div class="form-field">
                    <label for="ket">Keterangan Pengirim</label>
                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                </div>
            </div>
            <div onmouseover="resetError()" class="form-submit-btn">
                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Libur</button>
            </div>
        </div>
        <div onclick="closeModal(this)" class="close-btn">
            <i class="fa-solid fa-square-xmark"></i>
        </div>
    </div>
    
    @can('highOfficer')
        @foreach ($departemens as $depar)
            @foreach ($depar->liburKhusus as $libur)
                <div class="modal-card">
                    <span class="modal-id">{{ $libur->id }}</span>
                    <span class="modal-fn">change</span>
                    <div class="form-head">
                        <div class="form-image">
                            <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                        </div>
                        <div class="form-header">
                            <h5>Formulir Pengajuan<br>Perubahan Libur</h5>
                            <p>
                                Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-form">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="departemen">Departemen</label>
                                <input id="departemen" type="text" class="filter-input" autocomplete="off" placeholder="{{ $libur->departemen->nama_dept }}">
                            </div>
                            <div class="related-list" style="left: 0">
                                @can('highOfficer')
                                    @foreach ($departemens as $depar)
                                        <p>
                                            <span class="related-title">{{ $depar->nama_dept }}</span>
                                            <input wire:model.defer="departemen_id" type="radio" value="{{ $depar->id }}">
                                        </p>
                                    @endforeach
                                @else
                                    @foreach ($departemens as $depar)
                                        @if ($depar->id == Auth::user()->departemen_id)
                                            <p>
                                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                                <input wire:model.defer="departemen_id" type="radio" value="{{ $depar->id }}">
                                            </p>
                                        @endif
                                    @endforeach
                                @endcan
                            </div>
                            <div class="form-field">
                                <label for="name">Nama Libur</label>
                                <input wire:model.defer="nama_libur" id="name" type="text" placeholder="{{ $libur->nama_libur }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row" style="margin: 24px 0">
                            <div class="form-field">
                                <label for="mulai">Dari Tanggal</label>
                                <input wire:model.defer="mulai" id="mulai" placeholder="{{ $libur->mulai }}" type="text" class="text-to-date">
                            </div>
                            <div class="form-field">
                                <label for="akhir">Sampai Tanggal (Optional)</label>
                                <input wire:model.defer="sampai" id="akhir" placeholder="{{ $libur->sampai }}" type="text" class="text-to-date">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="note">Ucapan / Pengumuman</label>
                                <textarea wire:model.defer="pengumuman" placeholder="{{ $libur->pengumuman }}" id="note"></textarea>
                            </div>
                            <div class="form-field">
                                <label for="ket">Keterangan Pengirim</label>
                                <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                            </div>
                        </div>
                        <div onmouseover="resetError()" class="form-submit-btn">
                            <button wire:click="reqChange({{ $libur->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                        </div>
                    </div>
                    <div onclick="closeModal(this)" class="close-btn">
                        <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </div>

                <div class="modal-card">
                    <span class="modal-id">{{ $libur->id }}</span>
                    <span class="modal-fn">destroy</span>
                    <div class="form-head">
                        <div class="form-image">
                            <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                        </div>
                        <div class="form-header">
                            <h5>Formulir Pengajuan<br>Penghapusan Libur</h5>
                            <p>
                                Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-form">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="departemen">Departemen</label>
                                <input id="departemen" type="text" value="{{ $libur->departemen->nama_dept }}" disabled>
                            </div>
                            <div class="form-field">
                                <label for="name">Nama Libur</label>
                                <input id="name" type="text" value="{{ $libur->nama_libur }}" autocomplete="off" disabled>
                            </div>
                        </div>
                        <div class="form-row" style="margin: 24px 0">
                            <div class="form-field">
                                <label for="mulai">Dari Tanggal</label>
                                <input id="mulai" value="{{ $libur->mulai }}" type="text" disabled>
                            </div>
                            <div class="form-field">
                                <label for="akhir">Sampai Tanggal (Optional)</label>
                                <input id="akhir" value="{{ $libur->sampai }}" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="note">Ucapan / Pengumuman</label>
                                <textarea id="note" disabled>{{ $libur->pengumuman }}</textarea>
                            </div>
                            <div class="form-field">
                                <label for="ket">Keterangan Pengirim</label>
                                <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                            </div>
                        </div>
                        <div onmouseover="resetError()" class="form-submit-btn">
                            <button wire:click="reqDestroy({{ $libur->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
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
                @foreach ($depar->liburKhusus as $libur)
                    <div class="modal-card">
                        <span class="modal-id">{{ $libur->id }}</span>
                        <span class="modal-fn">change</span>
                        <div class="form-head">
                            <div class="form-image">
                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                            </div>
                            <div class="form-header">
                                <h5>Formulir Pengajuan<br>Perubahan Libur</h5>
                                <p>
                                    Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-form">
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" class="filter-input" autocomplete="off" placeholder="{{ $libur->departemen->nama_dept }}">
                                </div>
                                <div class="related-list" style="left: 0">
                                    @can('highOfficer')
                                        @foreach ($departemens as $depar)
                                            <p>
                                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                                <input wire:model.defer="departemen_id" type="radio" value="{{ $depar->id }}">
                                            </p>
                                        @endforeach
                                    @else
                                        @foreach ($departemens as $depar)
                                            @if ($depar->id == Auth::user()->departemen_id)
                                                <p>
                                                    <span class="related-title">{{ $depar->nama_dept }}</span>
                                                    <input wire:model.defer="departemen_id" type="radio" value="{{ $depar->id }}">
                                                </p>
                                            @endif
                                        @endforeach
                                    @endcan
                                </div>
                                <div class="form-field">
                                    <label for="name">Nama Libur</label>
                                    <input wire:model.defer="nama_libur" id="name" type="text" placeholder="{{ $libur->nama_libur }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-row" style="margin: 24px 0">
                                <div class="form-field">
                                    <label for="mulai">Dari Tanggal</label>
                                    <input wire:model.defer="mulai" id="mulai" placeholder="{{ $libur->mulai }}" type="text" class="text-to-date">
                                </div>
                                <div class="form-field">
                                    <label for="akhir">Sampai Tanggal (Optional)</label>
                                    <input wire:model.defer="sampai" id="akhir" placeholder="{{ $libur->sampai }}" type="text" class="text-to-date">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="note">Ucapan / Pengumuman</label>
                                    <textarea wire:model.defer="pengumuman" placeholder="{{ $libur->pengumuman }}" id="note"></textarea>
                                </div>
                                <div class="form-field">
                                    <label for="ket">Keterangan Pengirim</label>
                                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                </div>
                            </div>
                            <div onmouseover="resetError()" class="form-submit-btn">
                                <button wire:click="reqChange({{ $libur->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>
                            </div>
                        </div>
                        <div onclick="closeModal(this)" class="close-btn">
                            <i class="fa-solid fa-square-xmark"></i>
                        </div>
                    </div>

                    <div class="modal-card">
                        <span class="modal-id">{{ $libur->id }}</span>
                        <span class="modal-fn">destroy</span>
                        <div class="form-head">
                            <div class="form-image">
                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>
                            </div>
                            <div class="form-header">
                                <h5>Formulir Pengajuan<br>Penghapusan Libur</h5>
                                <p>
                                    Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-form">
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="departemen">Departemen</label>
                                    <input id="departemen" type="text" value="{{ $libur->departemen->nama_dept }}" disabled>
                                </div>
                                <div class="form-field">
                                    <label for="name">Nama Libur</label>
                                    <input id="name" type="text" value="{{ $libur->nama_libur }}" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="form-row" style="margin: 24px 0">
                                <div class="form-field">
                                    <label for="mulai">Dari Tanggal</label>
                                    <input id="mulai" value="{{ $libur->mulai }}" type="text" disabled>
                                </div>
                                <div class="form-field">
                                    <label for="akhir">Sampai Tanggal (Optional)</label>
                                    <input id="akhir" value="{{ $libur->sampai }}" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="note">Ucapan / Pengumuman</label>
                                    <textarea id="note" disabled>{{ $libur->pengumuman }}</textarea>
                                </div>
                                <div class="form-field">
                                    <label for="ket">Keterangan Pengirim</label>
                                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>
                                </div>
                            </div>
                            <div onmouseover="resetError()" class="form-submit-btn">
                                <button wire:click="reqDestroy({{ $libur->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>
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