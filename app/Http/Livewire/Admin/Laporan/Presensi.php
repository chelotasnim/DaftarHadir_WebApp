<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Models\AktivitasPegawai;
use App\Models\IzinPresensi;
use App\Models\LiburKhusus;
use App\Models\Pegawai;
use App\Models\Presensi as ModelsPresensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Presensi extends Component
{
    public $bulan;
    public $pegawai_id;
    public function render()
    {
        set_time_limit(0);
        $all_day_in_month = [];
        if(!empty($this->pegawai_id)) {
            if(!empty($this->bulan)) {
                $day_in_month = Carbon::now()->month(Carbon::parse($this->bulan)->format('m'))->daysInMonth;
                $current_month_used = Carbon::parse($this->bulan)->format('Y-m');
            } else {
                $day_in_month = Carbon::now()->month(Carbon::now()->format('m'))->daysInMonth;
                $current_month_used = Carbon::now()->format('Y-m');
            };
    
            $get_all_day = [];
            $current_pegawai = Pegawai::where('id', $this->pegawai_id)->get();
            foreach ($current_pegawai[0]->jabatan->jadwal->details as $detail) {
                if(!in_array($detail->hari, $get_all_day)) {
                    array_push($get_all_day, $detail->hari);
                };
            };
    
            for($day = 1; $day <= $day_in_month; $day++) {
                $set_format = Carbon::parse($current_month_used)->format('Y') . '-' . Carbon::parse($current_month_used)->format('m') . '-' . (string)$day;
    
                $today_presensi_masuk = [];
                $today_presensi_keluar = [];
                $all_presensi_today = ModelsPresensi::where('pegawai_id', $this->pegawai_id)->whereDate('created_at', Carbon::parse($set_format)->format('Y-m-d'))->get();
                foreach ($all_presensi_today as $presensi) {
                    if($presensi->type === 'Masuk') {
                        array_push($today_presensi_masuk, $presensi->check_log);
                    } else if($presensi->type === 'Keluar') {
                        array_push($today_presensi_keluar, $presensi->check_log);
                    };
                };
    
                $per_day['tanggal'] = $set_format;
                $per_day['status'] = 'Aktif';
                $per_day['masuk'] = '--;--';
                $per_day['keluar'] = '--;--';
                $per_day['keterangan_masuk'] = 'Tidak Check Log';
                $per_day['keterangan_keluar'] = 'Tidak Check Log';
                $per_day['keterangan_libur'] = 'Libur (Tidak ada jadwal kerja)';
                $per_day['keterangan_kehadiran'] = 'Alpha';
                $per_day['aktivitas'] = ['Tidak ada aktivitas dilaporkan'];

                if(Carbon::parse($set_format)->format('Y-m-d') >= Carbon::now()->format('Y-m-d')) {
                    $per_day['keterangan_kehadiran'] = 'Hadir';
                    $per_day['keterangan_masuk'] = 'Belum Check Log';
                    $per_day['keterangan_keluar'] = 'Belum Check Log';
                    $per_day['aktivitas'] = ['Belum ada aktivitas dilaporkan'];

                    $all_in_today = [];
                    $all_out_today = [];

                    $per_day['keterangan_kehadiran'] = 'Hadir';

                    foreach ($current_pegawai[0]->jabatan->jadwal->details as $detail) {
                        if($detail->hari == Carbon::parse($set_format)->isoFormat('dddd')) {
                            if($detail->log_type == 'Masuk') {
                                array_push($all_in_today, $detail->log_limit);
                            } else {
                                array_push($all_out_today, $detail->log_limit);
                            }
                        };
                    };
                } else {
                    if(!empty($today_presensi_masuk[0]) || !empty($today_presensi_keluar[count($today_presensi_keluar) - 1])) {
                        $all_in_today = [];
                        $all_out_today = [];
        
                        $per_day['keterangan_kehadiran'] = 'Hadir';
        
                        foreach ($current_pegawai[0]->jabatan->jadwal->details as $detail) {
                            if($detail->hari == Carbon::parse($set_format)->isoFormat('dddd')) {
                                if($detail->log_type == 'Masuk') {
                                    array_push($all_in_today, $detail->log_limit);
                                } else {
                                    array_push($all_out_today, $detail->log_limit);
                                };
                            };
                        };
                    };
                };

                if(!empty($today_presensi_masuk[0]) && !empty($all_in_today[0])) {
                    if(strtotime($today_presensi_masuk[0]) <= strtotime($all_in_today[0])) {
                        $per_day['keterangan_masuk'] = 'Tepat Waktu';
                    } else if(strtotime($today_presensi_masuk[0]) > strtotime($all_in_today[0])) {
                        $per_day['keterangan_masuk'] = 'Terlambat';
                    };
                };

                if(!empty($today_presensi_keluar[count($today_presensi_keluar) - 1]) && !empty($all_out_today[0])) {
                    if(strtotime($today_presensi_keluar[0]) < strtotime($all_out_today[count($all_out_today) - 1])) {
                        $per_day['keterangan_keluar'] = 'Pulang Cepat';
                    } else if(strtotime($today_presensi_keluar[0]) >= strtotime($all_out_today[0])) {
                        $per_day['keterangan_keluar'] = 'Tepat Waktu';
                    };
                };

                $izin_today = IzinPresensi::where('pegawai_id', $this->pegawai_id)->whereDate('mulai', '<=', Carbon::parse($set_format)->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::parse($set_format)->format('Y-m-d'))->select('keterangan')->get();
                if($izin_today->count() > 0) {
                    if(in_array(Carbon::parse($set_format)->isoFormat('dddd'), $get_all_day)) {
                        $per_day['status'] = 'Izin';
                        $per_day['keterangan_libur'] = 'Izin ' . $izin_today[0]->keterangan;
                    };
                };
    
                $libur_khusus = LiburKhusus::where('departemen_id', $current_pegawai[0]->jabatan->jadwal->departemen->id)->whereDate('mulai', '<=', Carbon::parse($set_format)->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::parse($set_format)->format('Y-m-d'))->select('nama_libur')->get();
                if ($libur_khusus->count() > 0) {
                    $per_day['status'] = 'Libur';
                    $per_day['keterangan_libur'] = $libur_khusus[0]->nama_libur;
                };

                $aktivitas = AktivitasPegawai::where('pegawai_id', $this->pegawai_id)->whereDate('tanggal', Carbon::parse($set_format)->format('Y-m-d'))->get();
                if($aktivitas->count() > 0) {
                    $per_day['aktivitas'] = [];
                    foreach ($aktivitas as $laporan) {
                        array_push($per_day['aktivitas'], $laporan->keterangan_aktivitas);
                    }
                };
    
                $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
                $parsedLibur = $liburNasional->json();
                foreach ($parsedLibur as $libur) {
                    if($libur['holiday_date'] == Carbon::parse($set_format)->format('Y-m-d')) {
                        $per_day['status'] = 'Libur';
                        $per_day['keterangan_libur'] = $libur['holiday_name'];
                    };
                };
                
    
                if(!in_array(Carbon::parse($set_format)->isoFormat('dddd'), $get_all_day)) {
                    $per_day['status'] = 'Libur';
                };
    
                if(!empty($today_presensi_masuk[0])) {
                    $per_day['masuk'] = $today_presensi_masuk[0];
                };
                if(!empty($today_presensi_keluar[count($today_presensi_keluar) - 1])) {
                    $per_day['keluar'] = $today_presensi_keluar[count($today_presensi_keluar) - 1];
                };
    
                array_push($all_day_in_month, $per_day);
            };
        };
    
        return view('livewire.admin.laporan.presensi', [
            'departemens' => Auth::user()->instansi->departemens,
            'days_in_month' => $all_day_in_month
        ]);
    }
}
