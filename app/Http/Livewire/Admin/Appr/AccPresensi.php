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
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\ReqPresensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccPresensi extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-presensi', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id) {
        $req_data = ReqPresensi::where('id', $id)->get();
        $data['perusahaan_id'] = $req_data[0]->pegawai->jabatan->jadwal->departemen->perusahaan->id;
        $data['departemen_id'] = $req_data[0]->pegawai->jabatan->jadwal->departemen->id;
        $data['pegawai_id'] = $req_data[0]->pegawai_id;
        $data['check_log'] = $req_data[0]->check_log;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            $get_pegawai = Pegawai::where('id', $data['pegawai_id'])->get();
            foreach ($get_pegawai[0]->jabatan->jadwal->details as $detail) {
                if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
                    if(strtotime($detail->log_time) <= strtotime($data['check_log']) && strtotime($detail->log_range) > strtotime($data['check_log'])) {

                        if($detail->log_type === 'Masuk') {
                            $data['type'] = 'Masuk';

                            if(strtotime($data['check_log']) >= strtotime($detail->log_time) && strtotime($data['check_log']) <= strtotime($detail->log_limit)) {
                                $data['catatan'] = 'Tepat Waktu';
                                $data['keterangan'] = 'Hadir';
                            };

                            if(strtotime($data['check_log']) > strtotime($detail->log_limit) && strtotime($data['check_log']) <= strtotime($detail->log_tolerance)) {
                                $data['catatan'] = 'Masuk ' . Carbon::parse($detail->log_limit)->diffInMinutes(Carbon::parse($data['check_log'])) . ' Menit Lebih Lambat (Dalam Toleransi)';
                                $data['keterangan'] = 'Hadir';
                            };

                            if(strtotime($data['check_log']) > strtotime($detail->log_tolerance) && strtotime($data['check_log']) <= strtotime($detail->log_range)) {
                                $data['catatan'] = 'Terlambat ' . Carbon::parse($detail->log_limit)->diffInMinutes(Carbon::parse($data['check_log'])) . ' Menit (Diluar Toleransi)';
                                $data['keterangan'] = 'Terlambat';
                            };

                        } else if($detail->log_type === 'Keluar') {
                            $data['type'] = 'Keluar';

                            if(strtotime($data['check_log']) >= strtotime($detail->log_limit) && strtotime($data['check_log']) <= strtotime($detail->log_range)) {
                                $data['catatan'] = 'Tepat Waktu';
                                $data['keterangan'] = 'Keluar';
                            };

                            if(strtotime($data['check_log']) < strtotime($detail->log_limit) && strtotime($data['check_log']) >= strtotime($detail->tolerance)) {
                                $data['catatan'] = 'Keluar ' . Carbon::parse($detail->log_limit)->diffInMinutes(Carbon::parse($data['check_log'])) . ' Menit Lebih Awal (Dalam Toleransi)';
                                $data['keterangan'] = 'Keluar';
                            };

                            if(strtotime($data['check_log']) < strtotime($detail->log_tolerance) && strtotime($data['check_log']) >= strtotime($detail->time)) {
                                $data['catatan'] = 'Keluar ' . Carbon::parse($detail->log_limit)->diffInMinutes(Carbon::parse($data['check_log'])) . ' Menit Lebih Awal (Diluar Toleransi)';
                                $data['keterangan'] = 'Keluar Awal';
                            };
                        };

                        $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';
                        $finish_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_range . ':00';

                        Presensi::whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('pegawai_id', $data['pegawai_id'])->where('created_at', $start_time)->update([
                            'type' => $data['type'],
                            'check_log' => $data['check_log'],
                            'keterangan' => $data['keterangan'],
                            'catatan' => $data['catatan']
                        ]);

                        ReqPresensi::where('id', $id)->update([
                            'penerima_id' => Auth::user()->id,
                            'status_pengajuan' => 'Approved'
                        ]);
            
                        $change['perubahan'] = 'Menambahkan presensi ' . $req_data[0]->pegawai->nama;
                        $change['jenis_perubahan'] = 'Penambahan';
                        ChangeLog::create($change);
                    };
                };
            };
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Presensi::where('id', $req_data[0]->presensi_id)->delete();

            ReqPresensi::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus data presensi ' . $req_data[0]->pegawai->nama;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        };
    }

    public function refused($id) {
        ReqPresensi::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqPresensi::where('id', $id)->delete();
    }
}
