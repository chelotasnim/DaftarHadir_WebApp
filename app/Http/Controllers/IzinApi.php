<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\ReqIzinPresensi;
use App\Models\User;
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
        $req_data['statistic'] = [];
        $exp = 0;

        $current_user = User::where('pegawai_id', $id)->limit(1)->get();

        $req_data['approved'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Approved')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->select('penerima_id', 'keterangan', 'status_pengajuan', 'mulai', 'sampai', 'updated_at')->get();
        foreach ($req_data['approved'] as $req) {
            $req['tgl_mulai'] = Carbon::parse($req->mulai)->isoFormat('D MMM Y');
            $req['tgl_sampai'] = Carbon::parse($req->sampai)->isoFormat('D MMM Y');
            $req['sended'] = Carbon::parse($req->updated_at)->format('H:i d-m-Y');
            $req['penerima'] = $req->approver->name;

            if(Carbon::parse($req->sampai)->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {
                $req->status_pengajuan = 'Tidak Berlaku';
                $exp++;
            };
        };
        $req_data['statistic']['approved'] = count($req_data['approved']);

        $req_data['waiting'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Menunggu Approval')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->select('penerima_id', 'keterangan', 'status_pengajuan', 'mulai', 'sampai', 'updated_at')->get();
        $req_data['statistic']['waiting'] = count($req_data['waiting']);

        $req_data['refused'] = ReqIzinPresensi::where('pegawai_id', $id)->where('status_pengajuan', 'Refused')->whereMonth('sampai', '<=', Carbon::now()->format('m'))->whereYear('sampai', Carbon::now()->format('Y'))->select('penerima_id', 'keterangan', 'status_pengajuan', 'mulai', 'sampai', 'updated_at')->get();
        $req_data['statistic']['refused'] = count($req_data['refused']);

        $req_data['statistic']['exp'] = $exp;

        $req_data['jenis_izin'] = Izin::where('perusahaan_id', $current_user[0]->perusahaan_id)->get();

        return $req_data;
    }
}
