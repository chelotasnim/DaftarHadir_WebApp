<?php

namespace App\Http\Livewire\Admin\Appr;

use App\Models\ChangeLog;
use App\Models\ReqAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-admin', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id)
    {
        $req_data = ReqAdmin::where('id', $id)->get();
        $data['perusahaan_id'] = $req_data[0]->pegawai->jabatan->jadwal->departemen->perusahaan->id;
        $data['departemen_id'] = $req_data[0]->pegawai->jabatan->jadwal->departemen->id;
        $data['pegawai_id'] = $req_data[0]->pegawai->id;
        $data['name'] = $req_data[0]->pegawai->email;
        if(strlen($req_data[0]->password) > 50) {
            $data['password'] = $req_data[0]->password;
        } else {
            $data['password'] = bcrypt($req_data[0]->password);
        }
        $data['peran'] = $req_data[0]->peran;
        $data['status'] = $req_data[0]->status;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            User::create($data);
            ReqAdmin::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menambahkan admin ' . $req_data[0]->pegawai->email;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            User::where('id', $req_data[0]->user_id)->update([
                'pegawai_id' => $data['pegawai_id'],
                'name' => $req_data[0]->pegawai->email,
                'password' => $data['password'],
                'peran' => $data['peran'],
                'status' => $data['status']
            ]);
            ReqAdmin::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data admin ' . $req_data[0]->pegawai->email;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            User::where('id', $req_data[0]->user_id)->delete();
            ReqAdmin::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus admin ' . $req_data[0]->pegawai->email;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id) {
        ReqAdmin::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id) {
        ReqAdmin::where('id', $id)->delete();
    }
}
