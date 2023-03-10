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

namespace App\Http\Livewire\Admin\Master;

use App\Models\Jabatan;
use App\Models\jadwal_kerja;
use App\Models\ReqJabatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprJabatan extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-jabatan', [
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }

    public $jadwal_id;
    public $jabatan;
    public $jatah_cuti_tahunan;
    public $gaji;
    public $status;
    public $keterangan_pengirim;
    public function reqNew()
    {
        $jabatan_data = $this->validate([
            'jadwal_id' => 'required',
            'jabatan' => 'required',
            'jatah_cuti_tahunan' => 'required',
            'gaji' => 'required',
            'status' => 'required',
            'keterangan_pengirim' => 'required'
        ]);
        $jabatan_data['pengirim_id'] = Auth::user()->id;
        $jabatan_data['jenis_pengajuan'] = 'Penambahan';
        $jabatan_data['status_pengajuan'] = 'Menunggu Approval';

        ReqJabatan::create($jabatan_data);
        session()->flash('sended', 'Pengajuan Jabatan Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id)
    {
        $jabatan_data = Jabatan::where('id', $id)->get();
        $jadwal_data = jadwal_kerja::where('id', $jabatan_data[0]->jadwal_id)->select('nama_jadwal')->get();
        $jadwal_data_new = jadwal_kerja::where('id', $this->jadwal_id)->select('nama_jadwal')->get();
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        //Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->jadwal_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Jadwal</span>' . $jadwal_data[0]->nama_jadwal . '</li>';
        };
        if(!empty($this->jabatan)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Jabatan</span>' . $jabatan_data[0]->jabatan . '</li>';
        };
        if(!empty($this->jatah_cuti_tahunan)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jatah Cuti Tahunan</span>' . $jabatan_data[0]->jatah_cuti_tahunan . ' Hari</li>';
        };
        if(!empty($this->gaji)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Gaji Perbulan</span>Rp ' . $jabatan_data[0]->gaji . '</li>';
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Status Jabatan</span>' . $jabatan_data[0]->status . '</li>';
        };


        //Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';
        if(!empty($this->jadwal_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Jadwal</span>' . $jadwal_data_new[0]->nama_jadwal . '</li>';
            $new_data['jadwal_id'] = $this->jadwal_id;
        } else {
            $new_data['jadwal_id'] = $jabatan_data[0]->jadwal_id;
        };
        if(!empty($this->jabatan)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Jabatan</span>' . $this->jabatan . '</li>';
            $new_data['jabatan'] = $this->jabatan;
        } else {
            $new_data['jabatan'] = $jabatan_data[0]->jabatan;
        };
        if(!empty($this->jatah_cuti_tahunan)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jatah Cuti Tahunan</span>' . $this->jatah_cuti_tahunan . '</li>';
            $new_data['jatah_cuti_tahunan'] = $this->jatah_cuti_tahunan;
        } else {
            $new_data['jatah_cuti_tahunan'] = $jabatan_data[0]->jatah_cuti_tahunan;
        };
        if(!empty($this->gaji)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Gaji Perbulan</span>' . $this->gaji . '</li>';
            $new_data['gaji'] = $this->gaji;
        } else {
            $new_data['gaji'] = $jabatan_data[0]->gaji;
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Status Jabatan</span>' . $this->status . '</li>';
            $new_data['status'] = $this->status;
        } else {
            $new_data['status'] = $jabatan_data[0]->status;
        };

        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul>';

        // Insert
        $new_data['jabatan_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->departemen_id) || !empty($this->jadwal_id) || !empty($this->jabatan) || !empty($this->jatah_cuti_tahunan) || !empty($this->gaji) || !empty($this->status)) {
            ReqJabatan::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        };

        $this->reset();
    }

    public function reqDestroy($id)
    {
        $jabatan_data = Jabatan::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['jadwal_id'] = $jabatan_data[0]->jadwal_id;
        $req_data['jabatan_id'] = $jabatan_data[0]->id;
        $req_data['jabatan'] = $jabatan_data[0]->jabatan;
        $req_data['jatah_cuti_tahunan'] = $jabatan_data[0]->jatah_cuti_tahunan;
        $req_data['gaji'] = $jabatan_data[0]->gaji;
        $req_data['status'] = $jabatan_data[0]->status;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqJabatan::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
