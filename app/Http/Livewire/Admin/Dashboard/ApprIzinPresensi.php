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

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Izin;
use App\Models\IzinPresensi;
use App\Models\Pegawai;
use App\Models\ReqIzinPresensi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApprIzinPresensi extends Component
{
    use WithFileUploads;

    public function render()
    {
        $izins = Izin::where('perusahaan_id', Auth::user()->instansi->id)->get();
        if(empty(Auth::user()->departemen_id)) {
            $izin_report = IzinPresensi::where('perusahaan_id', Auth::user()->instansi->id)->get();
        } else {
            $izin_report = IzinPresensi::where('departemen_id', Auth::user()->departemen_id)->get();
        };

        return view('livewire.admin.dashboard.appr-izin-presensi', [
            'departemens' => Auth::user()->instansi->departemens,
            'keterangans' => $izins,
            'izins' => $izin_report
        ]);
    }

    public $pegawai_id;
    public $mulai;
    public $sampai;
    public $keterangan;
    public $lampiran;
    public $keterangan_pengirim;
    public function reqNew() {
        $izin_data = $this->validate([
            'pegawai_id' => 'required',
            'mulai' => 'required',
            'sampai' => 'required',
            'keterangan' => 'required',
            'lampiran' => 'image|max:1024',
            'keterangan_pengirim' => 'required|min:25|max:255',
        ]);
        $izin_data['pengirim_id'] = Auth::user()->id;
        $izin_data['jenis_pengajuan'] = 'Penambahan';
        $izin_data['status_pengajuan'] = 'Menunggu Approval';
        $izin_data['lampiran'] = $this->lampiran->store('LampiranIzin', 'public');

        ReqIzinPresensi::create($izin_data);
        session()->flash('sended', 'Pengajuan Jabatan Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id) {
        $izin_data = IzinPresensi::where('id', $id)->get();
        $pegawai_data = Pegawai::where('id', $izin_data[0]->pegawai_id)->select('nama')->get();
        $pegawai_data_new = Pegawai::where('id', $this->pegawai_id)->select('nama')->get();
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        //Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->pegawai_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Pegawai</span>' . $pegawai_data[0]->nama . '</li>';
        };
        if(!empty($this->mulai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Mulai Tanggal</span>' . $izin_data[0]->mulai . '</li>';
        };
        if(!empty($this->sampai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Sampai Tanggal</span>' . $izin_data[0]->sampai . '</li>';
        };
        if(!empty($this->keterangan)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Keterangan</span>' . $izin_data[0]->keterangan . '</li>';
        };


        //Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->pegawai_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Pegawai</span>' . $pegawai_data_new[0]->nama . '</li>';
            $new_data['pegawai_id'] = $this->pegawai_id;
        } else {
            $new_data['pegawai_id'] = $izin_data[0]->pegawai_id;
        };
        if(!empty($this->mulai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Mulai Tanggal</span>' . $this->mulai . '</li>';
            $new_data['mulai'] = $this->mulai;
        } else {
            $new_data['mulai'] = $izin_data[0]->mulai;
        };
        if(!empty($this->sampai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Sampai Tanggal</span>' . $this->sampai . '</li>';
            $new_data['sampai'] = $this->sampai;
        } else {
            $new_data['sampai'] = $izin_data[0]->sampai;
        };
        if(!empty($this->keterangan)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Keterangan</span>' . $this->keterangan . '</li>';
            $new_data['keterangan'] = $this->keterangan;
        } else {
            $new_data['keterangan'] = $izin_data[0]->keterangan;
        };

        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul>';



        //Insert
        $new_data['izin_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->pegawai_id) || !empty($this->mulai) || !empty($this->sampai) || !empty($this->keterangan)) {
            ReqIzinPresensi::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        };

        $this->reset();
    }

    public function reqDestroy($id) {
        $izin_data = IzinPresensi::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['izin_id'] = $izin_data[0]->id;
        $req_data['pegawai_id'] = $izin_data[0]->pegawai_id;
        $req_data['mulai'] = $izin_data[0]->mulai;
        $req_data['sampai'] = $izin_data[0]->sampai;
        $req_data['keterangan'] = $izin_data[0]->keterangan;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqIzinPresensi::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
