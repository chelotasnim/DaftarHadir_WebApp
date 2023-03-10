<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiData extends Controller
{
    public function profile() {
        if(empty($_GET['token']) || $_GET['token'] !== 'LKnbgYUh25y6') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $data_pegawai = Pegawai::where('id', $id)->get();

        $req_data = $data_pegawai[0];
        $req_data['perusahaan_id'] = $data_pegawai[0]->jabatan->jadwal->departemen->perusahaan->id;
        $req_data['departemen_id'] = $data_pegawai[0]->jabatan->jadwal->departemen->id;
        $req_data['departemen'] = $data_pegawai[0]->jabatan->jadwal->departemen->nama_dept;
        $req_data['jabatan'] = $data_pegawai[0]->jabatan->jabatan;

        $splitPrice = str_split((string)$data_pegawai[0]->tunjangan_bulan_ini);
        $joinPrice = implode('', array_reverse($splitPrice, true));
        $final = '';
        for($i = 0; $i < count($splitPrice); $i += 3) {
            $result = substr($joinPrice, $i, 3) . '.';
            $final .= $result;

            if($i >= count($splitPrice) - 3) {
                $req_data['tunjangan_bulan_ini'] = 'Rp ' . substr(implode('', array_reverse(str_split($final), true)), 1) . ',00';
            };
        };

        $phone_num_formatter = str_split($data_pegawai[0]->no_wa);
        $final_number = '';
        for($i = 0; $i < count($phone_num_formatter); $i += 4) {
            $phone_number = substr($data_pegawai[0]->no_wa, $i, 4) . '-';
            $final_number .= $phone_number;

            if($i >= count($phone_num_formatter) - 4) {
                $req_data['no_wa'] = '+62 ' . implode('', array_reverse(str_split(substr(implode('', array_reverse(str_split($final_number), true)), 1)), true));
            };
        }

        return $req_data;
    }

    public function checkLog() {
        if(empty($_GET['token']) || $_GET['token'] !== 'Upos0JHtyH7HHm') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $req_data['history'] = [];
        $pegawai = Pegawai::where('id', $id)->get();
        $data_checkLog = Presensi::where('pegawai_id', $id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        $total_log_completed = 0;
        $total_log_late = 0;
        $total_log_today = 0;

        if($data_checkLog->count() === 0) {
            $libur = true;
            $total_log_today = 0;
        } else {
            $libur = false;
            foreach ($pegawai[0]->jabatan->jadwal->details as $day) {
                if($day->hari == Carbon::now()->isoFormat('dddd')) {
                    $total_log_today++;
                    $this_log['name'] = $day->log_name;
                    $this_log['type'] = $day->log_type;
                    $this_log['time'] = '--;--';
                    $this_log['keterangan'] = 'Belum Check Log';

                    foreach ($data_checkLog as $log) {
                        if(!empty($log->check_log)) {
                            if(strtotime($day->log_time) <= strtotime(Carbon::parse($log->check_log)->format('H:i')) && strtotime($day->log_range) >= strtotime(Carbon::parse($log->check_log)->format('H:i'))) {
                                $this_log['keterangan'] = $log->keterangan;
    
                                $this_log['time'] = $log->check_log;
                                $total_log_completed++;
        
                                if($log->keterangan === 'Terlambat') {
                                    $total_log_late++;
                                };    
                            };
                        };
                    };

                    array_push($req_data['history'], $this_log);
                };
            };

            // foreach ($data_checkLog as $log) {
            //     $total_log_today = 0;
            //     foreach ($pegawai[0]->jabatan->jadwal->details as $day) {
            //         if($day->hari == Carbon::now()->isoFormat('dddd')) {
            //             $total_log_today++;
            //             if(empty($log->check_log)) {
            //                 if(strtotime($day->log_time) <= strtotime(Carbon::parse($log->created_at)->format('H:i')) && strtotime($day->log_range) >= strtotime(Carbon::parse($log->created_at)->format('H:i'))) {
            //                     $this_log['name'] = $day->log_name;
            //                     $this_log['type'] = $day->log_type;
            //                     $this_log['time'] = '--;--';
            //                     $this_log['keterangan'] = $log->keterangan;
        
            //                     if(!empty($log->check_log)) {
            //                         $this_log['time'] = $log->check_log;
            //                         $total_log_completed++;
            //                     };
        
            //                     if($log->keterangan === 'Terlambat') {
            //                         $total_log_late++;
            //                     };
        
            //                     array_push($req_data['history'], $this_log);
            //                 };
            //             } else {
            //                 if(strtotime($day->log_time) <= strtotime(Carbon::parse($log->check_log)->format('H:i')) && strtotime($day->log_range) >= strtotime(Carbon::parse($log->check_log)->format('H:i'))) {
            //                     $this_log['name'] = $day->log_name;
            //                     $this_log['type'] = $day->log_type;
            //                     $this_log['time'] = '--;--';
            //                     $this_log['keterangan'] = $log->keterangan;
        
            //                     if(!empty($log->check_log)) {
            //                         $this_log['time'] = $log->check_log;
            //                         $total_log_completed++;
            //                     };
        
            //                     if($log->keterangan === 'Terlambat') {
            //                         $total_log_late++;
            //                     };
        
            //                     array_push($req_data['history'], $this_log);
            //                 };
            //             };
    
            //         };
            //     };
            // };
        };

        $req_data['statistic']['total_log'] = $total_log_today;
        $req_data['statistic']['total_completed'] = $total_log_completed;
        $req_data['statistic']['total_late'] = $total_log_late;
        $req_data['libur'] = $libur;

        return $req_data;
    }
}
