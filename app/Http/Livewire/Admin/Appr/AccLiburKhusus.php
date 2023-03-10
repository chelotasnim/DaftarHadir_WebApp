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
use App\Models\LiburKhusus;
use App\Models\ReqLiburKhusus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccLiburKhusus extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-libur-khusus', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $req_data = ReqLiburKhusus::where('id', $id)->get();
        $data['departemen_id'] = $req_data[0]->departemen_id;
        $data['nama_libur'] = $req_data[0]->nama_libur;
        $data['mulai'] = $req_data[0]->mulai;
        $data['sampai'] = $req_data[0]->sampai;
        $data['pengumuman'] = $req_data[0]->pengumuman;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            LiburKhusus::create($data);
            ReqLiburKhusus::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan libur ' . $req_data[0]->nama_libur;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            LiburKhusus::where('id', $req_data[0]->libur_id)->update([
                'departemen_id' => $data['departemen_id'],
                'nama_libur' => $data['nama_libur'],
                'mulai' => $data['mulai'],
                'sampai' => $data['sampai'],
                'pengumuman' => $data['pengumuman'],
            ]);

            ReqLiburKhusus::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data libur ' . $req_data[0]->nama_libur;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            LiburKhusus::where('id', $req_data[0]->libur_id)->delete();

            ReqLiburKhusus::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus data libur ' . $req_data[0]->nama_libur;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqLiburKhusus::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqLiburKhusus::where('id', $id)->delete();
    }
}
