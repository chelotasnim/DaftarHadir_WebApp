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
use App\Models\IzinPresensi;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\ReqIzinPresensi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccIzinPresensi extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-izin-presensi', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $req_data = ReqIzinPresensi::where('id', $id)->get();
        $pegawai = Pegawai::where('id', $req_data[0]->pegawai_id)->get();
        $data['perusahaan_id'] = $pegawai[0]->jabatan->jadwal->departemen->perusahaan->id;
        $data['departemen_id'] = $pegawai[0]->jabatan->jadwal->departemen->id;
        $data['pegawai_id'] = $req_data[0]->pegawai_id;
        $data['mulai'] = $req_data[0]->mulai;
        $data['sampai'] = $req_data[0]->sampai;
        $data['keterangan'] = $req_data[0]->keterangan;
        $data['lampiran'] = $req_data[0]->lampiran;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            IzinPresensi::create($data);

            Presensi::where('pegawai_id', $data['pegawai_id'])->whereDate('created_at', '>=', $data['mulai'])->whereDate('created_at', '<=', $data['sampai'])->delete();

            ReqIzinPresensi::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Melakukan penambahan izin ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            IzinPresensi::where('id', $req_data[0]->izin_id)->update([
                'pegawai_id' => $data['pegawai_id'],
                'mulai' => $data['mulai'],
                'sampai' => $data['sampai'],
                'keterangan' => $data['keterangan'],
            ]);

            Presensi::where('pegawai_id', $data['pegawai_id'])->whereDate('created_at', '>=', $data['mulai'])->whereDate('created_at', '<=', $data['sampai'])->delete();

            ReqIzinPresensi::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data izin ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            IzinPresensi::where('id', $req_data[0]->izin_id)->delete();
            ReqIzinPresensi::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus data izin ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqIzinPresensi::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqIzinPresensi::where('id', $id)->delete();
    }
}
