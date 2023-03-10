<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Models\AktivitasPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Aktivitas extends Component
{
    public $bulan;
    public $pegawai_id;
    public function render()
    {
        $aktivitas_pegawai = AktivitasPegawai::where('pegawai_id', $this->pegawai_id)->whereYear('tanggal', Carbon::parse($this->bulan)->format('Y'))->whereMonth('tanggal', Carbon::parse($this->bulan)->format('m'))->get();

        return view('livewire.admin.laporan.aktivitas', [
            'departemens' => Auth::user()->instansi->departemens,
            'aktivitas_pegawai' => $aktivitas_pegawai
        ]);
    }
}
