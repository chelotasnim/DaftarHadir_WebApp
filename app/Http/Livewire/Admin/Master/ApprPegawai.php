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
use App\Models\Pegawai;
use App\Models\ReqPegawai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprPegawai extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-pegawai', [
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }

    public $jabatan_id;
    public $fp_id;
    public $nip;
    public $nama;
    public $email;
    public $tunjangan_tetap;
    public $no_hp;
    public $no_wa;
    public $alamat;
    public $tgl_lahir;
    public $jns_kel;
    public $status;
    public $keterangan_pengirim;
    public function reqNew() {
        $pegawai_data = $this->validate([
            'jabatan_id' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email:dns',
            'tunjangan_tetap' => 'required',
            'no_hp' => 'required',
            'no_wa' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jns_kel' => 'required',
            'status' => 'required',
            'keterangan_pengirim' => 'required',
        ]);
        $pegawai_data['fp_id'] = $this->fp_id;
        $pegawai_data['tunjangan_bulan_ini'] = $this->tunjangan_tetap;
        $pegawai_data['pengirim_id'] = Auth::user()->id;
        $pegawai_data['jenis_pengajuan'] = 'Penambahan';
        $pegawai_data['status_pengajuan'] = 'Menunggu Approval';

        ReqPegawai::create($pegawai_data);

        session()->flash('sended', 'Pengajuan Pegawai Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id) {
        $pegawai_data = Pegawai::where('id', $id)->get();
        $jabatan_data = Jabatan::where('id', $pegawai_data[0]->jabatan_id)->select('jabatan')->get();
        $jabatan_data_new = Jabatan::where('id', $this->jabatan_id)->select('jabatan')->get();
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        //Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';


        if(!empty($this->jabatan_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jabatan</span>' . $jabatan_data[0]->jabatan . '</li>';
        };
        if(!empty($this->fp_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>FP ID</span>' . $pegawai_data[0]->fp_id . '</li>';
        };
        if(!empty($this->nip)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>NIP</span>' . $pegawai_data[0]->nip . '</li>';
        };
        if(!empty($this->nama)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Pegawai</span>' . $pegawai_data[0]->nama . '</li>';
        };
        if(!empty($this->email)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Email</span>' . $pegawai_data[0]->email . '</li>';
        };
        if(!empty($this->tunjangan_tetap)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Tunjangan Tetap</span>' . $pegawai_data[0]->tunjangan_tetap . '</li>';
        };
        if(!empty($this->no_hp)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>No HP</span>' . $pegawai_data[0]->no_hp . '</li>';
        };
        if(!empty($this->no_wa)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>No WA</span>' . $pegawai_data[0]->no_wa . '</li>';
        };
        if(!empty($this->alamat)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Alamat</span>' . $pegawai_data[0]->alamat . '</li>';
        };
        if(!empty($this->tgl_lahir)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Tanggal Lahir</span>' . $pegawai_data[0]->tgl_lahir . '</li>';
        };
        if(!empty($this->jns_kel)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jenis Kelamin</span>' . $pegawai_data[0]->jns_kel . '</li>';
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Status</span>' . $pegawai_data[0]->status . '</li>';
        };



        //Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->jabatan_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jabatan</span>' . $jabatan_data_new[0]->jabatan . '</li>';
            $new_data['jabatan_id'] = $this->jabatan_id;
        } else {
            $new_data['jabatan_id'] = $pegawai_data[0]->jabatan_id;
        };
        if(!empty($this->fp_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>FP ID</span>' . $this->fp_id . '</li>';
            $new_data['fp_id'] = $this->fp_id;
        } else {
            $new_data['fp_id'] = $pegawai_data[0]->fp_id;
        };
        if(!empty($this->nip)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>NIP</span>' . $this->nip . '</li>';
            $new_data['nip'] = $this->nip;
        } else {
            $new_data['nip'] = $pegawai_data[0]->nip;
        };
        if(!empty($this->nama)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Pegawai</span>' . $this->nama . '</li>';
            $new_data['nama'] = $this->nama;
        } else {
            $new_data['nama'] = $pegawai_data[0]->nama;
        };
        if(!empty($this->email)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Email</span>' . $this->email . '</li>';
            $new_data['email'] = $this->email;
        } else {
            $new_data['email'] = $pegawai_data[0]->email;
        };
        if(!empty($this->tunjangan_tetap)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Tunjangan Tetap</span>' . $this->tunjangan_tetap . '</li>';
            $new_data['tunjangan_tetap'] = $this->tunjangan_tetap;
            $countTunjangan = $pegawai_data[0]->tunjangan_tetap - $this->tunjangan_tetap;
            $new_data['tunjangan_bulan_ini'] = $pegawai_data[0]->tunjangan_bulan_ini - $countTunjangan;
        } else {
            $new_data['tunjangan_tetap'] = $pegawai_data[0]->tunjangan_tetap;
            $new_data['tunjangan_bulan_ini'] = $pegawai_data[0]->tunjangan_bulan_ini;
        };
        if(!empty($this->no_hp)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>No HP</span>' . $this->no_hp . '</li>';
            $new_data['no_hp'] = $this->no_hp;
        } else {
            $new_data['no_hp'] = $pegawai_data[0]->no_hp;
        };
        if(!empty($this->no_wa)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>No WA</span>' . $this->no_wa . '</li>';
            $new_data['no_wa'] = $this->no_wa;
        } else {
            $new_data['no_wa'] = $pegawai_data[0]->no_wa;
        };
        if(!empty($this->alamat)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Alamat</span>' . $this->alamat . '</li>';
            $new_data['alamat'] = $this->alamat;
        } else {
            $new_data['alamat'] = $pegawai_data[0]->alamat;
        };
        if(!empty($this->tgl_lahir)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Tanggal Lahir</span>' . $this->tgl_lahir . '</li>';
            $new_data['tgl_lahir'] = $this->tgl_lahir;
        } else {
            $new_data['tgl_lahir'] = $pegawai_data[0]->tgl_lahir;
        };
        if(!empty($this->jns_kel)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jenis Kelamin</span>' . $this->jns_kel . '</li>';
            $new_data['jns_kel'] = $this->jns_kel;
        } else {
            $new_data['jns_kel'] = $pegawai_data[0]->jns_kel;
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Status</span>' . $this->status . '</li>';
            $new_data['status'] = $this->status;
        } else {
            $new_data['status'] = $pegawai_data[0]->status;
        };

        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul>';

        $new_data['pegawai_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(
            !empty($this->jabatan_id) ||
            !empty($this->fp_id) ||
            !empty($this->nip) ||
            !empty($this->nama) ||
            !empty($this->email) ||
            !empty($this->tunjangan_tetap) ||
            !empty($this->no_hp) ||
            !empty($this->no_wa) ||
            !empty($this->alamat) ||
            !empty($this->tgl_lahir) ||
            !empty($this->jns_kel) ||
            !empty($this->status)) {
            
            ReqPegawai::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        }

        $this->reset();
    }

    public function reqDestroy($id)
    {
        $pegawai_data = Pegawai::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['jabatan_id'] = $pegawai_data[0]->jabatan_id;
        $req_data['pegawai_id'] = $pegawai_data[0]->id;
        $req_data['fp_id'] = $pegawai_data[0]->fp_id;
        $req_data['nip'] = $pegawai_data[0]->nip;
        $req_data['nama'] = $pegawai_data[0]->nama;
        $req_data['email'] = $pegawai_data[0]->email;
        $req_data['tunjangan_tetap'] = $pegawai_data[0]->tunjangan_tetap;
        $req_data['tunjangan_bulan_ini'] = $pegawai_data[0]->tunjangan_bulan_ini;
        $req_data['no_hp'] = $pegawai_data[0]->no_hp;
        $req_data['no_wa'] = $pegawai_data[0]->no_wa;
        $req_data['alamat'] = $pegawai_data[0]->alamat;
        $req_data['tgl_lahir'] = $pegawai_data[0]->tgl_lahir;
        $req_data['jns_kel'] = $pegawai_data[0]->jns_kel;
        $req_data['status'] = $pegawai_data[0]->status;

        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqPegawai::create($req_data);
        
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    } 
}
