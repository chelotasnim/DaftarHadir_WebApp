@extends('admin.pengumuman.notifikasi')

@section('message_event')
    
    <div class="data-grid rekap-grid">
        <table class="rekap-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Target</th>
                    <th style="text-align: left">Pesan</th>
                    <th>Notifikasi</th>
                    <th>*</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $template)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $template->target }}</td>
                        <td><textarea readonly class="message-templating">{{ $template->template }}</textarea></td>
                        <td>
                            @if ($template->notifikasi == 1)
                                <span style="margin: 0; display: inline-block" class="as-label green">Aktif</span>
                            @else
                                <span style="margin: 0; display: inline-block" class="as-label red">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="action">
                            <span style="margin: 0; display: inline-block" onclick="showModal({{ $template->id }}, 'change')" class="as-label evented-btn yellow modal-trigger">

                                <i class="fa-solid fa-pen-to-square"></i>
            
                            </span>
            
                            <span style="margin: 0; display: inline-block" onclick="showModal({{ $template->id }}, 'destroy')" class="as-label evented-btn red modal-trigger">
            
                                <i class="fa-solid fa-trash-can"></i>
            
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
        <div class="modal-card">
            <span class="modal-id">4dd</span>
            <span class="modal-fn">new</span>
            <div class="form-head">
                <div class="form-image">
                    <img src="{{ asset('assets/chat-template-form.png') }}" style="height: 150px" draggable="false"/>
                </div>
                <div class="form-header">
                    <h5>Formulir Penambahan<br>Template Pesan</h5>
                    <p>
                        Ini merupakan form untuk menambah template pesan ketika ada {{ $event }}
                    </p>
                </div>
            </div>
            <form class="form-form" action="/add-chat-template" method="POST">
                @csrf
                <div class="form-row" style="margin-bottom: 12px">
                    <div class="form-field">
                        <label for="target">Target Pesan</label>
                        <input id="target" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div class="related-list" style="left: 0">
                        <p>
                            <span class="related-title">Atasan</span>
                            <input pick-id="1" type="radio" class="pick-element" value="Atasan" endval="true-atasan">
                        </p>
                        <p>
                            <span class="related-title">Pegawai</span>
                            <input pick-id="1" type="radio" class="pick-element" value="Pegawai" endval="true-pegawai">
                        </p>
                        <p>
                            <span class="related-title">Lainnya</span>
                            <input pick-id="1" type="radio" class="pick-element" value="Lainnya" endval="true-lainnya">
                        </p>
                    </div>
                    <div triger-id="1" if-opt="Lainnya" class="element-by-opt form-field not-used">
                        <label for="target2">&nbsp;</label>
                        <div class="btn-on-field evented-btn custom-target">
                            <i class="fa-solid fa-plus"></i>
                            Tambah Target
                        </div>
                    </div>
                    <div triger-id="1" if-opt="Atasan" class="element-by-opt form-field not-used">
                        <label for="target2">Pilih Atasan</label>
                        <input id="target2" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div triger-id="1" if-opt="Atasan" class="element-by-opt related-list not-used">
                        <p>
                            <span class="related-title">Semua Atasan</span>
                            <input type="radio" class="pick-element" name="target" value="Semua Atasan {{ Auth::user()->instansi->nama_instansi }}" endval="true-atasan">
                        </p>
                        <p>
                            <span class="related-title">Atasan Departemen</span>
                            <input pick-id="2" type="radio" class="pick-element" value="Atasan_Departemen">
                        </p>
                    </div>
                    <div triger-id="1" if-opt="Pegawai" class="element-by-opt form-field not-used">
                        <label for="target2">Pilih Pegawai</label>
                        <input id="target2" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div triger-id="1" if-opt="Pegawai" class="element-by-opt related-list not-used">
                        <p>
                            <span class="related-title">Semua Pegawai</span>
                            <input type="radio" class="pick-element" name="target" value="Semua Pegawai {{ Auth::user()->instansi->nama_instansi }}" endval="true-pegawai">
                        </p>
                        <p>
                            <span class="related-title">Pegawai PerDepartemen</span>
                            <input pick-id="2" type="radio" class="pick-element" value="Pegawai_Departemen">
                        </p>
                        <p>
                            <span class="related-title">Pegawai PerJabatan</span>
                            <input pick-id="2" type="radio" class="pick-element" value="Pegawai_Jabatan">
                        </p>
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 12px">
                    <div triger-id="2" last-opt="true-atasan" if-opt="Atasan_Departemen" class="element-by-opt form-field not-used">
                        <label for="target2">Pilih Departemen</label>
                        <input id="target2" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div triger-id="2" last-opt="true-atasan" if-opt="Atasan_Departemen" class="element-by-opt related-list not-used" style="width: 100%">
                        @foreach ($departemens as $depar)
                            <p>
                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                <input type="radio" class="pick-element" name="target" value="Atasan {{ $depar->nama_dept }}">
                            </p>
                        @endforeach
                    </div>
                    <div triger-id="2" last-opt="true-pegawai" if-opt="Pegawai_Departemen" class="element-by-opt form-field not-used">
                        <label for="target2">Pilih Departemen</label>
                        <input id="target2" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div triger-id="2" last-opt="true-pegawai" if-opt="Pegawai_Departemen" class="element-by-opt related-list not-used" style="width: 100%">
                        @foreach ($departemens as $depar)
                            <p>
                                <span class="related-title">{{ $depar->nama_dept }}</span>
                                <input type="radio" class="pick-element" name="target" value="Pegawai Departemen {{ $depar->nama_dept }}">
                            </p>
                        @endforeach
                    </div>
                    <div triger-id="2" last-opt="true-pegawai" if-opt="Pegawai_Jabatan" class="element-by-opt form-field not-used">
                        <label for="target2">Pilih Jabatan</label>
                        <input id="target2" type="text" class="filter-input" autocomplete="off">
                    </div>
                    <div triger-id="2" last-opt="true-pegawai" if-opt="Pegawai_Jabatan" class="element-by-opt related-list not-used" style="width: 100%">
                        @foreach ($departemens as $depar)
                            @foreach ($depar->jadwals as $jadwal)
                                @foreach ($jadwal->jabatans as $jabatan)
                                    <p>
                                        <span class="related-title">{{ $jabatan->jabatan }}</span>
                                        <input type="radio" class="pick-element" name="target" value="Pegawai Jabatan {{ $jabatan->jabatan }}">
                                    </p>
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 18px">
                    <div class="form-field">
                        <label for="">Event Pesan</label>
                        <input type="text" name="event" value="{{ $event }}" readonly>
                    </div>
                    <div class="form-field">
                        <label for="">Notifikasi</label>
                        <input type="text" class="filter-input">
                    </div>
                    <div class="related-list" style="right: 0">
                        <p>
                            <span class="related-title">Aktif</span>
                            <input type="radio" name="notifikasi" value="1">
                        </p>
                        <p>
                            <span class="related-title">Tidak Aktif</span>
                            <input type="radio" name="notifikasi" value="0">
                        </p>
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 5px">
                    <div class="form-field">
                        <div class="btn-on-field evented-btn show-docs" style="width: max-content">
                            <i class="fa-solid fa-circle-info"></i>
                            Lihat keterangan tag disini
                        </div>
                    </div>
                </div>
                <div class="form-row" style="margin-bottom: 5px">
                    <div class="form-field" style="position: relative">
                        <textarea id="ket" class="style-faker" name="template" placeholder="Ketik template pesan saat {{ $event }} disini"></textarea>
                    </div>
                </div>
                <div class="form-row editor-styling">
                    <div class="form-badge evented-btn bold" onclick="formatMessage('*')">Bold</div>
                    <div class="form-badge evented-btn italic" onclick="formatMessage('_')">Italic</div>
                    <div class="form-badge evented-btn strike" onclick="formatMessage('~')">Strikethroug</div>
                </div>
                <div onmouseover="resetError()" class="form-submit-btn">
                    <button class="new evented-btn">Tambah Template Pesan</button>
                </div>
            </form>
            <div onclick="closeModal(this)" class="close-btn">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
        </div>
        <div class="floating-box">
            <div class="close-btn close-docs">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
            <ul class="docs-container">
                <li class="docs-list">
                    <div class="variable">[nama_pegawai]</div>
                    <div class="variable-desc">Format tag agar dapat diisi dengan nama pegawai secara otomatis</div>
                </li>
                <li class="docs-list">
                    <div class="variable">[nama_departemen]</div>
                    <div class="variable-desc">Format tag agar dapat diisi dengan nama departemen secara otomatis</div>
                </li>
                <li class="docs-list">
                    <div class="variable">[tgl_hari_ini]</div>
                    <div class="variable-desc">Format tag agar dapat diisi dengan tanggal hari ini secara otomatis</div>
                </li>
                @if ($event === 'Pendaftaran Pegawai')
                    <li class="docs-list">
                        <div class="variable">[email_pegawai]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan email pegawai secara otomatis</div>
                    </li>
                    <li class="docs-list">
                        <div class="variable">[wa_pegawai]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan WA pegawai secara otomatis</div>
                    </li>
                    <li class="docs-list">
                        <div class="variable">[jabatan]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan jabatan pegawai secara otomatis</div>
                    </li>
                @endif
                @if ($event === 'Absensi Masuk' || $event === 'Absensi Terlambat')
                    <li class="docs-list">
                        <div class="variable">[jam_datang]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan jam datang pegawai secara otomatis</div>
                    </li>
                    <li class="docs-list">
                        <div class="variable">[tgl_datang]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan tanggal datang pegawai secara otomatis</div>
                    </li>
                @endif
                @if ($event === 'Absensi Terlambat')
                    <li class="docs-list">
                        <div class="variable">[info_terlambat]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan informasi keterlambatan pegawai secara otomatis</div>
                    </li>
                @endif
                @if ($event === 'Absensi Keluar' || $event === 'Absensi Keluar Cepat')
                    <li class="docs-list">
                        <div class="variable">[jam_datang]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan jam datang pegawai secara otomatis</div>
                    </li>
                    <li class="docs-list">
                        <div class="variable">[tgl_datang]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan tanggal datang pegawai secara otomatis</div>
                    </li>
                @endif
                @if ($event === 'Absensi Keluar Cepat')
                    <li class="docs-list">
                        <div class="variable">[info_keluar_cepat]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan informasi keluar cepat pegawai secara otomatis</div>
                    </li>
                @endif
                @if ($event === 'Ulang Tahun')
                    <li class="docs-list">
                        <div class="variable">[umur]</div>
                        <div class="variable-desc">Format tag agar dapat diisi dengan umur pegawai secara otomatis</div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

@endsection