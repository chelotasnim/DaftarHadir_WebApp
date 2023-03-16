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

    @error('check_log')

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

                <h5>Formulir Pengajuan<br>Penambahan Presensi</h5>

                <p>

                    Ini merupakan form pengajuan izin penambahan data. Penambahan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                </p>

            </div>

        </div>

        <div class="form-form">

            <div class="form-row" style="margin-bottom: 12px">

                <div class="form-field">

                    <label for="nama">Nama Pegawai</label>

                    <input id="nama" type="text" class="filter-input" autocomplete="off">

                </div>

                <div class="related-list" style="left: 0">

                    @can('highOfficer')

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

                <div class="form-field">

                    <label for="timeIn">Jam Check Log</label>

                    <input wire:model.defer="check_log" id="timeIn" type="time">

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

                <button wire:click="reqNew" class="new evented-btn">Kirim Pengajuan Presensi</button>

            </div>

        </div>

        <div onclick="closeModal(this)" class="close-btn">

            <i class="fa-solid fa-square-xmark"></i>

        </div>

    </div>



    @foreach ($presensis as $presensi)

        <div class="modal-card">

            <span class="modal-id">{{ $presensi->id }}</span>

            <span class="modal-fn">destroy</span>

            <div class="form-head">

                <div class="form-image">

                    <img src="{{ asset('assets/form-image.png') }}" draggable="false"/>

                </div>

                <div class="form-header">

                    <h5>Formulir Pengajuan<br>Penghapusan Presensi</h5>

                    <p>

                        Ini merupakan form pengajuan izin penghapusan data. Penghapusan dapat diizinkan ataupun ditolak oleh atasan. Cek status pengajuan <a href="">disini.</a>

                    </p>

                </div>

            </div>

            <div class="form-form">

                <div class="form-row" style="margin-bottom: 12px">

                    <div class="form-field">

                        <label for="nama">Nama Pegawai</label>

                        <input id="nama" type="text" autocomplete="off" value="{{ $presensi->pegawai->nama }}" disabled>

                    </div>

                    <div class="form-field">

                        <label>Jam Check Log</label>

                        <input type="text" value="@if (!empty($presensi->check_log)){{ $presensi->check_log }} WIB @else{{ '--:--' }}@endif

                        " disabled>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-field">

                        <label for="ket">Keterangan Pengirim</label>

                        <textarea wire:model.defer="keterangan_pengirim" id="ket" placeholder="Lengkapi keterangan, seperti alasan pengajuan, fungsi, tujuan dan lain lain"></textarea>

                    </div>

                </div>

                <div onmouseover="resetError()" class="form-submit-btn">

                    <button wire:click="reqDestroy({{ $presensi->id }})" class="destroy evented-btn">Kirim Pengajuan Presensi</button>

                </div>

            </div>

            <div onclick="closeModal(this)" class="close-btn">

                <i class="fa-solid fa-square-xmark"></i>

            </div>

        </div>         

    @endforeach

</div>