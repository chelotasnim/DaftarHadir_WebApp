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

use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\ReqPresensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApprPresensi extends Component
{
    use WithFileUploads;

    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $presensis = Presensi::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        } else {
            $presensis = Presensi::where('departemen_id', Auth::user()->departemen_id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        };

        return view('livewire.admin.dashboard.appr-presensi', [
            'departemens' => Auth::user()->instansi->departemens,
            'presensis' => $presensis
        ]);
    }

    public $pegawai_id;
    public $check_log;
    public $lampiran;
    public $keterangan_pengirim;
    public function reqNew() {
        $presensi_data = $this->validate([
            'pegawai_id' => 'required',
            'lampiran' => 'image|max:1024',
            'keterangan_pengirim' => 'required|min:25|max:255'
        ]);

        $get_pegawai = Pegawai::where('id', $presensi_data['pegawai_id'])->get();
        $now = 0;
        foreach ($get_pegawai[0]->jabatan->jadwal->details as $detail) {
            if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
                if(strtotime($detail->log_time) <= strtotime($this->check_log) && strtotime($detail->log_range) > strtotime($this->check_log)) {
                    $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

                    $get_presensi = Presensi::whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('pegawai_id', $presensi_data['pegawai_id'])->where('created_at', $start_time)->select('id')->get();
                };
            };
        }

        $presensi_data['check_log'] = $this->check_log;
        $presensi_data['pengirim_id'] = Auth::user()->id;
        $presensi_data['pengirim_id'] = Auth::user()->id;
        $presensi_data['jenis_pengajuan'] = 'Penambahan';
        $presensi_data['status_pengajuan'] = 'Menunggu Approval';
        $presensi_data['lampiran'] = $this->lampiran->store('LampiranPresensi', 'public');

        if(isset($get_presensi)) {
            $presensi_data['presensi_id'] = $get_presensi[0]->id;

            ReqPresensi::create($presensi_data);
            session()->flash('sended', 'Pengajuan Presensi Dikirimkan!');

            $this->reset();
        } else {
            return back()->with('failed', 'Jadwal Check Log Tidak Ditemukan!');
        };
    }

    public function reqDestroy($id) {
        $presensi_data = Presensi::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['presensi_id'] = $presensi_data[0]->id;
        $req_data['pegawai_id'] = $presensi_data[0]->pegawai_id;
        $req_data['check_log'] = $presensi_data[0]->check_log;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqPresensi::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
