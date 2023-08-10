<?php

/**
 * Dear Maintainer
 * 
 * When I wrote this code
 * Only God and I know what it was
 * Now, only God know what it was :)
 * 
 * Stay Tawakal and Keep Ikhtiar
 * May god give you clue about it
 * 
 * Recent Maintainer :
 * SMKN 1 Bondowoso 2022/2023 Students
**/

use App\Http\Controllers\Autonotifs;
use App\Http\Controllers\DashboardSettings;
use App\Http\Controllers\Import_Export_Controller;
use App\Http\Controllers\Jadwals;
use App\Http\Controllers\PerformaGraphic;
use App\Http\Controllers\Perusahaans;
use App\Http\Controllers\Preview;
use App\Http\Controllers\Users;
use App\Models\Autonotif;
use App\Models\AutonotifTemplate;
use App\Models\ChangeLog;
use App\Models\IzinPresensi;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main User Manager View

Route::get('/', function() {
    return view('index');
});

Route::get('/PwKLOi', function() {
    return view('account.PwKLOi');
});

Route::get('/login', function() {
    // $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
    // $parsedLibur = $liburNasional->json();
    // $is_now_active = true;

    // $liburNotif = false;
    // $liburName = 'Selamat Bekerja';

    // foreach ($parsedLibur as $libur) {
    //     if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
    //         $is_now_active = false;
    //         $liburNotif = true;
    //         $liburName = $libur['holiday_name'];
    //     };
    // };

    // if($is_now_active === true) {
    //     $pegawais = Pegawai::get();
    //     foreach ($pegawais as $pegawai) {
    //         $libur_depar = false;

    //         if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
    //             foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
    //                 if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
    //                     $libur_depar = true;
    //                     $liburNotif = true;
    //                     $liburName = $liburDepar->nama_libur;
    //                 };
    //             };
    //         };
            
    //         if($libur_depar === false) {
    //             $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
    //             if($check_izin === 0) {
    //                 $liburNotif = false;
    //                 $liburName = 'Selamat Bekerja';
    //                 foreach ($pegawai->jabatan->jadwal->details as $detail) {
    //                     if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
    //                         $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

    //                         $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();    

    //                         if($check_presensi === 0) {
    //                             $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
    //                             $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
    //                             $new_presensi['pegawai_id'] = $pegawai->id;
    //                             $new_presensi['keterangan'] = 'Belum Check Log';
    //                             $new_presensi['created_at'] = $start_time;
    //                             Presensi::create($new_presensi);
    //                         };
    //                     };
    //                 };
    //             } else {
    //                 Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
    //             };
    //         };
    //     };
    // };

    return view('account.index');
})->middleware('guest')->name('login');





// Main User Manager Logic

Route::post('/PwKLOi', [Users::class, 'superRegist']);

Route::post('/login', [Users::class, 'login'])->middleware('guest');

Route::get('/logout', [Users::class, 'logout']);





// Wizard

Route::get('/wizard', function() {
    return view('regist.index');
})->middleware('newClient');





// Dashboard

