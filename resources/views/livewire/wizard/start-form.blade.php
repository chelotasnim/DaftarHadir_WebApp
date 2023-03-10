<div class="container">
    <div class="content-wrapper">
        <div class="slide wizard-cover">
            <div class="cover-title">
                <span class="step">Step 1</span>
                <p class="title">Hi! {{ $user->name }}.</p>
                <p class="desc">
                    Terima kasih telah memberikan kami kepercayaan dalam pengelolaan sistem informasi presensi di tempat anda.
                    Mulai atur sistem ini agar dapat meningkatkan pengalaman anda terhadap layanan kami, dengan fitur dan konten yang relevan.
                </p>
            </div>
            <div class="cover-image">
                <img src="{{ asset('assets/wizard-cover.png') }}" draggable="false"/>
            </div>
        </div>
        <div class="slide wizard-place">
            <div class="cover-title">
                <span class="step">Step 2</span>
                <p class="title">Dimana aplikasi ini akan digunakan?</p>
                <p class="desc">
                    Sesuaikan tempat yang akan anda integrasikan dengan sistem informasi presensi ini.
                    <br>
                    Ini akan berpengaruh besar dengan fitur terkait
                </p>
            </div>
            <div class="wizard-option">
                <div id="sekolah" class="wizard-box select-type">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <p>Sekolah</p>
                    <input class="radio-input for-type" type="radio" wire:model.defer="type" name="type_instansi" value="Sekolah">
                </div>
                <div id="perusahaan" class="wizard-box select-type">
                    <i class="fa-solid fa-user-tie"></i>
                    <p>Perusahaan</p>
                    <input class="radio-input for-type" type="radio" wire:model.defer="type" name="type_instansi" value="Perusahaan">
                </div>
            </div>
        </div>
        <div class="slide wizard-place">
            <div class="cover-title">
                <span class="step">Step 3</span>
                <p class="title">Berapa hari <span class="type-act">Kerja</span> dalam 1 minggu?</p>
                <p class="desc">
                    Sesuaikan opsi dengan hari <span class="type-act">Kerja</span> yang dominan pada setiap jabatan di <span class="type">perusahaan</span> anda.
                    <br>
                    Ini akan mendukung optimasi fitur jadwal <span class="type-act">kerja</span>
                </p>
            </div>
            <div class="wizard-option">
                <div class="wizard-box select-schedul" style="gap: 12px;">
                    <i class="fa-solid fa-calendar-week"></i>
                    <p>5 Hari <span class="type-act">Kerja</span></p>
                    <input class="radio-input for-hari" type="radio" wire:model.defer="hari_kerja" name="hari_kerja" value="5 Hari Kerja">
                </div>
                <div class="wizard-box select-schedul" style="gap: 12px;">
                    <i class="fa-solid fa-calendar-week"></i>
                    <p>6 Hari <span class="type-act">Kerja</span></p>
                    <input class="radio-input for-hari" type="radio" wire:model.defer="hari_kerja" name="hari_kerja" value="6 Hari Kerja">
                </div>
            </div>
        </div>
        <div class="slide wizard-place">
            <div class="cover-title">
                <span class="step">Step 4</span>
                <p class="title">Sesuaikan jenis jadwal <span class="type-act">Kerja</span>.</p>
                <p class="desc">
                    Sesuaikan jenis jadwal <span class="type-act">Kerja</span> di <span class="type">perusahaan</span> anda untuk memaksimalkan fitur jadwal <span class="type-act">Kerja</span>
                    <br>
                    Sekolah hanya memiliki pilihan jadwal <span class="type-act">Kerja</span> non-shift
                </p>
            </div>
            <div class="wizard-option">
                <div class="wizard-box select-schedul-type" style="gap: 12px;">
                    <i class="fa-solid fa-user-clock"></i>
                    <p>Non Shift</p>
                    <input class="radio-input for-jadwal" type="radio" wire:model.defer="type_jadwal" name="type_jadwal" value="Non Shift">
                </div>
                <div class="wizard-box select-schedul-type not-for-school" style="gap: 12px;">
                    <i class="fa-solid fa-user-clock"></i>
                    <p>Shift</p>
                    <input class="radio-input for-jadwal" type="radio" wire:model.defer="type_jadwal" name="type_jadwal" value="Shift">
                </div>
                <div class="wizard-box select-schedul-type not-for-school" style="gap: 12px;">
                    <i class="fa-solid fa-user-clock"></i>
                    <p>Semua</p>
                    <input class="radio-input for-jadwal" type="radio" wire:model.defer="type_jadwal" name="type_jadwal" value="Semua">
                </div>
            </div>
        </div>
        <div class="slide wizard-place">
            <div class="cover-title">
                <span class="step">Step 5</span>
                <p class="title">Lengkapi data <span class="type">perusahaan</span> mu!</p>
                <p class="desc">
                    Isi sedikit data identitas <span class="type">perusahaan</span> mu yang dibutuhkan dengan lengkap
                </p>
            </div>
            <div class="wizard-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="agencyName">Nama <span class="type">Perusahaan</span></label>
                        <input id="agencyName" type="text" wire:model.defer="nama_instansi" autocomplete="off" maxlength="50">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="desc">Deskripsi <span class="type">Perusahaan</span></label>
                        <textarea id="desc" wire:model.defer="deskripsi_instansi" maxlength="255"></textarea>
                    </div>
                    <div class="form-field">
                        <label for="address">Alamat <span class="type">Perusahaan</span></label>
                        <textarea id="address" wire:model.defer="alamat_instansi" maxlength="100"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="kontak">Kontak <span class="type">Perusahaan</span></label>
                        <input id="kontak" type="number" wire:model.defer="kontak_instansi" autocomplete="off">
                    </div>
                    <div class="form-field">
                        <label for="website">Website <span class="type">Perusahaan</span></label>
                        <input id="website" type="text" wire:model.defer="website_instansi" autocomplete="off">
                    </div>
                </div>
                <div class="form-row rule-switch">
                    <div class="smart-wages">
                        <div class="wages-switch">
                            <div class="switch-toggle"></div>
                            <input class="toggle-input" type="checkbox" wire:model.defer="smart_wages" name="smart_wages" value="Aktif">
                        </div>
                        <p>Aktifkan fitur Smart Wages</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide wizard-place">
            <div class="cover-title">
                <span class="step">Step 6</span>
                <p class="title">Buat akun pengelola <span class="type">perusahaan</span> mu!</p>
                <p class="desc">
                    Ini akan membuat akun pengelola utama dari <span class="type">Perusahaan</span> mu!
                </p>
            </div>
            <div class="wizard-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="managerName">Nama Pengelola</label>
                        <input id="managerName" type="text" wire:model.defer="name" autocomplete="off">
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        <input id="password" type="password" wire:model.defer="password" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="btn prev">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali</span>
        </div>
        <div class="btn next available">
            <span>Berikutnya</span>
            <i class="fa-solid fa-arrow-right-long"></i>
        </div>
        <button wire:click="create" class="send-btn">
            <span>Mulai</span>
            <i class="fa-solid fa-arrow-right-long"></i>
        </button>
        <a class="cancel" href="/logout">Batalkan, nanti saja</a>
    </footer>
    @if ($stabilizer == true)
        <span class="send-or-not"></span>
    @endif
    @error('nama_instansi')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('deskripsi_instansi')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('alamat_instansi')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('kontak_instansi')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('type')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('hari_kerja')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('type_jadwal')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('smart_wages')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('name')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
    @error('password')
    <div class="notif new">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $message }}
    </div>
    @enderror
</div>