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

use App\Models\Departemen;
use App\Models\ReqDepartemen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprDepartemen extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-departemen', [
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }

    public $nama_dept;
    public $atasan1;
    public $telp_1;
    public $atasan2;
    public $telp_2;
    public $atasan3;
    public $telp_3;
    public $status;
    public $keterangan_pengirim;
    public function reqNew()
    {
        $dept_data = $this->validate([
            'nama_dept' => 'required|min:3|max:25',
            'atasan1' => 'required',
            'telp_1' => 'required',
            'atasan2' => 'required',
            'telp_2' => 'required',
            'status' => 'required',
            'keterangan_pengirim' => 'required|min:25|max:255'
        ]);
        $dept_data['atasan3'] = $this->atasan3;
        $dept_data['telp_3'] = $this->telp_3;
        $dept_data['pengirim_id'] = Auth::user()->id;
        $dept_data['jenis_pengajuan'] = 'Penambahan';
        $dept_data['status_pengajuan'] = 'Menunggu Approval';

        ReqDepartemen::create($dept_data);

        session()->flash('sended', 'Pengajuan Departemen Dikirimkan!');
        
        $this->reset();
    }

    public function reqChange($id) {
        $dept_data = Departemen::where('id', $id)->get();
        $newData = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        // Data Lama
        $newData['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->nama_dept)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nama Departemen</span>' . $dept_data[0]->nama_dept . '</li>';
        };
        if(!empty($this->atasan1)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Atasan 1</span>' . $dept_data[0]->atasan1 . '</li>';
        };
        if(!empty($this->telp_1)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nomor WA Atasan 1</span>' . $dept_data[0]->telp_1 . '</li>';
        };
        if(!empty($this->atasan2)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Atasan 2</span>' . $dept_data[0]->atasan2 . '</li>';
        };
        if(!empty($this->telp_2)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nomor WA Atasan 2</span>' . $dept_data[0]->telp_2 . '</li>';
        };
        if(!empty($this->atasan3)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Atasan 3</span>' . $dept_data[0]->atasan3 . '</li>';
        };
        if(!empty($this->telp_3)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nomor WA Atasan 3</span>' . $dept_data[0]->telp_3 . '</li>';
        };
        if(!empty($this->status)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Status</span>' . $dept_data[0]->status . '</li>';
        };



        // Data Baru
        $newData['list_perubahan'] = $newData['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->nama_dept)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nama Departemen</span>' . $this->nama_dept . '</li>';
            $newData['nama_dept'] = $this->nama_dept;
        } else {
            $newData['nama_dept'] = $dept_data[0]->nama_dept;
        };
        if(!empty($this->atasan1)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Atasan 1</span>' . $this->atasan1 . '</li>';
            $newData['atasan1'] = $this->atasan1;
        } else {
            $newData['atasan1'] = $dept_data[0]->atasan1;
        };
        if(!empty($this->telp_1)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nomor WA Atasan 1</span>' . $this->telp_1 . '</li>';
            $newData['telp_1'] = $this->telp_1;
        } else {
            $newData['telp_1'] = $dept_data[0]->telp_1;
        };
        if(!empty($this->atasan2)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Atasan 2</span>' . $this->atasan2 . '</li>';
            $newData['atasan2'] = $this->atasan2;
        } else {
            $newData['atasan2'] = $dept_data[0]->atasan2;
        };
        if(!empty($this->telp_2)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nomor WA Atasan 1</span>' . $this->telp_2 . '</li>';
            $newData['telp_2'] = $this->telp_2;
        } else {
            $newData['telp_2'] = $dept_data[0]->telp_2;
        };
        if(!empty($this->atasan3)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Atasan 3</span>' . $this->atasan3 . '</li>';
            $newData['atasan3'] = $this->atasan3;
        } else {
            $newData['atasan3'] = $dept_data[0]->atasan3;
        };
        if(!empty($this->telp_3)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nomor WA Atasan 1</span>' . $this->telp_3 . '</li>';
            $newData['telp_3'] = $this->telp_3;
        } else {
            $newData['telp_3'] = $dept_data[0]->telp_3;
        };
        if(!empty($this->status)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Status</span>' . $this->status . '</li>';
            $newData['status'] = $this->status;
        } else {
            $newData['status'] = $dept_data[0]->status;
        };

        $newData['list_perubahan'] = $newData['list_perubahan'] . '</ul>';



        // Insert
        $newData['departemen_id'] = $id;
        $newData['pengirim_id'] = Auth::user()->id;
        $newData['jenis_pengajuan'] = 'Perubahan';
        $newData['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->atasan1) || !empty($this->atasan2) || !empty($this->atasan3) || !empty($this->status)) {
            ReqDepartemen::create($newData);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        }

        $this->reset();
    }

    public function reqDestroy($id) {
        $dept_data = Departemen::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['departemen_id'] = $dept_data[0]->id;
        $req_data['nama_dept'] = $dept_data[0]->nama_dept;
        $req_data['atasan1'] = $dept_data[0]->atasan1;
        $req_data['telp_1'] = $dept_data[0]->telp_1;
        $req_data['atasan2'] = $dept_data[0]->atasan2;
        $req_data['telp_2'] = $dept_data[0]->telp_2;
        $req_data['atasan3'] = $dept_data[0]->atasan3;
        $req_data['telp_3'] = $dept_data[0]->telp_3;
        $req_data['status'] = $dept_data[0]->status;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqDepartemen::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
