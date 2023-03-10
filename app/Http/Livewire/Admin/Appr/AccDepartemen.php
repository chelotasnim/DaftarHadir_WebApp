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
use App\Models\Departemen;
use App\Models\ReqDepartemen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccDepartemen extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-departemen', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $rawData = ReqDepartemen::where('id', $id)->get();
        $data['perusahaan_id'] = Auth::user()->instansi->id;
        $data['nama_dept'] = $rawData[0]->nama_dept;
        $data['atasan1'] = $rawData[0]->atasan1;
        $data['atasan2'] = $rawData[0]->atasan2;
        $data['atasan3'] = $rawData[0]->atasan3;
        $data['status'] = $rawData[0]->status;

        $change['operator_id'] = $rawData[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $rawData[0]->keterangan_pengirim;

        if($rawData[0]->jenis_pengajuan === 'Penambahan') {
            Departemen::create($data);
            ReqDepartemen::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan departemen ' . $rawData[0]->nama_dept;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);

        } else if($rawData[0]->jenis_pengajuan === 'Perubahan') {
            Departemen::where('id', $rawData[0]->departemen_id)->update([
                'nama_dept' => $data['nama_dept'],
                'atasan1' => $data['atasan1'],
                'atasan2' => $data['atasan2'],
                'atasan3' => $data['atasan3'],
                'status' => $data['status']
            ]);
            ReqDepartemen::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data departemen ' . $rawData[0]->nama_dept;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);

        } else if($rawData[0]->jenis_pengajuan === 'Penghapusan') {
            Departemen::where('id', $rawData[0]->departemen_id)->delete();  
            ReqDepartemen::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus departemen ' . $rawData[0]->nama_dept;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        };
    }

    public function refused($id) {
        ReqDepartemen::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqDepartemen::where('id', $id)->delete();
    }
}
