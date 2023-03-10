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
use App\Models\LiburNasional;
use App\Models\ReqLiburNasional;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccLiburNasional extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-libur-nasional', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $req_data = ReqLiburNasional::where('id', $id)->get();
        $data['perusahaan_id'] = Auth::user()->instansi->id;
        $data['nama_libur'] = $req_data[0]->nama_libur;
        $data['mulai'] = $req_data[0]->mulai;
        $data['sampai'] = $req_data[0]->sampai;
        $data['pengumuman'] = $req_data[0]->pengumuman;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            LiburNasional::create($data);
            ReqLiburNasional::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan libur ' . $req_data[0]->nama_libur;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            LiburNasional::where('id', $req_data[0]->libur_id)->update([
                'nama_libur' => $data['nama_libur'],
                'mulai' => $data['mulai'],
                'sampai' => $data['sampai'],
                'pengumuman' => $data['pengumuman'],
            ]);

            ReqLiburNasional::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data libur ' . $req_data[0]->nama_libur;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            LiburNasional::where('id', $req_data[0]->libur_id)->delete();

            ReqLiburNasional::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus data libur ' . $req_data[0]->nama_libur;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqLiburNasional::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqLiburNasional::where('id', $id)->delete();
    }
}
