<?php

namespace Database\Seeders;

use App\Models\DashboardSetting;
use App\Models\Departemen;
use App\Models\Instansi;
use App\Models\Jabatan;
use App\Models\Jadwal_detail;
use App\Models\jadwal_kerja;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        Instansi::create([
            'nama_instansi' => 'Situbondo Fresh Fish',
            'deskripsi_instansi' => 'Perusahaan dalam bidang konservasi ekosistem kelautan sekaligun badan perdagangan dan pengawasan Ikan segar di Situbondo, Jawa Timur',
            'alamat_instansi' => 'Jl. Bondowoso, Situbondo, Jawa Timur',
            'kontak_instansi' => '089610988762',
            'website_instansi' => 'yuvicorp.com',
            'type' => 'Perusahaan',
            'hari_kerja' => '5 Hari Kerja',
            'type_jadwal' => 'Semua',
            'smart_wages' => 'Aktif'
        ]);

        User::create([
            'name' => 'Super Admin',
            'username' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123456789'),
            'peran' => 'Super Admin',
            'status' => 'Aktif'
        ]);

        User::create([
            'perusahaan_id' => 1,
            'name' => 'Yuvi Corp',
            'username' => 'yuvicorp',
            'email' => 'uv@gmail.com',
            'password' => Hash::make('123456789'),
            'peran' => 'Atasan Utama',
            'status' => 'Aktif'
        ]);

        User::create([
            'perusahaan_id' => 1,
            'name' => 'STB MANAGER - 01',
            'username' => 'manager01',
            'email' => 'manager01@gmail.com',
            'password' => Hash::make('123456789'),
            'peran' => 'Pengelola Utama',
            'status' => 'Aktif'
        ]);

        Departemen::create([
            'perusahaan_id' => 1,
            'nama_dept' => 'Management A1',
            'atasan1' => 'Yuviar Nuzul',
            'telp_1' => '089276578723',
            'atasan2' => 'Rizky Gufron',
            'telp_2' => '085234567109',
            'status' => 'Aktif'
        ]);

        Departemen::create([
            'perusahaan_id' => 1,
            'nama_dept' => 'Marketing A1',
            'atasan1' => 'Amrozi Dullian',
            'telp_1' => '086522781625',
            'atasan2' => 'Julius Matius',
            'telp_2' => '081244617298',
            'status' => 'Aktif'
        ]);

        jadwal_kerja::create([
            'departemen_id' => 1,
            'nama_jadwal' => 'Schedul A1',
            'keterangan_jadwal' => 'Jadwal Umum Pejabat Management A1',
            'type' => 'Non Shift',
            'status' => 'Aktif'
        ]);

        jadwal_kerja::create([
            'departemen_id' => 2,
            'nama_jadwal' => 'Marketing Utama',
            'keterangan_jadwal' => 'Jadwal Umum Pejabat Marketing A1',
            'type' => 'Non Shift',
            'status' => 'Aktif'
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Masuk',
            'hari' => 'Senin',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Pulang',
            'hari' => 'Senin',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Masuk',
            'hari' => 'Selasa',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Pulang',
            'hari' => 'Selasa',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Masuk',
            'hari' => 'Rabu',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Pulang',
            'hari' => 'Rabu',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Masuk',
            'hari' => 'Kamis',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Pulang',
            'hari' => 'Kamis',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Masuk',
            'hari' => 'Jumat',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '07:00', 
            'log_tolerance' => '07:15',
            'log_range' => '11:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Shalat Jumat',
            'hari' => 'Jumat',
            'log_type' => 'Keluar',
            'log_time' => '11:00',
            'log_limit' => '11:00', 
            'log_tolerance' => '11:00',
            'log_range' => '12:30', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Selesai Shalat',
            'hari' => 'Jumat',
            'log_type' => 'Masuk',
            'log_time' => '12:30',
            'log_limit' => '13:00',
            'log_tolerance' => '13:15', 
            'log_range' => '13:30', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 1,
            'log_name' => 'Jam Pulang',
            'hari' => 'Jumat',
            'log_type' => 'Keluar',
            'log_time' => '13:30',
            'log_limit' => '16:00', 
            'log_tolerance' => '15:45',
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Masuk',
            'hari' => 'Senin',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Pulang',
            'hari' => 'Senin',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Masuk',
            'hari' => 'Selasa',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Pulang',
            'hari' => 'Selasa',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Masuk',
            'hari' => 'Rabu',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Pulang',
            'hari' => 'Rabu',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Masuk',
            'hari' => 'Kamis',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '08:50', 
            'log_tolerance' => '09:00',
            'log_range' => '12:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Pulang',
            'hari' => 'Kamis',
            'log_type' => 'Keluar',
            'log_time' => '12:00',
            'log_limit' => '16:00',
            'log_tolerance' => '15:45', 
            'log_range' => '18:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Masuk',
            'hari' => 'Jumat',
            'log_type' => 'Masuk',
            'log_time' => '06:00',
            'log_limit' => '07:00', 
            'log_tolerance' => '07:15',
            'log_range' => '11:00', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Shalat Jumat',
            'hari' => 'Jumat',
            'log_type' => 'Keluar',
            'log_time' => '11:00',
            'log_limit' => '11:00', 
            'log_tolerance' => '11:00',
            'log_range' => '12:30', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Selesai Shalat',
            'hari' => 'Jumat',
            'log_type' => 'Masuk',
            'log_time' => '12:30',
            'log_limit' => '13:00',
            'log_tolerance' => '13:15', 
            'log_range' => '13:30', 
        ]);

        Jadwal_detail::create([
            'jadwal_kerja_id' => 2,
            'log_name' => 'Jam Pulang',
            'hari' => 'Jumat',
            'log_type' => 'Keluar',
            'log_time' => '13:30',
            'log_limit' => '16:00', 
            'log_tolerance' => '15:45',
            'log_range' => '18:00', 
        ]);

        Jabatan::create([
            'jadwal_id' => 1,
            'jabatan' => 'Manager A1',
            'jatah_cuti_tahunan' => 24,
            'gaji' => 23000000,
            'status' => 'Aktif',
        ]);

        Jabatan::create([
            'jadwal_id' => 2,
            'jabatan' => 'Supervisor A1',
            'jatah_cuti_tahunan' => 12,
            'gaji' => 16000000,
            'status' => 'Aktif',
        ]);

        Pegawai::create([
            'jabatan_id' => 1,
            'nip' => '002070104089',
            'nama' => 'Ahmad Hamdhani',
            'email' => 'hamdhan@gmail.com',
            'tunjangan_tetap' => 12300000,
            'tunjangan_bulan_ini' => 12300000,
            'no_hp' => '086554099917',
            'no_wa' => '086554099917',
            'alamat' => 'Sawojajar, Malang',
            'tgl_lahir' => '12-03-1996',
            'jns_kel' => 'Laki-Laki',
            'status' => 'Aktif'
        ]);

        Pegawai::create([
            'jabatan_id' => 1,
            'nip' => '028000762009',
            'nama' => 'Johan Murka',
            'email' => 'jhon@gmail.com',
            'tunjangan_tetap' => 12300000,
            'tunjangan_bulan_ini' => 12300000,
            'no_hp' => '082637188890',
            'no_wa' => '082637188890',
            'alamat' => 'Sawojajar, Malang',
            'tgl_lahir' => '12-03-1996',
            'jns_kel' => 'Laki-Laki',
            'status' => 'Aktif'
        ]);

        Pegawai::create([
            'jabatan_id' => 1,
            'nip' => '002304012270',
            'nama' => 'Samsurdyani',
            'email' => 'sms@gmail.com',
            'tunjangan_tetap' => 12300000,
            'tunjangan_bulan_ini' => 12300000,
            'no_hp' => '087245198820',
            'no_wa' => '087245198820',
            'alamat' => 'Sawojajar, Malang',
            'tgl_lahir' => '12-03-1996',
            'jns_kel' => 'Laki-Laki',
            'status' => 'Aktif'
        ]);

        Pegawai::create([
            'jabatan_id' => 1,
            'nip' => '007009080720',
            'nama' => 'Wahmursid',
            'email' => 'wahmursid@gmail.com',
            'tunjangan_tetap' => 12300000,
            'tunjangan_bulan_ini' => 12300000,
            'no_hp' => '087243577789',
            'no_wa' => '087243577789',
            'alamat' => 'Sawojajar, Malang',
            'tgl_lahir' => '12-03-1996',
            'jns_kel' => 'Laki-Laki',
            'status' => 'Aktif'
        ]);

        Pegawai::create([
            'jabatan_id' => 1,
            'nip' => '002700910108',
            'nama' => 'Andika Jalimen',
            'email' => 'jlmen@gmail.com',
            'tunjangan_tetap' => 12300000,
            'tunjangan_bulan_ini' => 12300000,
            'no_hp' => '082210109927',
            'no_wa' => '082210109927',
            'alamat' => 'Sawojajar, Malang',
            'tgl_lahir' => '12-03-1996',
            'jns_kel' => 'Laki-Laki',
            'status' => 'Aktif'
        ]);

        Pegawai::create([
            'jabatan_id' => 2,
            'nip' => '092001002010',
            'nama' => 'Huston Ahmdin',
            'email' => 'huston@gmail.com',
            'tunjangan_tetap' => 8300000,
            'tunjangan_bulan_ini' => 8300000,
            'no_hp' => '082566789101',
            'no_wa' => '082566789101',
            'alamat' => 'Sawojajar, Malang',
            'tgl_lahir' => '12-03-1986',
            'jns_kel' => 'Laki-Laki',
            'status' => 'Aktif'
        ]);

        DashboardSetting::create([
            'user_id' => 1,
            'quick_setting' => 'HighBlob',
            'theme' => 'blue-page',
            'blob' => true,
            'shadow' => true,
            'filter' => true,
            'transition' => true,
        ]);

        DashboardSetting::create([
            'user_id' => 2,
            'quick_setting' => 'HighBlob',
            'theme' => 'blue-page',
            'blob' => true,
            'shadow' => true,
            'filter' => true,
            'transition' => true,
        ]);
    }
}
