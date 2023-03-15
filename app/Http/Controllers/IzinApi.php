<?php

namespace App\Http\Controllers;

use App\Models\IzinPresensi;
use App\Models\ReqIzinPresensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IzinApi extends Controller
{
    public function showIzin() {
        if(empty($_GET['token']) || $_GET['token'] !== 'illksGT68ajnsik') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $req_data = [];

        $req_data['approved'] = IzinPresensi::where('pegawai_id', $id)->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->get();

        $req_data['refused'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Refused')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->get();

        $req_data['waiting'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Menunggu Approval')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->get();

        return $req_data;
    }
}
