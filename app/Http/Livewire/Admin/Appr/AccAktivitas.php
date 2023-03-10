<?php

namespace App\Http\Livewire\Admin\Appr;

use App\Models\Aktivitas;
use App\Models\ChangeLog;
use App\Models\ReqAktivitas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccAktivitas extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-aktivitas', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }
    
    public function approved($id) {
        $req_data = ReqAktivitas::where('id', $id)->get();
        $data['departemen_id'] = $req_data[0]->departemen_id;
        $data['aktivitas'] = $req_data[0]->aktivitas;
        $data['status'] = $req_data[0]->status;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            Aktivitas::create($data);
            ReqAktivitas::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan jenis aktivitas ' . $req_data[0]->aktivitas;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            Aktivitas::where('id', $req_data[0]->aktivitas_id)->update([
                'departemen_id' => $data['departemen_id'],
                'aktivitas' => $data['aktivitas'],
                'status' => $data['status']
            ]);
            ReqAktivitas::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Merubah data aktivitas ' . $req_data[0]->aktivitas;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Aktivitas::where('id', $req_data[0]->aktivitas_id)->delete();
            ReqAktivitas::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus jenis aktivitas ' . $req_data[0]->aktivitas;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqAktivitas::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqAktivitas::where('id', $id)->delete();
    }
}
