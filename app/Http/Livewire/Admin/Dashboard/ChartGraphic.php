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

use App\Models\LiburKhusus;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChartGraphic extends Component
{
    public function render()
    {
        $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        $parsedLibur = $liburNasional->json();
        $pegawai_ids = [];

        if(empty(Auth::user()->departemen_id)) {
            foreach(Auth::user()->instansi->departemens as $depar) {
                foreach($depar->jadwals as $jadwal) {
                    foreach($jadwal->jabatans as $jabatan) {
                        foreach($jabatan->pegawais as $pegawai) {
                            array_push($pegawai_ids, $pegawai->id);
                        };
                    };
                };
            };
        } else {
            foreach(Auth::user()->instansi->departemens as $depar) {
                if($depar->id == Auth::user()->departemen_id) {
                    foreach($depar->jadwals as $jadwal) {
                        foreach($jadwal->jabatans as $jabatan) {
                            foreach($jabatan->pegawais as $pegawai) {
                                array_push($pegawai_ids, $pegawai->id);
                            };
                        };
                    };
                };
            };
        }
        
        $day_today = (int)Carbon::now()->format('d');
        $sevens_ago = $day_today - 6;
        $alpha = [];
        $hadir = [];

        if($sevens_ago < 1) {
           $sevens_ago = 1;
        }

        for($day = $sevens_ago; $day <= $day_today; $day++) {
            $count_alpha = 0;
            $count_hadir = 0;
            $pegawai_count = 0;
            $set_format = Carbon::now()->year . '-' . Carbon::now()->month . '-' . (string)$day;

            foreach($pegawai_ids as $id) {    
                $pegawai_count++;
                $search_hadir = Presensi::where('pegawai_id', $id)->where('keterangan', 'Hadir')->whereDate('created_at', Carbon::parse($set_format)->format('Y-m-d'))->orWhere('pegawai_id', $id)->where('keterangan', 'Terlambat')->whereDate('created_at', Carbon::parse($set_format)->format('Y-m-d'))->get();

                if($search_hadir->count() > 0) {
                    $count_hadir++;
                }

                $current_pegawai = Pegawai::where('id', $id)->get();
                $get_all_day = [];
                foreach ($current_pegawai[0]->jabatan->jadwal->details as $detail) {
                    if(!in_array($detail->hari, $get_all_day)) {
                        array_push($get_all_day, $detail->hari);
                    };
                };

                if(in_array(Carbon::parse($set_format)->isoFormat('dddd'), $get_all_day)) {
                    $search_presensi = Presensi::where('pegawai_id', $id)->where('keterangan', '!=', 'Belum Check Log')->whereDate('created_at', Carbon::parse($set_format)->format('Y-m-d'))->get();
    
                    if($search_presensi->count() == 0) {
                        $count_alpha++;
                    };
                };

                $cek_libur_khusus = LiburKhusus::where('departemen_id', $current_pegawai[0]->jabatan->jadwal->departemen->id)->whereDate('mulai', '<=', Carbon::parse($set_format)->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::parse($set_format)->format('Y-m-d'))->get();

                foreach ($parsedLibur as $libur) {
                    if($set_format == Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
                        if(in_array(Carbon::parse($libur['holiday_date'])->isoFormat('dddd'), $get_all_day) || $cek_libur_khusus->count() > 0) {
                            $count_alpha--;
                        };
                    };
                };
            }

            if($pegawai_count >= count($pegawai_ids)) {
                $hadir_by_day['day'] = $set_format;
                $hadir_by_day['total'] = $count_hadir;

                array_push($hadir, $hadir_by_day);

                $alpha_by_day['day'] = $set_format;
                $alpha_by_day['total'] = $count_alpha;

                array_push($alpha, $alpha_by_day);
            };
        }

        return view('livewire.admin.dashboard.chart-graphic', [
            'hadir' => $hadir,
            'alpha' => $alpha
        ]);
    }
}
