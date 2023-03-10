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

namespace App\Http\Livewire\Admin\Appr;

use App\Models\ChangeLog;
use App\Models\Izin;
use App\Models\ReqIzin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccIzin extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-izin', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id)
    {
        $rawData = ReqIzin::where('id', $id)->get();
        $data['perusahaan_id'] = Auth::user()->instansi->id;
        $data['keterangan_izin'] = $rawData[0]->keterangan_izin;
        $data['kode_izin'] = $rawData[0]->kode_izin;

        $change['operator_id'] = $rawData[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $rawData[0]->keterangan_pengirim;

        if($rawData[0]->jenis_pengajuan === 'Penambahan') {
            Izin::create($data);
            ReqIzin::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan jenis izin ' . $rawData[0]->keterangan_izin;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($rawData[0]->jenis_pengajuan === 'Perubahan') {
            Izin::where('id', $rawData[0]->izin_id)->update([
                'keterangan_izin' => $data['keterangan_izin'],
                'kode_izin' => $data['kode_izin']
            ]);
            ReqIzin::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data jenis izin ' . $rawData[0]->keterangan_izin;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($rawData[0]->jenis_pengajuan === 'Penghapusan') {
            Izin::where('id', $rawData[0]->izin_id)->delete();
            ReqIzin::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus jenis izin ' . $rawData[0]->keterangan_izin;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqIzin::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqIzin::where('id', $id)->delete();
    }
}
