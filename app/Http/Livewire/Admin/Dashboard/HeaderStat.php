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

use App\Models\Departemen;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderStat extends Component
{
    public function render()
    {
        $get_pegawai_today = [];
        $get_pegawai_yesterday = [];

        $count_hadir_today = 0;
        $count_hadir_yesterday = 0;

        if (empty(Auth::user()->departemen_id)) {
            $data_hadir_today = Presensi::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('keterangan', '!=', 'Belum Check Log')->get();
            foreach ($data_hadir_today as $log) {
                if(!in_array($log->pegawai_id, $get_pegawai_today)) {
                    array_push($get_pegawai_today, $log->pegawai_id);
                    $count_hadir_today++;
                };
            };
    
            $data_hadir_yesterday = Presensi::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('created_at', Carbon::yesterday()->format('Y-m-d'))->where('keterangan', '!=', 'Belum Check Log')->get();
            foreach ($data_hadir_yesterday as $log) {
                if(!in_array($log->pegawai_id, $get_pegawai_yesterday)) {
                    array_push($get_pegawai_yesterday, $log->pegawai_id);
                    $count_hadir_yesterday++;
                };
            };
        } else {
            $data_hadir_today = Presensi::where('departemen_id', Auth::user()->departemen_id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('keterangan', '!=', 'Belum Check Log')->get();
            foreach ($data_hadir_today as $log) {
                if(!in_array($log->pegawai_id, $get_pegawai_today)) {
                    array_push($get_pegawai_today, $log->pegawai_id);
                    $count_hadir_today++;
                };
            };
    
            $data_hadir_yesterday = Presensi::where('departemen_id', Auth::user()->departemen_id)->whereDate('created_at', Carbon::yesterday()->format('Y-m-d'))->where('keterangan', '!=', 'Belum Check Log')->get();
            foreach ($data_hadir_yesterday as $log) {
                if(!in_array($log->pegawai_id, $get_pegawai_yesterday)) {
                    array_push($get_pegawai_yesterday, $log->pegawai_id);
                    $count_hadir_yesterday++;
                };
            };
        }

        return view('livewire.admin.dashboard.header-stat', [
            'departemen' => Departemen::where('perusahaan_id', Auth::user()->instansi->id)->count(),
            'allDepar' => Auth::user()->instansi->departemens,
            'hadir' => $count_hadir_today,
            'hadir_kemarin' => $count_hadir_yesterday,
        ]);
    }
}
