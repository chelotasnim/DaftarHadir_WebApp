<?php

namespace App\Console\Commands;

use App\Http\Livewire\Admin\Laporan\Presensi;
use App\Models\IzinPresensi;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PresensiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $liburNasional = Http::get('https://api-harilibur.vercel.app/api');
        $parsedLibur = $liburNasional->json();
        $is_now_active = true;

        foreach ($parsedLibur as $libur) {
            if(Carbon::now()->format('Y-m-d') === Carbon::parse($libur['holiday_date'])->format('Y-m-d')) {
                $is_now_active = false;
            };
        };

        if($is_now_active === true) {
            $pegawais = Pegawai::get();
            foreach ($pegawais as $pegawai) {
                $libur_depar = false;

                if(isset($pegawai->jabatan->jadwal->departemen->liburKhusus[0])) {
                    foreach ($pegawai->jabatan->jadwal->departemen->liburKhusus as $liburDepar) {
                        if(Carbon::now()->format('Y-m-d') >= Carbon::parse($liburDepar->mulai) && Carbon::now()->format('Y-m-d') <= Carbon::parse($liburDepar->sampai)->format('Y-m-d')) {
                            $libur_depar = true;
                        };
                    };
                };
                
                if($libur_depar === false) {
                    $check_izin = IzinPresensi::where('pegawai_id', $pegawai->id)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->count();
                    if($check_izin === 0) {
                        foreach ($pegawai->jabatan->jadwal->details as $detail) {
                            if(Carbon::now()->isoFormat('dddd') === $detail->hari) {
                                $start_time = Carbon::now()->format('Y-m-d') . ' ' . $detail->log_time . ':00';

                                $check_presensi = Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('created_at', $start_time)->count();    

                                if($check_presensi === 0) {
                                    $new_presensi['perusahaan_id'] = $pegawai->jabatan->jadwal->departemen->perusahaan->id;
                                    $new_presensi['departemen_id'] = $pegawai->jabatan->jadwal->departemen->id;
                                    $new_presensi['pegawai_id'] = $pegawai->id;
                                    $new_presensi['keterangan'] = 'Belum Check Log';
                                    $new_presensi['created_at'] = $start_time;
                                    Presensi::create($new_presensi);
                                };
                            };
                        };
                    } else {
                        Presensi::where('pegawai_id', $pegawai->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->delete();
                    };
                };
            };
        };
    }
}
