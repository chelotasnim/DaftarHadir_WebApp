<?php

namespace App\Http\Controllers;

use App\Models\Autonotif;
use App\Models\AutonotifTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autonotifs extends Controller
{
    public function user()
    {
        $data = request()->validate([
            'username' => 'required',
            'token' => 'required',
        ]);
        $data['admin_id'] = Auth::user()->id;

        $message = '';

        $checkUser = Autonotif::where('admin_id', $data['admin_id'])->count();
        if ($checkUser > 0) {
            Autonotif::where('admin_id', $data['admin_id'])->update($data);
            $message = 'Perubahan berhasil disimpan!';
        } else {
            Autonotif::create($data);
            $message = 'Akun baru berhasil terhubung!';
        };

        return redirect('/dashboard/pengumuman/notifikasi/daftar_pegawai')->with('success', $message);
    }

    public function test()
    {
        $template = 'Daftar Hadir | Whatsapp API Testing [' . Carbon::now()->format('H:i:s Y/m/d') . ']';

        header('Content-Type: application/json; charset=utf-8');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.autonotif.com/public/new_message/?api_key=' . Auth::user()->autonotif->token . '&username=' . Auth::user()->autonotif->username);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        $params = array(
            'message_type' => 'TextMessage',
            'message' => $template,
            'target' => request()->input('test_target')
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

        $response = curl_exec($curl);
        curl_close($curl);

        $status = '';
        $detail = '';

        if (isset(json_decode($response)->success)) {
            if (json_decode($response)->success == false) {
                $status = 'failed';
                $detail = 'Pesan gagal dikirimkan!';
            } else {
                $status = 'success';
                $detail = 'Pesan berhasil dikirimkan!';
            };
        } else {
            $status = 'failed';
            $detail = 'Username atau Token salah!';
        };


        return redirect('/dashboard/pengumuman/notifikasi/daftar_pegawai')->with($status, $detail);
    }

    public function addTemplate()
    {
        $template = request()->validate([
            'notifikasi' => 'required',
            'template' => 'required',
            'target' => 'required',
            'event' => 'required'
        ]);

        $template['autonotif_id'] = Auth::user()->autonotif->id;

        AutonotifTemplate::create($template);

        return redirect('/dashboard/pengumuman/notifikasi/daftar_pegawai')->with('success', 'Template Pesan Ditambahkan!');
    }
}
