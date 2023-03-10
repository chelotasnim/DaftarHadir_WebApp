<?php

namespace App\Http\Livewire\Admin\Appr;

use App\Models\AktivitasPegawai;
use App\Models\ChangeLog;
use App\Models\Pegawai;
use App\Models\ReqAktivitasPegawai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccAktivitasPegawai extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-aktivitas-pegawai', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $req_data = ReqAktivitasPegawai::where('id', $id)->get();
        $pegawai = Pegawai::where('id', $req_data[0]->pegawai_id)->get();
        $data['perusahaan_id'] = $pegawai[0]->jabatan->jadwal->departemen->perusahaan->id;
        $data['departemen_id'] = $pegawai[0]->jabatan->jadwal->departemen->id;
        $data['pegawai_id'] = $req_data[0]->pegawai_id;
        $data['tanggal'] = $req_data[0]->tanggal;
        $data['mulai'] = $req_data[0]->mulai;
        $data['sampai'] = $req_data[0]->sampai;
        $data['jenis'] = $req_data[0]->jenis;
        $data['keterangan_aktivitas'] = $req_data[0]->keterangan_aktivitas;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            AktivitasPegawai::create($data);

            ReqAktivitasPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Melakukan penambahan izin ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            AktivitasPegawai::where('id', $req_data[0]->aktivitas_id)->update([
                'pegawai_id' => $data['pegawai_id'],
                'tanggal' => $data['tanggal'],
                'mulai' => $data['mulai'],
                'sampai' => $data['sampai'],
                'jenis' => $data['jenis'],
                'keterangan_aktivitas' => $data['keterangan_aktivitas'],
            ]);

            ReqAktivitasPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data aktivitas ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            AktivitasPegawai::where('id', $req_data[0]->aktivitas_id)->delete();

            ReqAktivitasPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus aktivitas ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqAktivitasPegawai::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqAktivitasPegawai::where('id', $id)->delete();
    }
}
