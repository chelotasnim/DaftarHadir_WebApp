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
use App\Models\Jabatan;
use App\Models\ReqJabatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccJabatan extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-jabatan', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id)
    {
        $req_data = ReqJabatan::where('id', $id)->get();
        $data['jadwal_id'] = $req_data[0]->jadwal_id;
        $data['jatah_cuti_tahunan'] = $req_data[0]->jatah_cuti_tahunan;
        $data['jabatan'] = $req_data[0]->jabatan;
        $data['gaji'] = $req_data[0]->gaji;
        $data['status'] = $req_data[0]->status;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            Jabatan::create($data);
            ReqJabatan::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan jabatan ' . $req_data[0]->jabatan;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);

        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            Jabatan::where('id', $req_data[0]->jabatan_id)->update([
                'jadwal_id' => $data['jadwal_id'],
                'jatah_cuti_tahunan' => $data['jatah_cuti_tahunan'],
                'jabatan' => $data['jabatan'],
                'gaji' => $data['gaji'],
                'status' => $data['status']
            ]);
            ReqJabatan::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data jadwal ' . $req_data[0]->nama_jabatan;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);

        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Jabatan::where('id', $req_data[0]->jabatan_id)->delete();  
            ReqJabatan::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus jabatan ' . $req_data[0]->jabatan;
            $change['jenis_perubahan'] = 'Penghapusan';
        };
    }
    
    public function refused($id) {
        ReqJabatan::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqJabatan::where('id', $id)->delete();
    }
}
