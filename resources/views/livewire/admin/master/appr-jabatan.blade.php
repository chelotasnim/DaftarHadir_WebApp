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

    @error('jadwal_id')

        <div class="notif new">

            <i class="fa-solid fa-triangle-exclamation"></i>

            {{ $message }}

        </div>

    @enderror

    @error('jabatan')

        <div class="notif new">

            <i class="fa-solid fa-triangle-exclamation"></i>

            {{ $message }}

        </div>

    @enderror

    @error('jatah_cuti_tahunan_tahunan')

        <div class="notif new">

            <i class="fa-solid fa-triangle-exclamation"></i>

            {{ $message }}

        </div>

    @enderror

    @error('gaji')

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

                <h5>Formulir Pengajuan<br>Penambahan Jabatan</h5>

                <p>

                    Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                </p>

            </div>

        </div>

        <div class="form-form">

            <div class="form-row">

                <div class="form-field">

                    <label for="jabatan">Jabatan</label>

                    <input wire:model.defer="jabatan" id="jabatan" type="text" autocomplete="off">

                </div>

            </div>

            <div class="form-row" style="margin-bottom: 5px">

                <div class="form-field">

                    <label for="jadwal">Jadwal Kerja</label>

                    <input id="jadwal" type="text" class="filter-input" autocomplete="off">

                </div>

                <div class="related-list" style="left: 0">

                    @can('highOfficer')

                        @foreach ($departemens as $depar)

                            @foreach ($depar->jadwals as $jadwal)

                                @if ($jadwal->status === 'Aktif')

                                    <p>

                                        <span class="related-title">{{ $jadwal->nama_jadwal }}</span>

                                        <input wire:model.defer="jadwal_id" type="radio" name="jadwal" value="{{ $jadwal->id }}">

                                    </p>

                                @endif

                            @endforeach

                        @endforeach

                    @else 

                        @foreach ($departemens as $depar)

                            @if ($depar->id == Auth::user()->departemen_id)

                                @foreach ($depar->jadwals as $jadwal)

                                    @if ($jadwal->status === 'Aktif')

                                        <p>

                                            <span class="related-title">{{ $jadwal->nama_jadwal }}</span>

                                            <input wire:model.defer="jadwal_id" type="radio" name="jadwal" value="{{ $jadwal->id }}">

                                        </p>

                                    @endif

                                @endforeach

                            @endif

                        @endforeach

                    @endcan

                </div>

                <div class="form-field">

                    <label for="jatah_cuti_tahunan">Jatah Cuti Tahunan</label>

                    <input wire:model.defer="jatah_cuti_tahunan" id="jatah_cuti_tahunan" type="number" autocomplete="off">

                </div>

            </div>

            <div class="form-row">

                <div class="form-field">

                    <label for="gaji">Gaji Perbulan</label>

                    <input wire:model.defer="gaji" id="gaji" type="number" autocomplete="off">

                </div>

            </div>

            <div class="form-row" style="margin-bottom: 32px">

                <div class="form-field">

                    <label for="status">Status Jabatan</label>

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

                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Jabatan</button>

            </div>

        </div>

        <div onclick="closeModal(this)" class="close-btn">

            <i class="fa-solid fa-square-xmark"></i>

        </div>

    </div>



    @can('highOfficer')

        @foreach ($departemens as $depar)

            @foreach ($depar->jadwals as $jadwal)

                @foreach ($jadwal->jabatans as $jabatan)

                    <div class="modal-card">

                        <span class="modal-id">{{ $jabatan->id }}</span>

                        <span class="modal-fn">change</span>

                        <div class="form-head">

                            <div class="form-image">

                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>

                            </div>

                            <div class="form-header">

                                <h5>Formulir Pengajuan<br>Perubahan Jabatan</h5>

                                <p>

                                    Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                                </p>

                            </div>

                        </div>

                        <div class="form-form">

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="jabatan">Jabatan</label>

                                    <input wire:model.defer="jabatan" id="jabatan" type="text" autocomplete="off" placeholder="{{ $jabatan->jabatan }}">

                                </div>

                            </div>

                            <div class="form-row" style="margin-bottom: 5px">

                                <div class="form-field">

                                    <label for="jadwal">Jadwal Kerja</label>

                                    <input id="jadwal" type="text" class="filter-input" autocomplete="off" placeholder="{{ $jabatan->jadwal->nama_jadwal }}">

                                </div>

                                <div class="related-list" style="left: 0">

                                    @foreach ($departemens as $depar)

                                        @foreach ($depar->jadwals as $jadwal)

                                            @if ($jadwal->status === 'Aktif')

                                                <p>

                                                    <span class="related-title">{{ $jadwal->nama_jadwal }}</span>

                                                    <input wire:model.defer="jadwal_id" type="radio" name="jadwal" value="{{ $jadwal->id }}">

                                                </p>

                                            @endif

                                        @endforeach

                                    @endforeach

                                </div>

                                <div class="form-field">

                                    <label for="jatah_cuti_tahunan">Jatah Cuti Tahunan</label>

                                    <input wire:model.defer="jatah_cuti_tahunan" id="jatah_cuti_tahunan" type="number" autocomplete="off" placeholder="{{ $jabatan->jatah_cuti_tahunan }}">

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="gaji">Gaji Perbulan</label>

                                    <input wire:model.defer="gaji" id="gaji" type="number" autocomplete="off" placeholder="{{ $jabatan->gaji }}">

                                </div>

                            </div>

                            <div class="form-row" style="margin-bottom: 32px">

                                <div class="form-field">

                                    <label for="status">Status Jabatan</label>

                                    <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $jabatan->status }}">

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

                                <button wire:click="reqChange({{ $jabatan->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>

                            </div>

                        </div>

                        <div onclick="closeModal(this)" class="close-btn">

                            <i class="fa-solid fa-square-xmark"></i>

                        </div>

                    </div>



                    <div class="modal-card">

                        <span class="modal-id">{{ $jabatan->id }}</span>

                        <span class="modal-fn">destroy</span>

                        <div class="form-head">

                            <div class="form-image">

                                <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>

                            </div>

                            <div class="form-header">

                                <h5>Formulir Pengajuan<br>Penghapusan Jabatan</h5>

                                <p>

                                    Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                                </p>

                            </div>

                        </div>

                        <div class="form-form">

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="jabatan">Jabatan</label>

                                    <input id="jabatan" type="text" autocomplete="off" readonly value="{{ $jabatan->jabatan }}">

                                </div>

                            </div>

                            <div class="form-row" style="margin-bottom: 5px">

                                <div class="form-field">

                                    <label for="jadwal">Jadwal Kerja</label>

                                    <input id="jadwal" type="text" autocomplete="off" readonly value="{{ $jabatan->jadwal->nama_jadwal }}">

                                </div>

                                <div class="form-field">

                                    <label for="jatah_cuti_tahunan">Jatah Cuti Tahunan</label>

                                    <input wire:model.defer="jatah_cuti_tahunan" id="jatah_cuti_tahunan" type="number" autocomplete="off" placeholder="{{ $jabatan->jatah_cuti_tahunan }}">

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="gaji">Gaji Perbulan</label>

                                    <input id="gaji" type="number" autocomplete="off" readonly placeholder="{{ $jabatan->gaji }}">

                                </div>

                            </div>

                            <div class="form-row" style="margin-bottom: 32px">

                                <div class="form-field">

                                    <label for="status">Status Jabatan</label>

                                    <input id="status" type="text" autocomplete="off" readonly value="{{ $jabatan->status }}">

                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="ket">Keterangan Pengirim</label>

                                    <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>

                                </div>

                            </div>

                            <div onmouseover="resetError()" class="form-submit-btn">

                                <button wire:click="reqDestroy({{ $jabatan->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>

                            </div>

                        </div>

                        <div onclick="closeModal(this)" class="close-btn">

                            <i class="fa-solid fa-square-xmark"></i>

                        </div>

                    </div>

                @endforeach

            @endforeach

        @endforeach

    @else

        @foreach ($departemens as $depar)

            @if ($depar->id == Auth::user()->departemen_id)

                @foreach ($depar->jadwals as $jadwal)

                    @foreach ($jadwal->jabatans as $jabatan)

                        <div class="modal-card">

                            <span class="modal-id">{{ $jabatan->id }}</span>

                            <span class="modal-fn">change</span>

                            <div class="form-head">

                                <div class="form-image">

                                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>

                                </div>

                                <div class="form-header">

                                    <h5>Formulir Pengajuan<br>Perubahan Jabatan</h5>

                                    <p>

                                        Ini merupakan form pengajuan izin perubahan data. Perubahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                                    </p>

                                </div>

                            </div>

                            <div class="form-form">

                                <div class="form-row">

                                    <div class="form-field">

                                        <label for="jabatan">Jabatan</label>

                                        <input wire:model.defer="jabatan" id="jabatan" type="text" autocomplete="off" placeholder="{{ $jabatan->jabatan }}">

                                    </div>

                                </div>

                                <div class="form-row" style="margin-bottom: 5px">

                                    <div class="form-field">

                                        <label for="jadwal">Jadwal Kerja</label>

                                        <input id="jadwal" type="text" class="filter-input" autocomplete="off" placeholder="{{ $jabatan->jadwal->nama_jadwal }}">

                                    </div>

                                    <div class="related-list" style="left: 0">

                                        @foreach ($departemens as $depar)

                                            @foreach ($depar->jadwals as $jadwal)

                                                @if ($jadwal->status === 'Aktif')

                                                    <p>

                                                        <span class="related-title">{{ $jadwal->nama_jadwal }}</span>

                                                        <input wire:model.defer="jadwal_id" type="radio" name="jadwal" value="{{ $jadwal->id }}">

                                                    </p>

                                                @endif

                                            @endforeach

                                        @endforeach

                                    </div>

                                    <div class="form-field">

                                        <label for="jatah_cuti_tahunan">Jatah Cuti Tahunan</label>

                                        <input wire:model.defer="jatah_cuti_tahunan" id="jatah_cuti_tahunan" type="number" autocomplete="off" placeholder="{{ $jabatan->jatah_cuti_tahunan }}">

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-field">

                                        <label for="gaji">Gaji Perbulan</label>

                                        <input wire:model.defer="gaji" id="gaji" type="number" autocomplete="off" placeholder="{{ $jabatan->gaji }}">

                                    </div>

                                </div>

                                <div class="form-row" style="margin-bottom: 32px">

                                    <div class="form-field">

                                        <label for="status">Status Jabatan</label>

                                        <input id="status" type="text" class="filter-input" autocomplete="off" placeholder="{{ $jabatan->status }}">

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

                                    <button wire:click="reqChange({{ $jabatan->id }})" class="change evented-btn">Kirim Pengajuan Perubahan</button>

                                </div>

                            </div>

                            <div onclick="closeModal(this)" class="close-btn">

                                <i class="fa-solid fa-square-xmark"></i>

                            </div>

                        </div>



                        <div class="modal-card">

                            <span class="modal-id">{{ $jabatan->id }}</span>

                            <span class="modal-fn">destroy</span>

                            <div class="form-head">

                                <div class="form-image">

                                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>

                                </div>

                                <div class="form-header">

                                    <h5>Formulir Pengajuan<br>Penghapusan Jabatan</h5>

                                    <p>

                                        Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                                    </p>

                                </div>

                            </div>

                            <div class="form-form">

                                <div class="form-row">

                                    <div class="form-field">

                                        <label for="jabatan">Jabatan</label>

                                        <input id="jabatan" type="text" autocomplete="off" readonly value="{{ $jabatan->jabatan }}">

                                    </div>

                                </div>

                                <div class="form-row" style="margin-bottom: 5px">

                                    <div class="form-field">

                                        <label for="jadwal">Jadwal Kerja</label>

                                        <input id="jadwal" type="text" autocomplete="off" readonly value="{{ $jabatan->jadwal->nama_jadwal }}">

                                    </div>

                                    <div class="form-field">

                                        <label for="jatah_cuti_tahunan">Jatah Cuti Tahunan</label>

                                        <input wire:model.defer="jatah_cuti_tahunan" id="jatah_cuti_tahunan" type="number" autocomplete="off" placeholder="{{ $jabatan->jatah_cuti_tahunan }}">

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-field">

                                        <label for="gaji">Gaji Perbulan</label>

                                        <input id="gaji" type="number" autocomplete="off" readonly placeholder="{{ $jabatan->gaji }}">

                                    </div>

                                </div>

                                <div class="form-row" style="margin-bottom: 32px">

                                    <div class="form-field">

                                        <label for="status">Status Jabatan</label>

                                        <input id="status" type="text" autocomplete="off" readonly value="{{ $jabatan->status }}">

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-field">

                                        <label for="ket">Keterangan Pengirim</label>

                                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>

                                    </div>

                                </div>

                                <div onmouseover="resetError()" class="form-submit-btn">

                                    <button wire:click="reqDestroy({{ $jabatan->id }})" class="destroy evented-btn">Kirim Pengajuan Penghapusan</button>

                                </div>

                            </div>

                            <div onclick="closeModal(this)" class="close-btn">

                                <i class="fa-solid fa-square-xmark"></i>

                            </div>

                        </div>

                    @endforeach

                @endforeach

            @endif

        @endforeach

    @endcan

</div>