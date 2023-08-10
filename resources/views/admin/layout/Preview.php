<?php

namespace App\Http\Controllers;

use App\Models\AktivitasPegawai;
use App\Models\IzinPresensi;
use App\Models\Lembur;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Preview extends Controller
{
    public function index($data, $departemen, $subData, $subDataVal) {
        if($departemen === 'all') {
            $depar_query = 'perusahaan_id';
            $depar_id = Auth::user()->instansi->id;
        } else {
            $depar_query = 'departemen_id';
            $depar_id = $departemen;
        };

        if($subDataVal === 'all') {
            $filter_assignment = '!=';
            $filter_type = 'none';
        } else {
            $filter_assignment = '=';
            $filter_type = $subDataVal;
        };

        if($data === 'presensi') {
            $requested_data = Presensi::where($depar_query, $depar_id)->where($subData, $filter_assignment, $filter_type)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        } else if($data === 'aktivitas') {
            $requested_data = AktivitasPegawai::where($depar_query, $depar_id)->where($subData, $filter_assignment, $filter_type)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        }else if($data === 'izin') {
            $requested_data = IzinPresensi::where($depar_query, $depar_id)->where($subData, $filter_assignment, $filter_type)->whereDate('mulai', '<=', Carbon::now()->format('Y-m-d'))->whereDate('sampai', '>=', Carbon::now()->format('Y-m-d'))->get();
        } else if($data === 'lembur') {
            $requested_data = Lembur::where($depar_query, $depar_id)->where($subData, $filter_assignment, $filter_type)->get();
        };
        $used_data = $data;

        return view('admin.dashboard.preview', [
            'parentPage' => 'dashboard',
            'page' => 'Preview Data',
            'pageDesc' => 'Laman Preview ini menampilkan rekap data untuk ekspor XLS',
            'used_data' => $used_data,
            'datas' => $requested_data
        ]);
    }
}
