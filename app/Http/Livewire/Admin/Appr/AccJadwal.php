<?php

namespace App\Http\Livewire\Admin\Appr;

use App\Models\ChangeLog;
use App\Models\Jadwal_detail;
use App\Models\jadwal_kerja;
use App\Models\ReqJadwal;
use App\Models\ReqJadwalDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccJadwal extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-jadwal', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id)
    {
        $req_data = ReqJadwal::where('id', $id)->get();
        $data['departemen_id'] = $req_data[0]->departemen_id;
        $data['nama_jadwal'] = $req_data[0]->nama_jadwal;
        $data['keterangan_jadwal'] = $req_data[0]->keterangan_jadwal;
        $data['type'] = $req_data[0]->type;
        $data['status'] = $req_data[0]->status;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            jadwal_kerja::create($data);
            $get_new_jadwal = jadwal_kerja::where('departemen_id', $data['departemen_id'])->where('nama_jadwal', $data['nama_jadwal'])->orderBy('created_at', 'desc')->select('id')->get();

            foreach ($req_data[0]->details as $detail) {
                $detail_baru['jadwal_kerja_id'] = $get_new_jadwal[0]->id;
                $detail_baru['log_name'] = $detail->log_name;
                $detail_baru['hari'] = $detail->hari;
                $detail_baru['log_tolerance'] = $detail->log_tolerance;
                $detail_baru['log_type'] = $detail->log_type;
                $detail_baru['log_time'] = $detail->log_time;
                $detail_baru['log_limit'] = $detail->log_limit;
                $detail_baru['log_range'] = $detail->log_range;

                Jadwal_detail::create($detail_baru);
            };

            ReqJadwal::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan jadwal ' . $req_data[0]->nama_jadwal;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            jadwal_kerja::where('id', $req_data[0]->jadwal_id)->update([
                'departemen_id' => $data['departemen_id'],
                'nama_jadwal' => $data['nama_jadwal'],
                'keterangan_jadwal' => $data['keterangan_jadwal'],
                'status' => $data['status'],
            ]);

            foreach ($req_data[0]->details as $detail) {
                $get_all_detail = Jadwal_detail::where('jadwal_kerja_id', $req_data[0]->jadwal_id)->where('hari', $detail->hari)->get();
                if($get_all_detail->count() === 0) {
                    Jadwal_detail::create([
                        'jadwal_kerja_id' => $req_data[0]->jadwal_id,
                        'log_name' => $detail->log_name,
                        'hari' => $detail->hari,
                        'log_type' => $detail->log_type,
                        'log_time' => $detail->log_time,
                        'log_tolerance' => $detail->log_tolerance,
                        'log_range' => $detail->log_range,
                        'log_limit' => $detail->log_limit
                    ]);
                } else {
                    foreach ($get_all_detail as $old_detail) {
                        if($old_detail->hari == $detail->hari) {
                            if(strtotime($detail->log_time) < strtotime($old_detail->log_time) && strtotime($detail->log_range) <= strtotime($old_detail->log_time)) {
                                if($old_detail->log_limit != $detail->log_limit) {
                                    if($old_detail->log_tolerance != $detail->log_tolerance) {
                                        Jadwal_detail::create([
                                            'jadwal_kerja_id' => $req_data[0]->jadwal_id,
                                            'log_name' => $detail->log_name,
                                            'hari' => $detail->hari,
                                            'log_type' => $detail->log_type,
                                            'log_time' => $detail->log_time,
                                            'log_tolerance' => $detail->log_tolerance,
                                            'log_range' => $detail->log_range,
                                            'log_limit' => $detail->log_limit
                                        ]);
                                    };
                                };
                            };

                            if(strtotime($detail->log_time) >= strtotime($old_detail->log_range) && strtotime($detail->log_range) > strtotime($old_detail->log_range)) {
                                if($old_detail->log_limit != $detail->log_limit) {
                                    if($old_detail->log_tolerance != $detail->log_tolerance) {
                                        Jadwal_detail::create([
                                            'jadwal_kerja_id' => $req_data[0]->jadwal_id,
                                            'log_name' => $detail->log_name,
                                            'hari' => $detail->hari,
                                            'log_type' => $detail->log_type,
                                            'log_time' => $detail->log_time,
                                            'log_tolerance' => $detail->log_tolerance,
                                            'log_range' => $detail->log_range,
                                            'log_limit' => $detail->log_limit
                                        ]);
                                    };
                                };
                            };
                        };
                    };
                };
            };

            $check_if_same = Jadwal_detail::where('jadwal_kerja_id', $req_data[0]->jadwal_id)->get();
            foreach ($check_if_same as $log) {
                $get_again = Jadwal_detail::where('jadwal_kerja_id', $req_data[0]->jadwal_id)->where('hari', $log->hari)->where('log_type', $log->log_type)->where('log_name', $log->log_name)->where('log_time', $log->log_time)->where('log_range', $log->log_range)->get();

                if($get_again->count() > 1) {
                    Jadwal_detail::where('id', $get_again[0]->id)->delete();
                };
            };

            ReqJadwal::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Merubah Data jadwal ' . $req_data[0]->nama_jadwal;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Jadwal_detail::where('jadwal_kerja_id', $req_data[0]->jadwal_id)->delete();
            jadwal_kerja::where('id', $req_data[0]->jadwal_id)->delete();

            ReqJadwal::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus Jadwal ' . $req_data[0]->nama_jadwal;
            $change['jenis_perubahan'] = 'Penghapusan';
        }
    }

    public function refused($id) {
        ReqJadwal::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    } 

    public function trash($id) {
        ReqJadwalDetail::where('jadwal_kerja_id', $id)->delete();
        ReqJadwal::where('id', $id)->delete();
    } 
}
