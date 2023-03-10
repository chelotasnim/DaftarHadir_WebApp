<?php

/**
 * Dear Maintainer
 * 
 * When I wrote this code
 * Only God and I know what it was
 * Now, only God know what it was :)
 * 
 * Stay Tawakal and Keep Ikhtiar
 * May god give you clue about it
 * 
 * Recent Maintainer :
 * SMKN 1 Bondowoso 2022/2023 Students
**/

namespace App\Http\Livewire\Admin\Appr;

use App\Models\ChangeLog;
use App\Models\Pegawai;
use App\Models\ReqPegawai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccPegawai extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-pegawai', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id)
    {
        $req_data = ReqPegawai::where('id', $id)->get();
        $data['jabatan_id'] = $req_data[0]->jabatan_id;
        $data['fp_id'] = $req_data[0]->fp_id;
        $data['nip'] = $req_data[0]->nip;
        $data['nama'] = $req_data[0]->nama;
        $data['email'] = $req_data[0]->email;
        $data['tunjangan_tetap'] = $req_data[0]->tunjangan_tetap;
        $data['tunjangan_bulan_ini'] = $req_data[0]->tunjangan_bulan_ini;
        $data['password'] = $req_data[0]->password;
        $data['no_hp'] = $req_data[0]->no_hp;
        $data['no_wa'] = $req_data[0]->no_wa;
        $data['alamat'] = $req_data[0]->alamat;
        $data['tgl_lahir'] = $req_data[0]->tgl_lahir;
        $data['jns_kel'] = $req_data[0]->jns_kel;
        $data['status'] = $req_data[0]->status;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            Pegawai::create($data);
            ReqPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan pegawai ' . $req_data[0]->nama;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            Pegawai::where('id', $req_data[0]->pegawai_id)->update([
                'jabatan_id' => $data['jabatan_id'],
                'fp_id' => $data['fp_id'],
                'nama' => $data['nama'],
                'email' => $data['email'],
                'tunjangan_tetap' => $data['tunjangan_tetap'],
                'tunjangan_bulan_ini' => $data['tunjangan_bulan_ini'],
                'password' => $data['password'],
                'no_hp' => $data['no_hp'],
                'no_wa' => $data['no_wa'],
                'alamat' => $data['alamat'],
                'tgl_lahir' => $data['tgl_lahir'],
                'jns_kel' => $data['jns_kel'],
                'status' => $data['status'],
            ]);

            ReqPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data pegawai ' . $req_data[0]->nama;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Pegawai::where('id', $req_data[0]->pegawai_id)->delete();

            ReqPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus pegawai ' . $req_data[0]->nama;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id)
    {
        ReqPegawai::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id)
    {
        ReqPegawai::where('id', $id)->delete();
    }
}
