<?php

namespace App\Http\Controllers;

use App\Models\IzinPresensi;
use App\Models\Lembur;
use App\Models\LiburKhusus;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PerformaGraphic extends Controller
{
    public function index($get_status, $get_month, $get_depar) {
        $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        $parsedLibur = $liburNasional->json();
        $pegawai_ids = [];

        if(!empty(Auth::user()->departemen_id)) {
            $get_depar = Auth::user()->departemen_id;
        };

        foreach(Auth::user()->instansi->departemens as $depar) {
            if($get_depar != 'all') {
                if($depar->id == $get_depar) {
                    foreach($depar->jadwals as $jadwal) {
                        foreach($jadwal->jabatans as $jabatan) {
                            foreach($jabatan->pegawais as $pegawai) {
                                array_push($pegawai_ids, $pegawai->id);
                            }
                        }
                    }
                }
            } else {
                foreach($depar->jadwals as $jadwal) {
                    foreach($jadwal->jabatans as $jabatan) {
                        foreach($jabatan->pegawais as $pegawai) {
                            array_push($pegawai_ids, $pegawai->id);
                        }
                    }
                }
            }
        }

        $hadir = [];
        $lembur = [];
        $telat = [];
        $izin = [];
        $alpha = [];
        $active_day = [];
        foreach($pegawai_ids as $id) {
            if(!empty($get_month)) {
                $day_in_month = Carbon::now()->month(Carbon::parse($get_month)->format('m'))->daysInMonth;
                $current_month_used = Carbon::parse($get_month)->format('Y-m');
                if(strtotime($current_month_used) == strtotime(Carbon::now()->format('Y-m'))) {
                    $day_range = (int)Carbon::now()->format('d');
                } else {
                    $day_range = $day_in_month;
                }
            } else {
                $day_in_month = Carbon::now()->month(Carbon::now()->format('m'))->daysInMonth;
                $day_range =  (int)Carbon::now()->format('d');
                $current_month_used = Carbon::now()->format('Y-m');
            };

            $jam_lembur = 0;
            $get_lembur = Lembur::where('pegawai_id', $id)->whereYear('tanggal', Carbon::parse($current_month_used)->format('Y'))->whereMonth('tanggal', Carbon::parse($current_month_used)->format('m'))->get();
            foreach ($get_lembur as $lembur) {
                $jam_mulai = Carbon::parse($lembur->mulai);
                $jam_selesai = Carbon::parse($lembur->sampai);
                $jam_lembur += (int)$jam_mulai->diffInHours($jam_selesai);
            }
            $lembur[(string)$id] = $jam_lembur;

            $get_telat = Presensi::where('pegawai_id', $id)->where('keterangan', 'Terlambat')->whereYear('created_at', Carbon::parse($current_month_used)->format('Y'))->whereMonth('created_at', Carbon::parse($current_month_used)->format('m'))->get();
            $telat[(string)$id] = $get_telat;

            $current_pegawai = Pegawai::where('id', $id)->get();
            $get_all_day = [];
            foreach ($current_pegawai[0]->jabatan->jadwal->details as $detail) {
                if(!in_array($detail->hari, $get_all_day)) {
                    array_push($get_all_day, $detail->hari);
                };
            };

            $get_izin = IzinPresensi::where('pegawai_id', $id)->whereYear('created_at', Carbon::parse($current_month_used)->format('Y'))->whereMonth('created_at', Carbon::parse($current_month_used)->format('m'))->get();
            $count_izin = 0;
            foreach ($get_izin as $day_izin) {
                $start_izin = Carbon::parse($day_izin->mulai);
                $end_izin = Carbon::parse($day_izin->sampai);

                $i_izin = (int)$start_izin->format('d');
                while($i_izin <= (int)$end_izin->format('d')) {
                    $set_date = $start_izin->year . '-' . $start_izin->month . '-' . (string)$i_izin;
                    if(in_array(Carbon::parse($set_date)->isoFormat('dddd'), $get_all_day)) {
                        $count_izin++;
                    };

                    $cek_libur_khusus = LiburKhusus::where('departemen_id', $current_pegawai[0]->jabatan->jadwal->departemen->id)->whereDate('mulai', '<=', Carbon::parse($start_izin)->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::parse($end_izin)->format('Y-m-d'))->get();
    
                    foreach ($parsedLibur as $libur) {
                        if($set_date == Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
                            if(in_array(Carbon::parse($libur['holiday_date'])->isoFormat('dddd'), $get_all_day) || $cek_libur_khusus->count() > 0) {
                                $count_izin--;
                            };
                        };
                    };

                    $i_izin++;
                }

            }
            $izin[(string)$id] = $count_izin;

            $count_alpha = 0;
            $count_act_day = 0;
            $count_hadir = 0;
            for($day = 1; $day <= $day_in_month; $day++) {
                $set_format = Carbon::parse($current_month_used)->format('Y') . '-' . Carbon::parse($current_month_used)->format('m') . '-' . (string)$day;

                if(in_array(Carbon::parse($set_format)->isoFormat('dddd'), $get_all_day)) {
                    $count_act_day++;
                };

                $cek_libur_khusus = LiburKhusus::where('departemen_id', $current_pegawai[0]->jabatan->jadwal->departemen->id)->whereDate('mulai', '<=', Carbon::parse($set_format)->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::parse($set_format)->format('Y-m-d'))->get();

                foreach ($parsedLibur as $libur) {
                    if($set_format == Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
                        if(in_array(Carbon::parse($libur['holiday_date'])->isoFormat('dddd'), $get_all_day) || $cek_libur_khusus->count() > 0) {
                            $count_act_day--;
                        };
                    };
                };
            };

            for($day = 1; $day <= $day_range; $day++) {
                $set_format = Carbon::parse($current_month_used)->format('Y') . '-' . Carbon::parse($current_month_used)->format('m') . '-' . (string)$day;

                if(in_array(Carbon::parse($set_format)->isoFormat('dddd'), $get_all_day)) {
                    $search_presensi = Presensi::where('pegawai_id', $id)->where('keterangan', '!=', 'Belum Check Log')->whereDate('created_at', Carbon::parse($set_format)->format('Y-m-d'))->count();

                    if($search_presensi == 0 && Carbon::parse($set_format)->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {
                        $count_alpha++;
                    } else if($search_presensi > 0) {
                        $count_hadir++;
                    };
                };

                $cek_libur_khusus = LiburKhusus::where('departemen_id', $current_pegawai[0]->jabatan->jadwal->departemen->id)->whereDate('mulai', '<=', Carbon::parse($set_format)->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::parse($set_format)->format('Y-m-d'))->get();

                foreach ($parsedLibur as $libur) {
                    if($set_format == Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
                        if(in_array(Carbon::parse($libur['holiday_date'])->isoFormat('dddd'), $get_all_day) || $cek_libur_khusus->count() > 0) {
                            $count_alpha--;
                        };
                    };
                };

                if($day >= $day_range) {
                    $hadir[(string)$id] = $count_hadir;
                    $alpha[(string)$id] = $count_alpha;
                    $active_day[(string)$id] = $count_act_day;
                };
            };

            if(!empty($get_month)) {
                if(strtotime($current_month_used) > strtotime(Carbon::now()->format('Y-m'))) {
                    $alpha = [];
                };
            };
        }

        if($get_status == 'print') {
            return view('admin.laporan.print-chart-performa', [
                'bulan' => $get_month,
                'departemen_id' => $get_depar,
                'departemens' => Auth::user()->instansi->departemens,
                'log_hadir' => $hadir,
                'log_lembur' => $lembur,
                'log_telat' => $telat,
                'log_izin' => $izin,
                'log_alpha' => $alpha,
                'act_day' => $active_day,
                'parentPage' => 'laporan',
                'page' => 'Performa Karyawan',
                'pageDesc' => 'Laman Performa ini menampilkan rekap performa kehadiran pegawai dalam 1 Bulan'
            ]);
        } else {
            return view('admin.laporan.performa-graphic', [
                'bulan' => $get_month,
                'departemen_id' => $get_depar,
                'departemens' => Auth::user()->instansi->departemens,
                'log_hadir' => $hadir,
                'log_lembur' => $lembur,
                'log_telat' => $telat,
                'log_izin' => $izin,
                'log_alpha' => $alpha,
                'act_day' => $active_day,
                'parentPage' => 'laporan',
                'page' => 'Performa Karyawan',
                'pageDesc' => 'Laman Performa ini menampilkan rekap performa kehadiran pegawai dalam 1 Bulan'
            ]);
        }
    }
}
