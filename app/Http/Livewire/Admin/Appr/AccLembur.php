<?php

namespace App\Http\Livewire\Admin\Appr;

use App\Models\ChangeLog;
use App\Models\Lembur;
use App\Models\Pegawai;
use App\Models\ReqLembur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccLembur extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-lembur', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $req_data = ReqLembur::where('id', $id)->get();
        $pegawai = Pegawai::where('id', $req_data[0]->pegawai_id)->get();
        $data['perusahaan_id'] = $pegawai[0]->jabatan->jadwal->departemen->perusahaan->id;
        $data['departemen_id'] = $pegawai[0]->jabatan->jadwal->departemen->id;
        $data['pegawai_id'] = $req_data[0]->pegawai_id;
        $data['tanggal'] = $req_data[0]->tanggal;
        $data['mulai'] = $req_data[0]->mulai;
        $data['sampai'] = $req_data[0]->sampai;
        $data['keterangan_aktivitas'] = $req_data[0]->keterangan_aktivitas;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            $jam_mulai = Carbon::parse($data['mulai']);
            $jam_selesai = Carbon::parse($data['sampai']);
            $jam_total = (int)$jam_mulai->diffInHours($jam_selesai);

            if($pegawai[0]->jabatan->jadwal->departemen->perusahaan->smart_wages === 'Aktif') {
                $gaji = (int)$pegawai[0]->jabatan->gaji + $pegawai[0]->tunjangan_tetap;
                $bonus = $pegawai[0]->tunjangan_bulan_ini;
                $const_path = 1;
                for($i = 1; $i <= $jam_total; $i++) {
                    $const_path += 0.5;
                    $bonus += $const_path * 1 / 173 * $jam_total * $gaji;
                }
                Pegawai::where('id', $req_data[0]->pegawai_id)->update(['tunjangan_bulan_ini' => $bonus]);
            };

            Lembur::create($data);

            ReqLembur::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Melakukan penambahan izin ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            Lembur::where('id', $req_data[0]->aktivitas_id)->update([
                'pegawai_id' => $data['pegawai_id'],
                'tanggal' => $data['tanggal'],
                'mulai' => $data['mulai'],
                'sampai' => $data['sampai'],
                'keterangan_aktivitas' => $data['keterangan_aktivitas'],
            ]);

            ReqLembur::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data aktivitas ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Lembur::where('id', $req_data[0]->aktivitas_id)->delete();

            ReqLembur::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus aktivitas ' . $pegawai[0]->nama;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqLembur::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqLembur::where('id', $id)->delete();
    }
}
