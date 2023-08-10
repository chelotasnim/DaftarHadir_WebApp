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

namespace App\Http\Livewire\Admin\Appr;

use App\Models\AutonotifTemplate;
use App\Models\ChangeLog;
use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\ReqPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccPegawai extends Component
{
    public function render()
    {
        return view('livewire.admin.appr.acc-pegawai', [
            'allAdmin' => Auth::user()->instansi->users
        ]);
    }

    public function approved($id)
    {
        $req_data = ReqPegawai::where('id', $id)->get();
        $data['jabatan_id'] = $req_data[0]->jabatan_id;
        $data['fp_id'] = $req_data[0]->fp_id;
        $data['nip'] = $req_data[0]->nip;
        $data['nama'] = $req_data[0]->nama;
        $data['email'] = $req_data[0]->email;
        $data['tunjangan_tetap'] = $req_data[0]->tunjangan_tetap;
        $data['tunjangan_bulan_ini'] = $req_data[0]->tunjangan_bulan_ini;
        $data['password'] = $req_data[0]->password;
        $data['no_hp'] = $req_data[0]->no_hp;
        $data['no_wa'] = $req_data[0]->no_wa;
        $data['alamat'] = $req_data[0]->alamat;
        $data['tgl_lahir'] = $req_data[0]->tgl_lahir;
        $data['jns_kel'] = $req_data[0]->jns_kel;
        $data['status'] = $req_data[0]->status;

        $change['operator_id'] = $req_data[0]->pengirim_id;
        $change['acc_id'] = Auth::user()->id;
        $change['keterangan'] = $req_data[0]->keterangan_pengirim;

        if($req_data[0]->jenis_pengajuan === 'Penambahan') {
            // Pegawai::create($data);
            // ReqPegawai::where('id', $id)->update([
            //     'penerima_id' => Auth::user()->id,
            //     'status_pengajuan' => 'Approved'
            // ]);

            $change['perubahan'] = 'Menambahkan pegawai ' . $req_data[0]->nama;
            $change['jenis_perubahan'] = 'Penambahan';
            ChangeLog::create($change);

            $relevant_dept = Departemen::where('id', $req_data[0]->jabatan->jadwal->departemen->id)->limit(1)->get();
            $templates = AutonotifTemplate::where('event', 'Pendaftaran Pegawai')->get();
            foreach ($templates as $format) {
                $message = $format->template;
                $message = str_replace(
                    array('[nama_pegawai]', $data['nama']),
                    array('[nama_departemen]', $relevant_dept[0]->nama_dept),
                    array('[tgl_hari_ini]', Carbon::now()->isoFormat('dddd, D MMMM Y')),
                    $message
                );
                $message = str_replace(
                    array('[email_pegawai]', $data['email']),
                    array('[wa_pegawai]', $data['no_wa']),
                    array('[jabatan]', $req_data[0]->jabatan->jabatan),
                    $message
                );
                $targets = [];

                if($format->target == 'Semua Atasan ' . Auth::user()->instansi->nama_instansi) {
                    array_push($targets, $relevant_dept[0]->telp_1, $relevant_dept[0]->telp_2);
                    if($relevant_dept[0]->telp_3 != '') {
                        array_push($targets, $relevant_dept[0]->telp_3);
                    };
                };

                if($targets != '') {
                    foreach ($targets as $target) {
                        header('Content-Type: application/json; charset=utf-8');
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, 'https://api.autonotif.com/public/new_message/?api_key=' . Auth::user()->autonotif->token . '&username=' . Auth::user()->autonotif->username);
                        curl_setopt($curl, CURLOPT_HEADER, 0);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($curl, CURLOPT_TIMEOUT,30);
                        curl_setopt($curl, CURLOPT_POST, 1);
                        $params = array (
                        'message_type' => 'TextMessage',
                        'message' => $message,
                        'target' => $target
                        );
                        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        
        
                        curl_exec($curl);
                        curl_close($curl);
                    }
                };
            }


        } else if($req_data[0]->jenis_pengajuan === 'Perubahan') {
            Pegawai::where('id', $req_data[0]->pegawai_id)->update([
                'jabatan_id' => $data['jabatan_id'],
                'fp_id' => $data['fp_id'],
                'nama' => $data['nama'],
                'email' => $data['email'],
                'tunjangan_tetap' => $data['tunjangan_tetap'],
                'tunjangan_bulan_ini' => $data['tunjangan_bulan_ini'],
                'password' => $data['password'],
                'no_hp' => $data['no_hp'],
                'no_wa' => $data['no_wa'],
                'alamat' => $data['alamat'],
                'tgl_lahir' => $data['tgl_lahir'],
                'jns_kel' => $data['jns_kel'],
                'status' => $data['status'],
            ]);

            ReqPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Perubahan data pegawai ' . $req_data[0]->nama;
            $change['jenis_perubahan'] = 'Perubahan';
            ChangeLog::create($change);
        } else if($req_data[0]->jenis_pengajuan === 'Penghapusan') {
            Pegawai::where('id', $req_data[0]->pegawai_id)->delete();
            Presensi::where('pegawai_id', $req_data[0]->pegawai_id)->delete();

            ReqPegawai::where('id', $id)->update([
                'penerima_id' => Auth::user()->id,
                'status_pengajuan' => 'Approved'
            ]);

            $change['perubahan'] = 'Menghapus pegawai ' . $req_data[0]->nama;
            $change['jenis_perubahan'] = 'Penghapusan';
            ChangeLog::create($change);
        }
    }

    public function refused($id)
    {
        ReqPegawai::where('id', $id)->update(['status_pengajuan' => 'Refused']);
    }

    public function trash($id)
    {
        ReqPegawai::where('id', $id)->delete();
    }

    public $all_id = [];
    public function checkCard($id)
    {
        if(!in_array($id, $this->all_id)) {
            array_push($this->all_id, $id);
        } else {
            if (($key = array_search($id, $this->all_id)) !== false) {
                unset($this->all_id[$key]);
            };
        };
    }

    public function approveAll() {
        foreach ($this->all_id as $id) {
            $this->approved($id);
        };

        $this->all_id = [];
    }

    public function refuseAll() {
        foreach ($this->all_id as $id) {
            $this->refused($id);
        };
        
        $this->all_id = [];
    }
}
