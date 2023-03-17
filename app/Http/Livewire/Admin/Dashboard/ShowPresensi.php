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

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\IzinPresensi;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowPresensi extends Component
{
    public function render()
    {
        $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        $parsedLibur = $liburNasional->json();
        $is_now_active = true;

        foreach ($parsedLibur as $libur) {
            if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
                $is_now_active = false;
                $liburNotif = true;
                $liburName = $libur['holiday_name'];
            };
        };

        if($is_now_active === true) {
            $pegawais = Pegawai::get();
            foreach ($pegawais as $pegawai) {
                $libur_depar = false;

                if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
                    foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
                        if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
                            $libur_depar = true;
                            $liburNotif = true;
                            $liburName = $liburDepar->nama_libur;
                        };
                    };
                };
                
                if($libur_depar === false) {
                    $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
                    if($check_izin === 0) {
                        $liburNotif = false;
                        $liburName = 'Selamat Bekerja';
                        foreach ($pegawai->jabatan->jadwal->details as $detail) {
                            if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
                                $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

                                $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();   

                                if($check_presensi === 0) {
                                    $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
                                    $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
                                    $new_presensi['pegawai_id'] = $pegawai->id;
                                    $new_presensi['keterangan'] = 'Belum Check Log';
                                    $new_presensi['created_at'] = $start_time;
                                    Presensi::create($new_presensi);
                                };
                            };
                        };
                    } else {
                        Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
                    };
                };
            };
        };

        if(empty(Auth::user()->departemen_id)) {
            $presensis = Presensi::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        } else {
            $presensis = Presensi::where('departemen_id', Auth::user()->departemen_id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        };
        
        return view('livewire.admin.dashboard.show-presensi', [
            'presensis' => $presensis
        ]);
    }
}
