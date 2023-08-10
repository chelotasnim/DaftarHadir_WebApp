<?php

namespace App\Http\Controllers;

use App\Models\Lembur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LemburApi extends Controller
{
    public function showLembur() {
        if(empty($_GET['token']) || $_GET['token'] !== 'loIhgsjBUnoaw80B') {
            return redirect('/login');
        };

        $id = $_GET['id'];
        $lembur = Lembur::where('pegawai_id', $id)->whereMonth('tanggal', Carbon::now()->format('m'))->whereYear('tanggal', Carbon::now()->format('Y'))->get();

        return $lembur;
    }
}
