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

use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PresensiStatistic extends Component
{
    public function render()
    {
        if (empty(Auth::user()->departemen_id)) {
            $presensi_by_keterangan = Presensi::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get()->groupBy('keterangan');
            $preview_param = 'all';
        } else {
            $presensi_by_keterangan = Presensi::where('departemen_id', Auth::user()->departemen_id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get()->groupBy('keterangan');
            $preview_param = Auth::user()->departemen_id;
        };

        return view('livewire.admin.dashboard.presensi-statistic', [
            'presensi_statistics' => $presensi_by_keterangan,
            'preview_param' => $preview_param
        ]);
    }
}
