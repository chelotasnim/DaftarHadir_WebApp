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

namespace App\Http\Controllers;

use App\Models\Jadwal_detail;
use App\Models\jadwal_kerja;
use App\Models\ReqJadwal;
use App\Models\ReqJadwalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Jadwals extends Controller
{
    public function reqNew() {
        $jadwal_utama = request()->validate([
            'departemen_id' => 'required',
            'nama_jadwal' => 'required',
            'keterangan_jadwal' => 'required',
            'type' => 'required',
            'status' => 'required',
            'keterangan_pengirim' => 'required'
        ]);

        $jadwal_utama['pengirim_id'] = Auth::user()->id;
        $jadwal_utama['jenis_pengajuan'] = 'Penambahan';
        $jadwal_utama['status_pengajuan'] = 'Menunggu Approval';

        ReqJadwal::create($jadwal_utama);
        $lastest_jadwal = ReqJadwal::where('departemen_id', $jadwal_utama['departemen_id'])->where('nama_jadwal', $jadwal_utama['nama_jadwal'])->select('id')->get();



        $jadwal_detail['jadwal_kerja_id'] = $lastest_jadwal[0]->id;

        $checkByDay = [
            (int)request()->input('log_total_senin'),
            (int)request()->input('log_total_selasa'),
            (int)request()->input('log_total_rabu'),
            (int)request()->input('log_total_kamis'),
            (int)request()->input('log_total_jumat'),
            (int)request()->input('log_total_sabtu'),
            (int)request()->input('log_total_minggu')
        ];

        for($i = 0; $i < 7; $i++) {
            for ($j = 1; $j <= $checkByDay[$i]; $j++) { 
                switch ($i) {
                    case 0:
                        $jadwal_detail['hari'] = 'Senin';
                        break;
                    case 1:
                        $jadwal_detail['hari'] = 'Selasa';
                        break;
                    case 2:
                        $jadwal_detail['hari'] = 'Rabu';
                        break;
                    case 3:
                        $jadwal_detail['hari'] = 'Kamis';
                        break;
                    case 4:
                        $jadwal_detail['hari'] = 'Jumat';
                        break;
                    case 5:
                        $jadwal_detail['hari'] = 'Sabtu';
                        break;
                    case 6:
                        $jadwal_detail['hari'] = 'Minggu';
                        break;
                };

                $jadwal_detail['log_name'] = request()->input('log_name_' . strtolower($jadwal_detail['hari']) . (string)$j);
                $jadwal_detail['log_type'] = request()->input('log_type_' . strtolower($jadwal_detail['hari']) . (string)$j);
                $jadwal_detail['log_limit'] = request()->input('log_limit_' . strtolower($jadwal_detail['hari']) . (string)$j);
                $jadwal_detail['log_tolerance'] = request()->input('log_tolerance_' . strtolower($jadwal_detail['hari']) . (string)$j);
                $jadwal_detail['log_time'] = request()->input('log_time_' . strtolower($jadwal_detail['hari']) . (string)$j);
                $jadwal_detail['log_range'] = request()->input('log_range_' . strtolower($jadwal_detail['hari']) . (string)$j);

                ReqJadwalDetail::create($jadwal_detail);
            };
        };

        //CR LOG BD

        return back()->with('sended', 'Pengajuan Jadwal Dikirimkan!');
    }

    public function reqChange($id) {
        $jadwal_data = jadwal_kerja::where('id', $id)->get();
        $ket_pengirim = request()->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $new_data = $jadwal_data->toArray();

        if(!empty(request()->input('departemen_id'))) {
            $new_data[0]['departemen_id'] = request()->input('departemen_id');
        };
        if(!empty(request()->input('nama_jadwal'))) {
            $new_data[0]['nama_jadwal'] = request()->input('nama_jadwal');
        };
        if(!empty(request()->input('keterangan_jadwal'))) {
            $new_data[0]['keterangan_jadwal'] = request()->input('keterangan_jadwal');
        };
        if(!empty(request()->input('status'))) {
            $new_data[0]['status'] = request()->input('status');
        };

        $new_data[0]['jadwal_id'] = $id;
        $new_data[0] += $ket_pengirim;
        $new_data[0]['pengirim_id'] = Auth::user()->id;
        $new_data[0]['jenis_pengajuan'] = 'Perubahan';
        $new_data[0]['status_pengajuan'] = 'Menunggu Approval';

        ReqJadwal::create($new_data[0]);
        $new_jadwal = ReqJadwal::where('departemen_id', $new_data[0]['departemen_id'])->where('nama_jadwal', $new_data[0]['nama_jadwal'])->orderBy('id', 'desc')->select('id')->get();

        //CG DTL 4L

        $checkByDay = [
            (int)request()->input('log_total_senin'),
            (int)request()->input('log_total_selasa'),
            (int)request()->input('log_total_rabu'),
            (int)request()->input('log_total_kamis'),
            (int)request()->input('log_total_jumat'),
            (int)request()->input('log_total_sabtu'),
            (int)request()->input('log_total_minggu')
        ];

        for($i = 0; $i < 7; $i++) {
            for ($j = 1; $j <= $checkByDay[$i]; $j++) { 
                switch ($i) {
                    case 0:
                        $new_detail['hari'] = 'Senin';
                        break;
                    case 1:
                        $new_detail['hari'] = 'Selasa';
                        break;
                    case 2:
                        $new_detail['hari'] = 'Rabu';
                        break;
                    case 3:
                        $new_detail['hari'] = 'Kamis';
                        break;
                    case 4:
                        $new_detail['hari'] = 'Jumat';
                        break;
                    case 5:
                        $new_detail['hari'] = 'Sabtu';
                        break;
                    case 6:
                        $new_detail['hari'] = 'Minggu';
                        break;
                };
                
                $old_detail = Jadwal_detail::where('jadwal_kerja_id', $id)->where('hari', $new_detail['hari'])->orderBy('id', 'asc')->get();
                $new_detail['jadwal_kerja_id'] = $new_jadwal[0]->id;
                if(!empty(request()->input('log_name_' . strtolower($new_detail['hari']) . (string)$j))) {
                    $new_detail['log_name'] = request()->input('log_name_' . strtolower($new_detail['hari']) . (string)$j);
                } else {
                    if(!empty($old_detail[$j - 1]->log_name)) {
                        $new_detail['log_name'] = $old_detail[$j - 1]->log_name;
                    };
                };

                if(!empty(request()->input('log_type_' . strtolower($new_detail['hari']) . (string)$j))) {
                    $new_detail['log_type'] = request()->input('log_type_' . strtolower($new_detail['hari']) . (string)$j);
                } else {
                    if(!empty($old_detail[$j - 1]->log_type)) {
                        $new_detail['log_type'] = $old_detail[$j - 1]->log_type;
                    };
                };
        
                if(!empty(request()->input('log_time_' . strtolower($new_detail['hari']) . (string)$j))) {
                    $new_detail['log_time'] = request()->input('log_time_' . strtolower($new_detail['hari']) . (string)$j);
                } else {
                    if(!empty($old_detail[$j - 1]->log_time)) {
                        $new_detail['log_time'] = $old_detail[$j - 1]->log_time;
                    };
                };
        
                if(!empty(request()->input('log_range_' . strtolower($new_detail['hari']) . (string)$j))) {
                    $new_detail['log_range'] = request()->input('log_range_' . strtolower($new_detail['hari']) . (string)$j);
                } else {
                    if(!empty($old_detail[$j - 1]->log_range)) {
                        $new_detail['log_range'] = $old_detail[$j - 1]->log_range;
                    };
                };
        
                if(!empty(request()->input('log_limit_' . strtolower($new_detail['hari']) . (string)$j))) {
                    $new_detail['log_limit'] = request()->input('log_limit_' . strtolower($new_detail['hari']) . (string)$j);
                } else {
                    if(!empty($old_detail[$j - 1]->log_limit)) {
                        $new_detail['log_limit'] = $old_detail[$j - 1]->log_limit;
                    };
                };

                if(!empty(request()->input('log_tolerance_' . strtolower($new_detail['hari']) . (string)$j))) {
                    $new_detail['log_tolerance'] = request()->input('log_tolerance_' . strtolower($new_detail['hari']) . (string)$j);
                } else {
                    if(!empty($old_detail[$j - 1]->log_tolerance)) {
                        $new_detail['log_tolerance'] = $old_detail[$j - 1]->log_tolerance;
                    };
                };
                
                if(!empty($new_detail['log_name']) && !empty($new_detail['log_type']) && !empty($new_detail['log_time']) && !empty($new_detail['log_range']) && !empty($new_detail['log_limit']) && !empty($new_detail['log_tolerance'])) {
                    ReqJadwalDetail::create($new_detail);
                };
            };
        };


        return back()->with('sended', 'Pengajuan Perubahan Dikirimkan!');
    }

    public function reqDestroy($id) {
        $jadwal_data = jadwal_kerja::where('id', $id)->get();
        $ket_pengirim = request()->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $data = $jadwal_data->toArray();
        
        $data[0]['jadwal_id'] = $id;
        $data[0] += $ket_pengirim;
        $data[0]['pengirim_id'] = Auth::user()->id;
        $data[0]['jenis_pengajuan'] = 'Penghapusan';
        $data[0]['status_pengajuan'] = 'Menunggu Approval';

        ReqJadwal::create($data[0]);
        $new_jadwal = ReqJadwal::where('departemen_id', $data[0]['departemen_id'])->where('nama_jadwal', $data[0]['nama_jadwal'])->orderBy('id', 'desc')->select('id')->get();

        foreach ($jadwal_data[0]->details as $detail) {
            $data_details['jadwal_kerja_id'] = $new_jadwal[0]->id;
            $data_details['hari'] = $detail->hari;
            $data_details['log_type'] = $detail->log_type;
            $data_details['log_time'] = $detail->log_time;
            $data_details['log_range'] = $detail->log_range;
            $data_details['log_limit'] = $detail->log_limit;

            ReqJadwalDetail::create($data_details);
        }

        return back()->with('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
