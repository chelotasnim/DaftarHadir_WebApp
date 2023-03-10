<?php

namespace App\Http\Livewire\Admin\Master;

use App\Models\Aktivitas;
use App\Models\Departemen;
use App\Models\ReqAktivitas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprAktivitas extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-aktivitas', [
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }

    public $departemen_id;
    public $aktivitas;
    public $status;
    public $keterangan_pengirim;
    public function reqNew() {
        $aktivitas_data = $this->validate([
            'departemen_id' => 'required',
            'aktivitas' => 'required',
            'status' => 'required',
            'keterangan_pengirim' => 'required|min:25|max:255'
        ]);
        $aktivitas_data['pengirim_id'] = Auth::user()->id;
        $aktivitas_data['jenis_pengajuan'] = 'Penambahan';
        $aktivitas_data['status_pengajuan'] = 'Menunggu Approval';

        ReqAktivitas::create($aktivitas_data);
        session()->flash('sended', 'Pengajuan Keterangan Izin Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id) {
        $aktivitas_data = Aktivitas::where('id', $id)->get();
        $departemen = Departemen::where('id', $this->departemen_id);
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        //Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->departemen_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Departemen</span>' . $aktivitas_data[0]->departemen->nama_dept . '</li>';
        };
        if(!empty($this->aktivitas)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jenis Aktivitas</span>' . $aktivitas_data[0]->aktivitas . '</li>';
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Status Aktivitas</span>' . $aktivitas_data[0]->status . '</li>';
        };


        //Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->departemen_id)) {
            $new_data['list_perubahan'] =$new_data['list_perubahan'] . '<li><span>Nama Departemen</span>' . $departemen[0]->nama_dept . '</li>';
            $new_data['departemen_id'] = $this->departemen_id;
        } else {
            $new_data['departemen_id'] = $aktivitas_data[0]->departemen_id;
        };
        if(!empty($this->aktivitas)) {
            $new_data['list_perubahan'] =$new_data['list_perubahan'] . '<li><span>Nama Departemen</span>' . $this->aktivitas . '</li>';
            $new_data['aktivitas'] = $this->aktivitas;
        } else {
            $new_data['aktivitas'] = $aktivitas_data[0]->aktivitas;
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] =$new_data['list_perubahan'] . '<li><span>Nama Departemen</span>' . $this->status . '</li>';
            $new_data['status'] = $this->status;
        } else {
            $new_data['status'] = $aktivitas_data[0]->status;
        };

        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul>';



        //Insert
        $new_data['aktivitas_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->departemen_id) || !empty($this->aktivitas) || !empty($this->status)) {
            ReqAktivitas::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        }

        $this->reset();
    }

    public function reqDestroy($id) {
        $aktivitas_data = Aktivitas::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['aktivitas_id'] = $id;
        $req_data['departemen_id'] = $aktivitas_data[0]->departemen_id;
        $req_data['aktivitas'] = $aktivitas_data[0]->aktivitas;
        $req_data['status'] = $aktivitas_data[0]->status;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqAktivitas::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
