<?php

namespace App\Imports;

use App\Models\ReqPegawai;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportPegawais implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function rules(): array {
        return [    
            'jabatan_id' => 'required|numeric',
            'fp_id' => 'required|numeric',
            'nip' => 'required|unique:pegawais',
            'nama' => 'required|unique:pegawais',
            'email' => 'required|email|unique:pegawais',
            'tunjangan_tetap' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'no_wa' => 'required|numeric',
            'alamat' => 'required|min:12',
            'tgl_lahir' => 'required',
            'jns_kel' => 'required|min:4',
            'status' => 'required|min:4'
        ];
    }

    public function model(array $row)
    {
        return new ReqPegawai([
            'pengirim_id' => Auth::user()->id,
            'jabatan_id' => $row['jabatan_id'],
            'fp_id' => $row['fp_id'],
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'tunjangan_tetap' => $row['tunjangan_tetap'], 
            'tunjangan_bulan_ini' => $row['tunjangan_tetap'],
            'no_hp' => $row['no_hp'], 
            'no_wa' => $row['no_wa'], 
            'alamat' => $row['alamat'], 
            'tgl_lahir' => $row['tgl_lahir'], 
            'jns_kel' => $row['jns_kel'], 
            'status' => $row['status'], 
            'keterangan_pengirim' => 'Import massal data pegawai',
            'jenis_pengajuan' => 'Penambahan',
            'status_pengajuan' => 'Menunggu Approval'
        ]);
    }

}
