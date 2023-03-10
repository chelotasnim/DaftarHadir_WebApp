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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DonutChart extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $izin_hari_ini = IzinPresensi::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->get()->groupBy('keterangan');
        } else {
            $izin_hari_ini = IzinPresensi::where('departemen_id', Auth::user()->departemen_id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->get()->groupBy('keterangan');
        };

        return view('livewire.admin.dashboard.donut-chart', [
            'izin_ket' => $izin_hari_ini
        ]);
    }
}
