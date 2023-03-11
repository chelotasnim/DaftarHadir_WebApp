<?php

namespace App\Imports;

use App\Models\ReqPegawai;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPegawais implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ReqPegawai([
            'pengirim_id' => Auth::user()->id,
            'jabatan_id' => $row[0],
            'fp_id' => $row[1],
            'nip' => $row[2],
            'nama' => $row[3],
            'email' => $row[4],
            'tunjangan_tetap' => $row[5], 
            'tunjangan_bulan_ini' => $row[5],
            'no_hp' => $row[6], 
            'no_wa' => $row[7], 
            'alamat' => $row[8], 
            'tgl_lahir' => $row[9], 
            'jns_kel' => $row[10], 
            'status' => $row[11], 
            'keterangan_pengirim' => 'Import massal data pegawai',
            'jenis_pengajuan' => 'Penambahan',
            'status_pengajuan' => 'Menunggu Approval'
        ]);
    }
}