Route::middleware('auth')->group(function() {
    Route::middleware('superAdmin')->group(function() {
        Route::get('/superDashboard', function() {
            // $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
            // $parsedLibur = $liburNasional->json();
            // $is_now_active = true;
    
            // foreach ($parsedLibur as $libur) {
            //     if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
            //         $is_now_active = false;
            //         $liburNotif = true;
            //         $liburName = $libur['holiday_name'];
            //     };
            // };
    
            // if($is_now_active === true) {
            //     $pegawais = Pegawai::get();
            //     foreach ($pegawais as $pegawai) {
            //         $libur_depar = false;
    
            //         if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
            //             foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
            //                 if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
            //                     $libur_depar = true;
            //                     $liburNotif = true;
            //                     $liburName = $liburDepar->nama_libur;
            //                 };
            //             };
            //         };
                    
            //         if($libur_depar === false) {
            //             $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
            //             if($check_izin === 0) {
            //                 $liburNotif = false;
            //                 $liburName = 'Selamat Bekerja';
            //                 foreach ($pegawai->jabatan->jadwal->details as $detail) {
            //                     if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
            //                         $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';
    
            //                         $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();    
    
            //                         if($check_presensi === 0) {
            //                             $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
            //                         $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
            //                             $new_presensi['pegawai_id'] = $pegawai->id;
            //                             $new_presensi['keterangan'] = 'Belum Check Log';
            //                             $new_presensi['created_at'] = $start_time;
            //                             Presensi::create($new_presensi);
            //                         };
            //                     };
            //                 };
            //             } else {
            //                 Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
            //             };
            //         };
            //     };
            // };

            return view('admin.developer.index', [
                'parentPage' => 'dashboard',
                'page' => 'Dashboard',
                'pageDesc' => 'Laman Dashboard ini menampilkan data pengguna aplikasi Daftar Hadir'
            ]);
        });
    });

    Route::post('/autonotif-test', [Autonotifs::class, 'test']);

    Route::get('/dashboard', function () {
        // $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        // $parsedLibur = $liburNasional->json();
        // $is_now_active = true;

        // foreach ($parsedLibur as $libur) {
        //     if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
        //         $is_now_active = false;
        //         $liburNotif = true;
        //         $liburName = $libur['holiday_name'];
        //     };
        // };

        // if($is_now_active === true) {
        //     $pegawais = Pegawai::get();
        //     foreach ($pegawais as $pegawai) {
        //         $libur_depar = false;

        //         if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
        //             foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
        //                 if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
        //                     $libur_depar = true;
        //                     $liburNotif = true;
        //                     $liburName = $liburDepar->nama_libur;
        //                 };
        //             };
        //         };
                
        //         if($libur_depar === false) {
        //             $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
        //             if($check_izin === 0) {
        //                 $liburNotif = false;
        //                 $liburName = 'Selamat Bekerja';
        //                 foreach ($pegawai->jabatan->jadwal->details as $detail) {
        //                     if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
        //                         $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

        //                         $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();    

        //                         if($check_presensi === 0) {
        //                             $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
        //                         $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
        //                             $new_presensi['pegawai_id'] = $pegawai->id;
        //                             $new_presensi['keterangan'] = 'Belum Check Log';
        //                             $new_presensi['created_at'] = $start_time;
        //                             Presensi::create($new_presensi);
        //                         };
        //                     };
        //                 };
        //             } else {
        //                 Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
        //             };
        //         };
        //     };
        // };

        return view('admin.dashboard.index', [
            'parentPage' => 'dashboard',
            'page' => 'Dashboard',
            'pageDesc' => 'Laman Dashboard ini menampilkan statistic rekap data harian'
        ]);
    });

    Route::get('/dashboard/presensi', function () {
        // $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        // $parsedLibur = $liburNasional->json();
        // $is_now_active = true;

        // foreach ($parsedLibur as $libur) {
        //     if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
        //         $is_now_active = false;
        //         $liburNotif = true;
        //         $liburName = $libur['holiday_name'];
        //     };
        // };

        // if($is_now_active === true) {
        //     $pegawais = Pegawai::get();
        //     foreach ($pegawais as $pegawai) {
        //         $libur_depar = false;

        //         if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
        //             foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
        //                 if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
        //                     $libur_depar = true;
        //                     $liburNotif = true;
        //                     $liburName = $liburDepar->nama_libur;
        //                 };
        //             };
        //         };
                
        //         if($libur_depar === false) {
        //             $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
        //             if($check_izin === 0) {
        //                 $liburNotif = false;
        //                 $liburName = 'Selamat Bekerja';
        //                 foreach ($pegawai->jabatan->jadwal->details as $detail) {
        //                     if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
        //                         $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

        //                         $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();    

        //                         if($check_presensi === 0) {
        //                             $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
        //                         $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
        //                             $new_presensi['pegawai_id'] = $pegawai->id;
        //                             $new_presensi['keterangan'] = 'Belum Check Log';
        //                             $new_presensi['created_at'] = $start_time;
        //                             Presensi::create($new_presensi);
        //                         };
        //                     };
        //                 };
        //             } else {
        //                 Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
        //             };
        //         };
        //     };
        // };

        return view('admin.dashboard.presensi', [
            'parentPage' => 'dashboard',
            'page' => 'Presensi Harian',
            'pageDesc' => 'Laman Presensi ini menampilkan rekap presensi di hari ini'
        ]);
    });

    Route::get('/dashboard/izin', function () {
        // $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        // $parsedLibur = $liburNasional->json();
        // $is_now_active = true;

        // foreach ($parsedLibur as $libur) {
        //     if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
        //         $is_now_active = false;
        //         $liburNotif = true;
        //         $liburName = $libur['holiday_name'];
        //     };
        // };

        // if($is_now_active === true) {
        //     $pegawais = Pegawai::get();
        //     foreach ($pegawais as $pegawai) {
        //         $libur_depar = false;

        //         if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
        //             foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
        //                 if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
        //                     $libur_depar = true;
        //                     $liburNotif = true;
        //                     $liburName = $liburDepar->nama_libur;
        //                 };
        //             };
        //         };
                
        //         if($libur_depar === false) {
        //             $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
        //             if($check_izin === 0) {
        //                 $liburNotif = false;
        //                 $liburName = 'Selamat Bekerja';
        //                 foreach ($pegawai->jabatan->jadwal->details as $detail) {
        //                     if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
        //                         $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

        //                         $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();   

        //                         if($check_presensi === 0) {
        //                             $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
        //                         $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
        //                             $new_presensi['pegawai_id'] = $pegawai->id;
        //                             $new_presensi['keterangan'] = 'Belum Check Log';
        //                             $new_presensi['created_at'] = $start_time;
        //                             Presensi::create($new_presensi);
        //                         };
        //                     };
        //                 };
        //             } else {
        //                 Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
        //             };
        //         };
        //     };
        // };

        return view('admin.dashboard.izin', [
            'parentPage' => 'dashboard',
            'page' => 'Izin Harian',
            'pageDesc' => 'Laman Izin ini menampilkan rekap izin di hari ini'
        ]);
    });    

    Route::get('/dashboard/aktivitas', function () {
        return view('admin.dashboard.aktivitas', [
            'parentPage' => 'dashboard',
            'page' => 'Aktivitas Harian',
            'pageDesc' => 'Laman Aktivitas ini menampilkan rekap aktivitas di hari ini'
        ]);
    });

    Route::get('/dashboard/lembur', function () {
        return view('admin.dashboard.lembur', [
            'parentPage' => 'dashboard',
            'page' => 'Lembur Harian',
            'pageDesc' => 'Laman Lembur ini menampilkan rekap lembur di hari ini'
        ]);
    });

    Route::get('/dashboard/chat-pegawai', function () {
        return view('admin.dashboard.chat-pegawai', [
            'parentPage' => 'dashboard',
            'page' => 'Chat Pegawai',
            'pageDesc' => 'Laman Chat Pegawai ini menampilkan semua chat dari pegawai'
        ]);
    });

    Route::get('/dashboard/preview/{data}/{departemen}/{subData}/{subDataVal}', [Preview::class, 'index']);

    Route::get('/dashboard/master/pegawai', function () {
        // $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        // $parsedLibur = $liburNasional->json();
        // $is_now_active = true;

        // foreach ($parsedLibur as $libur) {
        //     if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
        //         $is_now_active = false;
        //         $liburNotif = true;
        //         $liburName = $libur['holiday_name'];
        //     };
        // };

        // if($is_now_active === true) {
        //     $pegawais = Pegawai::get();
        //     foreach ($pegawais as $pegawai) {
        //         $libur_depar = false;

        //         if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
        //             foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
        //                 if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
        //                     $libur_depar = true;
        //                     $liburNotif = true;
        //                     $liburName = $liburDepar->nama_libur;
        //                 };
        //             };
        //         };
                
        //         if($libur_depar === false) {
        //             $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
        //             if($check_izin === 0) {
        //                 $liburNotif = false;
        //                 $liburName = 'Selamat Bekerja';
        //                 foreach ($pegawai->jabatan->jadwal->details as $detail) {
        //                     if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
        //                         $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

        //                         $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();   

        //                         if($check_presensi === 0) {
        //                             $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
        //                         $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
        //                             $new_presensi['pegawai_id'] = $pegawai->id;
        //                             $new_presensi['keterangan'] = 'Belum Check Log';
        //                             $new_presensi['created_at'] = $start_time;
        //                             Presensi::create($new_presensi);
        //                         };
        //                     };
        //                 };
        //             } else {
        //                 Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
        //             };
        //         };
        //     };
        // };

        return view('admin.masterData.pegawai', [
            'parentPage' => 'master',
            'page' => 'Data Pegawai',
            'pageDesc' => 'Laman Data Pegawai ini menampilkan semua data dari setiap pegawai'
        ]);
    });

    Route::get('/dashboard/master/pegawai/import', [Import_Export_Controller::class, 'index']);

    Route::post('/dashboard/master/pegawai/import', [Import_Export_Controller::class, 'import']);

    Route::get('/dashboard/master/jabatan', function () {
        return view('admin.masterData.jabatan', [
            'parentPage' => 'master',
            'page' => 'Data Jabatan',
            'pageDesc' => 'Laman Data Jabatan ini menampilkan semua data dari setiap jabatan'
        ]);
    });

    Route::get('/dashboard/master/jadwal-non-shift', function () {
        return view('admin.masterData.jadwal-non-shift', [
            'parentPage' => 'master',
            'page' => 'Data Jadwal',
            'pageDesc' => 'Laman Jadwal ini menampilkan semua data dari Jadwal Non Shift',
            'departemens' => Auth::user()->instansi->departemens
        ]);
    });

    Route::get('/dashboard/master/jadwal-shift', function () {
        return view('admin.masterData.jadwal-shift', [
            'parentPage' => 'master',
            'page' => 'Data Jadwal Shift',
            'pageDesc' => 'Laman Jadwal ini menampilkan semua data dari Jadwal Shift',
            'departemens' => Auth::user()->instansi->departemens
        ]);
    });
    
    Route::get('/dashboard/master/libur-khusus', function () {
        return view('admin.masterData.libur-khusus', [
            'parentPage' => 'master',
            'page' => 'Libur Khusus',
            'pageDesc' => 'Laman Libur ini menampilkan semua data dari Jadwal Libur Khusus'
        ]);
    });

    Route::get('/dashboard/laporan/presensi', function () {
        return view('admin.laporan.presensi', [
            'parentPage' => 'laporan',
            'page' => 'Presensi Karyawan',
            'pageDesc' => 'Laman Presensi ini menampilkan rekap presensi kehadiran pegawai dalam 1 Bulan'
        ]);
    });

    Route::get('/dashboard/laporan/aktivitas', function () {
        return view('admin.laporan.aktivitas', [
            'parentPage' => 'laporan',
            'page' => 'Aktivitas Karyawan',
            'pageDesc' => 'Laman Aktivitas ini menampilkan rekap aktivitas pegawai dalam 1 Bulan'
        ]);
    });

    Route::get('/dashboard/laporan/performa', function () {
        return view('admin.laporan.performa', [
            'parentPage' => 'laporan',
            'page' => 'Performa Karyawan',
            'pageDesc' => 'Laman Performa ini menampilkan rekap performa kehadiran pegawai dalam 1 Bulan'
        ]);
    });

    Route::get('/dashboard/laporan/grafis-performa/{status}/{month}/{depar}', [PerformaGraphic::class, 'index']);

    Route::get('/dashboard/laporan/change-log', function () {
        return view('admin.laporan.change-log', [
            'parentPage' => 'laporan',
            'page' => 'Change Log',
            'pageDesc' => 'Laman Change Log ini menampilkan semua perubahan yang dilakukan admin',
            'changeLogs' => ChangeLog::latest()->get()
        ]);
    });

    Route::post('/dashboard/pengumuman/autonotif', [Autonotifs::class, 'user']);

    Route::get('/dashboard/pengumuman/notifikasi/{event}', function ($event) {
        switch($event) {
            case 'daftar_pegawai':
                $usedEvent = 'Pendaftaran Pegawai';
                break;
            case 'absensi_masuk':
                $usedEvent = 'Absensi Masuk';
                break;
            case 'absensi_keluar':
                $usedEvent = 'Absensi Keluar';
                break;
            case 'absensi_terlambat':
                $usedEvent = 'Absensi Terlambat';
                break;
            case 'absensi_keluar_cepat':
                $usedEvent = 'Absensi Keluar Cepat';
                break;
            case 'alpha':
                $usedEvent = 'Alpha';
                break;
            case 'masuk_reminder':
                $usedEvent = 'Pengingat Masuk';
                break;
            case 'keluar_reminder':
                $usedEvent = 'Pengingat Keluar';
                break;
            case 'ulang_tahun':
                $usedEvent = 'Ulang Tahun';
                break;
            case 'libur':
                $usedEvent = 'Libur';
                break;
            default :
                $usedEvent = 'Pendaftaran Pegawai';
                break;
        }

        $templates = AutonotifTemplate::where('event', $usedEvent)->get();

        return view('admin.pengumuman.notifikasiTabel', [
            'parentPage' => 'pengumuman',
            'page' => 'Notifikasi WA',
            'pageDesc' => 'Laman Notifikasi WA ini berisi konfigurasi akun dan pesan ke Whatsapp Gateway',
            'event' => $usedEvent,
            'departemens' => Auth::user()->instansi->departemens,
            'templates' => $templates
        ]);
    });

    Route::post('/add-chat-template', [Autonotifs::class, 'addTemplate']);

    Route::get('/dashboard/setting', function () {
        return view('admin.setting');
    });

    Route::post('/dashboard/setting', [DashboardSettings::class, 'ui']);

    Route::post('/dashboard/master/req-jadwal', [Jadwals::class, 'reqNew']);
    Route::post('/dashboard/master/reqChange-jadwal/{id}', [Jadwals::class, 'reqChange']);
    Route::post('/dashboard/master/reqDestroy-jadwal/{id}', [Jadwals::class, 'reqDestroy']);

    Route::get('/dashboard/perusahaan', function() {
        return view('admin.perusahaan', [
            'parentPage' => 'perusahaan',
            'page' => 'Perusahaan',
            'pageDesc' => 'Laman profil dan pengaturan perusahaan anda',
            'data' => Auth::user()->instansi
        ]);
    });

    Route::post('/dashboard/perusahaan/logo', [Perusahaans::class, 'logo']);

    Route::middleware('highOfficer')->group(function() {
        Route::get('/dashboard/master/departemen', function () {
            return view('admin.masterData.departemen', [
                'parentPage' => 'master',
                'page' => 'Data Departemen',
                'pageDesc' => 'Laman Data Departemen ini menampilkan semua data dari setiap departemen'
            ]);
        });

        Route::get('/dashboard/master/izin', function () {
            return view('admin.masterData.izin', [
                'parentPage' => 'master',
                'page' => 'Data Izin',
                'pageDesc' => 'Laman Data Izin ini menampilkan semua data dari setiap izin'
            ]);
        });

        Route::get('/dashboard/master/libur-nasional', function () {
            $data = Http::get('https://api-harilibur.vercel.app/api');
            $parseJson = $data->json();
    
            return view('admin.masterData.libur-nasional', [
                'parentPage' => 'master',
                'page' => 'Libur Nasional',
                'pageDesc' => 'Laman Libur ini menampilkan semua data dari Jadwal Libur Nasional',
                'liburNasional' => $parseJson
            ]);
        });

        Route::get('/dashboard/master/admin', function () {
            return view('admin.masterData.admin', [
                'parentPage' => 'master',
                'page' => 'Data Admin',
                'pageDesc' => 'Laman Data Admin ini menampilkan semua data dari setiap admin'
            ]);
        });
    });

    Route::middleware('observer')->group(function() {   
        Route::get('/dashboard/pengajuan-perubahan/presensi', function() {
            return view('admin.pengajuan.req-presensi', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Presensi',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan presensi manual'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/izin-presensi', function() {
            return view('admin.pengajuan.req-izin-presensi', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Izin',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan izin manual'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/aktivitas-pegawai', function() {
            return view('admin.pengajuan.req-aktivitas-pegawai', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Aktivitas',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan aktivitas pegawai'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/lembur', function() {
            return view('admin.pengajuan.req-lembur', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Lembur',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan lembur pegawai'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/data-departemen', function() {
            return view('admin.pengajuan.req-departemen', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Departemen',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data departemen'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/data-jabatan', function() {
            return view('admin.pengajuan.req-jabatan', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Jabatan',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data jabatan'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/data-pegawai', function() {
            return view('admin.pengajuan.req-pegawai', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Pegawai',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data pegawai'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/data-admin', function() {
            return view('admin.pengajuan.req-admin', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Admin',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data admin'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/data-aktivitas', function() {
            return view('admin.pengajuan.req-aktivitas', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Aktivitas',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data aktivitas'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/jadwal', function() {
            return view('admin.pengajuan.jadwal', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Jadwal',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data jadwal'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/libur-nasional', function() {
            return view('admin.pengajuan.libur-nasional', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Libur Nasional',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data libur nasional'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/libur-khusus', function() {
            return view('admin.pengajuan.libur-khusus', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Libur Khusus',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data libur khusus'
            ]);
        });

        Route::get('/dashboard/pengajuan-perubahan/izin', function() {
            return view('admin.pengajuan.req-izin', [
                'parentPage' => 'approval',
                'page' => 'Pengajuan Jenis Izin',
                'pageDesc' => 'Laman Pengajuan ini menampilkan semua pengajuan perubahan data Jenis Izin'
            ]);
        });
    });

    Route::middleware('manager')->group(function() {
        Route::get('/dashboard/master/aktivitas', function () {
            return view('admin.masterData.aktivitas', [
                'parentPage' => 'master',
                'page' => 'Data Aktivitas',
                'pageDesc' => 'Laman Data Aktivitas ini menampilkan semua data dari setiap aktivitas'
            ]);
        });

        Route::get('/dashboard/laporan/approval', function () {
            return view('admin.laporan.approval', [
                'parentPage' => 'laporan',
                'page' => 'Approval Status',
                'pageDesc' => 'Menampilkan keseluruhan riwayat dan status pengajuan oleh pengelola',
                'reqDepartemens' => Auth::user()->reqDepartemens,
                'reqJadwals' => Auth::user()->reqJadwal,
                'reqJabatans' => Auth::user()->reqJabatan,
                'reqPegawais' => Auth::user()->reqPegawai
            ]);
        });    
    });

    Route::middleware('highManager')->group(function() {
        Route::get('/dashboard/device', function() {
            return view('admin.device', [
                'devices' => DB::select('select * from iclock'),
                'parentPage' => 'device',
                'page' => 'Perangkat Presensi',
                'pageDesc' => 'Laman Perangkat ini menampilkan data perangkat presensi yang digunakan'
            ]);
        });
    });
});