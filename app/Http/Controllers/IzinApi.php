<?php

namespace App\Http\Controllers;

use App\Models\ReqIzinPresensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IzinApi extends Controller
{
    public function izinApproved() {
        if(empty($_GET['token']) || $_GET['token'] !== 'illksGT68ajnsik') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $req_data = [];
        $req_data['statistic'] = [];

        $req_data['approved'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Approved')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->get();
        $req_data['statistic']['approved'] = count($req_data['approved']);

        $req_data['statistic']['waiting'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Menunggu Approval')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->count();

        $req_data['statistic']['refused'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Refused')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->count();

        return $req_data;
    }

    public function izinWaiting() {
        if(empty($_GET['token']) || $_GET['token'] !== 'illksGT68ajnsik') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $req_data = [];
        $req_data['statistic'] = [];

        $req_data['statistic']['approved'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Approved')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->count();

        $req_data['waiting'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Menunggu Approval')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->get();
        $req_data['statistic']['waiting'] = count($req_data['waiting']);

        $req_data['statistic']['refused'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Refused')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->count();

        return $req_data;
    }

    public function izinRefused() {
        if(empty($_GET['token']) || $_GET['token'] !== 'illksGT68ajnsik') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $req_data = [];
        $req_data['statistic'] = [];

        $req_data['statistic']['approved'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Approved')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->count();

        $req_data['statistic']['waiting'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Menunggu Approval')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->count();

        $req_data['refused'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Refused')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->get();
        $req_data['statistic']['refused'] = count($req_data['refused']);

        return $req_data;
    }
}
