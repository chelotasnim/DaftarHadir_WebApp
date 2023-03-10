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
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IzinPresensiStatistic extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $allIzin = IzinPresensi::where('perusahaan_id', Auth::user()->instansi->id)->count();
            $izin_by_keterangan = IzinPresensi::where('perusahaan_id', Auth::user()->instansi->id)->get()->groupBy('keterangan');
            $preview_param = 'all';
        } else {
            $allIzin = IzinPresensi::where('departemen_id', Auth::user()->departemen_id)->count();
            $izin_by_keterangan = IzinPresensi::where('departemen_id', Auth::user()->departemen_id)->get()->groupBy('keterangan');
            $preview_param = Auth::user()->departemen_id;
        };

        return view('livewire.admin.dashboard.izin-presensi-statistic', [
            'total_izin' => $allIzin,
            'izin_statistics' => $izin_by_keterangan,
            'preview_param' => $preview_param
        ]);
    }
}
