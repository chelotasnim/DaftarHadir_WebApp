<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\AktivitasPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AktivitasStatistic extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $allAktivitas = AktivitasPegawai::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->count();
            $aktivitasByJenis = AktivitasPegawai::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get()->groupBy('jenis');
            $preview_param = 'all';
        } else {
            $allAktivitas = AktivitasPegawai::where('departemen_id', Auth::user()->departemen_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->count();
            $aktivitasByJenis = AktivitasPegawai::where('departemen_id', Auth::user()->departemen_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get()->groupBy('jenis');
            $preview_param = Auth::user()->departemen_id;
        };

        return view('livewire.admin.dashboard.aktivitas-statistic', [
            'total' => $allAktivitas,
            'by_jenis' => $aktivitasByJenis,
            'preview_param' => $preview_param
        ]);
    }
}
