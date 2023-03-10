<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\AktivitasPegawai;
use App\Models\Pegawai;
use App\Models\ReqAktivitasPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApprAktivitas extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $aktivitas = AktivitasPegawai::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        } else {
            $aktivitas = AktivitasPegawai::where('departemen_id', Auth::user()->departemen_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        };

        return view('livewire.admin.dashboard.appr-aktivitas', [
            'departemens' => Auth::user()->instansi->departemens,
            'aktivitases' => $aktivitas
        ]);
    }

    public $pegawai_id;
    public $tanggal;
    public $mulai;
    public $sampai;
    public $jenis;
    public $keterangan_aktivitas;
    public $keterangan_pengirim;
    public function reqNew() {
        $aktivitas_data = $this->validate([
            'pegawai_id' => 'required',
            'tanggal' => 'required',
            'mulai' => 'required',
            'sampai' => 'required',
            'jenis' => 'required',
            'keterangan_aktivitas' => 'required|min:25|max:255',
            'keterangan_pengirim' => 'required|min:25|max:255'
        ]);
        $aktivitas_data['pengirim_id'] = Auth::user()->id;
        $aktivitas_data['jenis_pengajuan'] = 'Penambahan';
        $aktivitas_data['status_pengajuan'] = 'Menunggu Approval';

        ReqAktivitasPegawai::create($aktivitas_data);
        session()->flash('sended', 'Pengajuan Jabatan Dikirimkan!');

        $this->reset();
    }

    public function reqChange($id) {
        $aktivitas_data = AktivitasPegawai::where('id', $id)->get();
        $pegawai = Pegawai::where('id', $aktivitas_data[0]->pegawai_id)->get();
        $pegawai_new = Pegawai::where('id', $this->pegawai_id)->get();
        $new_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);



        //Data Lama
        $new_data['list_perubahan'] = '<ul><span class="as-label">Data Lama</span>';

        if(!empty($this->pegawai_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Pegawai</span>' . $pegawai[0]->nama . '</li>';
        };
        if(!empty($this->tanggal)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Tanggal</span>' . $aktivitas_data[0]->tanggal . '</li>';
        };
        if(!empty($this->mulai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Mulai</span>' . $aktivitas_data[0]->mulai . ' WIB</li>';
        };
        if(!empty($this->sampai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Sampai</span>' . $aktivitas_data[0]->sampai . ' WIB</li>';
        };
        if(!empty($this->jenis)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jenis Aktivitas</span>' . $aktivitas_data[0]->jenis . '</li>';
        };
        if(!empty($this->keterangan_aktivitas)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Keterangan</span>' . $aktivitas_data[0]->keterangan_aktivitas . '</li>';
        };



        //Data Baru
        $new_data['list_perubahan'] = $new_data['list_perubahan'] . '</ul><ul><span class="as-label">Data Baru</span>';

        if(!empty($this->pegawai_id)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Nama Pegawai</span>' . $pegawai_new[0]->nama . '</li>';
            $new_data['pegawai_id'] = $this->pegawai_id;
        } else {
            $new_data['pegawai_id'] = $aktivitas_data[0]->pegawai_id;
        };
        if(!empty($this->tanggal)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Tanggal</span>' . $this->tanggal . '</li>';
            $new_data['tanggal'] = $this->tanggal;
        } else {
            $new_data['tanggal'] = $aktivitas_data[0]->tanggal;
        };
        if(!empty($this->mulai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Mulai</span>' . $this->mulai . ' WIB</li>';
            $new_data['mulai'] = $this->mulai;
        } else {
            $new_data['mulai'] = $aktivitas_data[0]->mulai;
        };
        if(!empty($this->sampai)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Sampai</span>' . $this->sampai . ' WIB</li>';
            $new_data['sampai'] = $this->sampai;
        } else {
            $new_data['sampai'] = $aktivitas_data[0]->sampai;
        };
        if(!empty($this->jenis)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Jenis Aktivitas</span>' . $this->jenis . '</li>';
            $new_data['jenis'] = $this->jenis;
        } else {
            $new_data['jenis'] = $aktivitas_data[0]->jenis;
        };
        if(!empty($this->keterangan_aktivitas)) {
            $new_data['list_perubahan'] = $new_data['list_perubahan'] . '<li><span>Keterangan</span>' . $this->keterangan_aktivitas . '</li>';
            $new_data['keterangan_aktivitas'] = $this->keterangan_aktivitas;
        } else {
            $new_data['keterangan_aktivitas'] = $aktivitas_data[0]->keterangan_aktivitas;
        };



        //Insert
        $new_data['aktivitas_id'] = $id;
        $new_data['pengirim_id'] = Auth::user()->id;
        $new_data['jenis_pengajuan'] = 'Perubahan';
        $new_data['status_pengajuan'] = 'Menunggu Approval';

        if(!empty($this->pegawai_id) || !empty($this->tanggal) || !empty($this->mulai) || !empty($this->sampai) || !empty($this->jenis) || !empty($this->keterangan_aktivitas)) {
            ReqAktivitasPegawai::create($new_data);
            session()->flash('sended', 'Pengajuan Perubahan Dikirimkan!');
        } else {
            session()->flash('failed', 'Tidak Ada Perubahan Terdeteksi!');
        };

        $this->reset();
    }

    public function reqDestroy($id) {
        $aktivitas_data = AktivitasPegawai::where('id', $id)->get();
        $req_data = $this->validate(['keterangan_pengirim' => 'required|min:25|max:255']);
        $req_data['pengirim_id'] = Auth::user()->id;
        $req_data['aktivitas_id'] = $aktivitas_data[0]->id;
        $req_data['pegawai_id'] = $aktivitas_data[0]->pegawai_id;
        $req_data['tanggal'] = $aktivitas_data[0]->tanggal;
        $req_data['mulai'] = $aktivitas_data[0]->mulai;
        $req_data['sampai'] = $aktivitas_data[0]->sampai;
        $req_data['jenis'] = $aktivitas_data[0]->jenis;
        $req_data['keterangan_aktivitas'] = $aktivitas_data[0]->keterangan_aktivitas;
        $req_data['jenis_pengajuan'] = 'Penghapusan';
        $req_data['status_pengajuan'] = 'Menunggu Approval';

        ReqAktivitasPegawai::create($req_data);
        session()->flash('sended', 'Pengajuan Penghapusan Dikirimkan!');
    }
}
