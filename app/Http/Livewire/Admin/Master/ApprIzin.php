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

use App\Models\Izin;
use App\Models\ReqIzin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprIzin extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-izin', [
            'izins' => Auth::user()->instansi->izins
        ]);
    }

    public $keterangan_izin;
    public $kode_izin;
    public $keterangan_pengirim;
    public function reqNew() {
        $izin_data = $this->validate([
            'keterangan_izin' => 'required|min:3|max:25',
            'kode_izin' => 'required|max:5',
            'keterangan_pengirim' => 'required|min:25|max:255'
        ]);
        $izin_data['pengirim_id'] = Auth::user()->id;
        $izin_data['jenis_pengajuan'] = 'Penambahan';
        $izin_data['status_pengajuan'] = 'Menunggu Approval';

        ReqIzin::create($izin_data);

        session()->flash('sended', 'Pengajuan Keterangan Izin Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id)
    {
        $izin_data = Izin::where('id', $id)->get();
        $newData = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        // Data Lama
        $newData['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->keterangan_izin)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nama Departemen</span>' . $izin_data[0]->keterangan_izin . '</li>';
        };
        if(!empty($this->kode_izin)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nama Departemen</span>' . $izin_data[0]->kode_izin . '</li>';
        };


        // Data Baru
        $newData['list_perubahan'] = $newData['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->keterangan_izin)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nama Departemen</span>' . $this->keterangan_izin . '</li>';
            $newData['keterangan_izin'] = $this->keterangan_izin;
        } else {
            $newData['keterangan_izin'] = $izin_data[0]->keterangan_izin;
        };
        if(!empty($this->kode_izin)) {
            $newData['list_perubahan'] = $newData['list_perubahan'] . '<li><span>Nama Departemen</span>' . $this->kode_izin . '</li>';
            $newData['kode_izin'] = $this->kode_izin;
        } else {
            $newData['kode_izin'] = $izin_data[0]->kode_izin;
        };

        $newData['list_perubahan'] = $newData['list_perubahan'] . '</ul>';



        // Insert
        $newData['izin_id'] = $id;
        $newData['pengirim_id'] = Auth::user()->id;
        $newData['jenis_pengajuan'] = 'Perubahan';
        $newData['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->keterangan_izin) || !empty($this->kode_izin)) {
            ReqIzin::create($newData);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        }

        $this->reset();
    }

    public function reqDestroy($id)
    {
        $izin_data = Izin::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['izin_id'] = $id;
        $req_data['keterangan_izin'] = $izin_data[0]->keterangan_izin;
        $req_data['kode_izin'] = $izin_data[0]->kode_izin;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqIzin::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}