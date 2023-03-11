<?php

namespace App\Http\Controllers;

use App\Imports\ImportPegawais;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class Import_Export_Controller extends Controller
{
    public function index() {
        return view('admin.masterData.importPegawai', [
            'parentPage' => 'master',
            'page' => 'Import Pegawai',
            'pageDesc' => 'Laman untuk mengimport banyak data pegawai dalam 1 aksi'
        ]);
    }

    public function import() {
        Excel::import(new ImportPegawais, request()->file('file'));

        return back();
    }
}
