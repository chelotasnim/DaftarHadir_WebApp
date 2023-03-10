<?php

namespace App\Http\Livewire\Admin\Master;

use App\Models\Pegawai;
use App\Models\ReqAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.master.appr-admin', [
            'admins' => Auth::user()->instansi->users,
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }

    public $pegawai_id;
    public $password;
    public $peran;
    public $status;
    public $keterangan_pengirim;
    public function reqNew() {
        $admin_data = $this->validate([
            'pegawai_id' => 'required',
            'password' => 'required',
            'peran' => 'required',
            'status' => 'required',
            'keterangan_pengirim' => 'required|min:25|max:255'
        ]);
        $admin_data['pengirim_id'] = Auth::user()->id;
        $admin_data['jenis_pengajuan'] = 'Penambahan';
        $admin_data['status_pengajuan'] = 'Menunggu Approval';

        ReqAdmin::create($admin_data);
        session()->flash('sended', 'Pengajuan Jabatan Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id) {
        $admin_data = User::where('id', $id)->get();
        $pegawai = Pegawai::where('id', $this->pegawai_id)->get();
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        //Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->pegawai_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Username</span>' . $admin_data[0]->name . '</li>';
        };
        if(!empty($this->password)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Password</span>' . 'Tidak Dapat Menampilkan' . '</li>';
        };
        if(!empty($this->peran)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Peran</span>' . $admin_data[0]->peran . '</li>';
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Status</span>' . $admin_data[0]->status . '</li>';
        };


        //Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->pegawai_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Username</span>' . $pegawai[0]->email . '</li>';
            $new_data['pegawai_id'] = $this->pegawai_id;
        } else {
            $new_data['pegawai_id'] = $admin_data[0]->pegawai_id;
        };
        if(!empty($this->password)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Password</span>' . $this->password . '</li>';
            $new_data['password'] = $this->password;
        } else {
            $new_data['password'] = $admin_data[0]->password;
        };
        if(!empty($this->peran)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Password</span>' . $this->peran . '</li>';
            $new_data['peran'] = $this->peran;
        } else {
            $new_data['peran'] = $admin_data[0]->peran;
        };
        if(!empty($this->status)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Password</span>' . $this->status . '</li>';
            $new_data['status'] = $this->status;
        } else {
            $new_data['status'] = $admin_data[0]->status;
        };

        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul>';

        //Insert
        $new_data['user_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->pegawai_id) || !empty($this->password) || !empty($this->peran) || !empty($this->status)) {
            ReqAdmin::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        };

        $this->reset();
    }

    public function reqDestroy($id) {
        $admin_data = User::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['pegawai_id'] = $admin_data[0]->pegawai_id;
        $req_data['user_id'] = $id;
        $req_data['password'] = $admin_data[0]->password;
        $req_data['peran'] = $admin_data[0]->peran;
        $req_data['status'] = $admin_data[0]->status;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqAdmin::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
