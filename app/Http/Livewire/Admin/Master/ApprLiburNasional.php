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

use App\Models\LiburNasional;
use App\Models\ReqLiburNasional;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprLiburNasional extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-libur-nasional', [
            'liburNasional' => Auth::user()->instansi->liburNasional
        ]);
    }

    public $nama_libur;
    public $mulai;
    public $sampai;
    public $pengumuman;
    public $keterangan_pengirim;
    public function reqNew() {
        $libur_data = $this->validate([
            'nama_libur' => 'required',
            'mulai' => 'required',
            'sampai' => 'required',
            'keterangan_pengirim' => 'required'
        ]);
        $libur_data['pengumuman'] = $this->pengumuman;
        $libur_data['pengirim_id'] = Auth::user()->id;
        $libur_data['jenis_pengajuan'] = 'Penambahan';
        $libur_data['status_pengajuan'] = 'Menunggu Approval';

        ReqLiburNasional::create($libur_data);

        session()->flash('sended', 'Pengajuan Departemen Dikirimkan!');
        
        $this->reset();
    }

    public function reqChange($id) {
        $libur_data = LiburNasional::where('id', $id)->get();
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        // Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->nama_libur)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Libur</span>' . $libur_data[0]->nama_libur . '</li>';
        };
        if(!empty($this->mulai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Mulai Tanggal</span>' . $libur_data[0]->mulai . '</li>';
        };
        if(!empty($this->sampai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Sampai Tanggal</span>' . $libur_data[0]->sampai . '</li>';
        };
        if(!empty($this->pengumuman)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Pengumuman</span>' . $libur_data[0]->pengumuman . '</li>';
        };


        // Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->nama_libur)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Libur</span>' . $this->nama_libur . '</li>';
            $new_data['nama_libur'] = $this->nama_libur;
        } else {
            $new_data['nama_libur'] = $libur_data[0]->nama_libur;
        };
        if(!empty($this->mulai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Mulai Tanggal</span>' . $this->mulai . '</li>';
            $new_data['mulai'] = $this->mulai;
        } else {
            $new_data['mulai'] = $libur_data[0]->mulai;
        };
        if(!empty($this->sampai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Sampai Tanggal</span>' . $this->sampai . '</li>';
            $new_data['sampai'] = $this->sampai;
        } else {
            $new_data['sampai'] = $libur_data[0]->sampai;
        };
        if(!empty($this->pengumuman)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Pengumuman</span>' . $this->pengumuman . '</li>';
            $new_data['pengumuman'] = $this->pengumuman;
        } else {
            $new_data['pengumuman'] = $libur_data[0]->pengumuman;
        };

        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul>';



        // Insert
        $new_data['libur_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->nama_libur) || !empty($this->mulai) || !empty($this->sampai) || !empty($this->pengumuman)) {
            ReqLiburNasional::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        }

        $this->reset();
    }

    public function reqDestroy($id) {
        $libur_data = LiburNasional::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['libur_id'] = $id;
        $req_data['nama_libur'] = $libur_data[0]->nama_libur;
        $req_data['mulai'] = $libur_data[0]->mulai;
        $req_data['sampai'] = $libur_data[0]->sampai;
        $req_data['pengumuman'] = $libur_data[0]->pengumuman;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqLiburNasional::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
