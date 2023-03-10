<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\AktivitasPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowAktivitasPegawai extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $aktivitas = AktivitasPegawai::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        } else {
            $aktivitas = AktivitasPegawai::where('departemen_id', Auth::user()->departemen_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        };

        return view('livewire.admin.dashboard.show-aktivitas-pegawai', [
            'aktivitases' => $aktivitas
        ]);
    }
}
