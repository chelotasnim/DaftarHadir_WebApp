<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\IzinPresensi;
use App\Models\LiburKhusus;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PegawaiRank extends Component
{
    public function render()
    {
        $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        $parsedLibur = $liburNasional->json();
        $pegawai_ids = [];
        $pegawai_ids = [];
        foreach(Auth::user()->instansi->departemens as $depar) {
            foreach($depar->jadwals as $jadwal) {
                foreach($jadwal->jabatans as $jabatan) {
                    foreach($jabatan->pegawais as $pegawai) {
                        array_push($pegawai_ids, $pegawai->id);
                    }
                }
            }
        }

        $ranking = [];
        foreach($pegawai_ids as $id) {
            $current_pegawai = Pegawai::where('id', $id)->get();
            $get_all_day = [];
            foreach ($current_pegawai[0]->jabatan->jadwal->details as $detail) {
                if(!in_array($detail->hari, $get_all_day)) {
                    array_push($get_all_day, $detail->hari);
                };
            };

            $get_izin = IzinPresensi::where('pegawai_id', $id)->whereYear('created_at', Carbon::now()->format('Y'))->whereMonth('created_at', Carbon::now()->format('m'))->get();
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
            $ranking[(string)$id]['izin'] = $count_izin;

            $count_alpha = 0;
            for($day = 1; $day <= (int)Carbon::now()->format('d'); $day++) {
                $get_telat = Presensi::where('pegawai_id', $id)->where('keterangan', 'Terlambat')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();

                $set_format = Carbon::now()->year . '-' . Carbon::now()->month . '-' . (string)$day;

                if(in_array(Carbon::parse($set_format)->isoFormat('dddd'), $get_all_day)) {
                    $search_presensi = Presensi::where('pegawai_id', $id)->where('keterangan', '!=', 'Belum Check Log')->whereDate('created_at', Carbon::parse($set_format)->format('Y-m-d'))->get();

                    if($search_presensi->count() == 0) {
                        $count_alpha++;
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

                $ranking[(string)$id]['alpha'] = 0;
                $ranking[(string)$id]['telat'] = 0;
                $ranking[(string)$id]['total'] = $ranking[(string)$id]['alpha'] + $ranking[(string)$id]['telat'];

                if($day >= Carbon::now()->format('d')) {
                    if($count_alpha + $get_telat->count() > 5) {
                        $ranking[(string)$id]['alpha'] = $count_alpha - $ranking[(string)$id]['izin'];
                        $ranking[(string)$id]['telat'] = $get_telat->count();
                        $ranking[(string)$id]['total'] = $ranking[(string)$id]['alpha'] + $ranking[(string)$id]['telat'];

                        $total_stat = $ranking[(string)$id]['total'];
                        if($total_stat > 5 && $total_stat <= 10) {
                            $ranking[(string)$id]['medal'] = 'C-';
                        } else if($total_stat > 10 && $total_stat <= 15) {
                            $ranking[(string)$id]['medal'] = 'D';
                        } else if($total_stat > 15) {
                            $ranking[(string)$id]['medal'] = 'E';
                        }
                    } else {
                        unset($ranking[(string)$id]);
                    }
                };
            }
        }

        return view('livewire.admin.dashboard.pegawai-rank', [
            'departemens' => Auth::user()->instansi->departemens,
            'rank' => $ranking
        ]);
    }
}
